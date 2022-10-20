<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use Validator, Alert, File, PDF;

class TransaksiController extends Controller
{
    public function FormPembayaran($id)
    {
        $data = OrderModel::where('id', $id)->with(['getDetailOrderFromOrder','getProdukFromOrder.getTravelFromProduk','getProdukFromOrder.getBimbelFromProduk','getProdukFromOrder.getJasaFotoFromProduk'])->first();
        return view('user.transaksi.index', compact('data'));
    }

    public function StorePembayaran(Request $request, $id)
    {
        $rules = [
            'bank' => ['required'],
            'rek' => ['required'],
            'bukti' => ['required', 'file', 'mimes:png,jpg,jpeg'],
        ];

        $messages = [];

        $attributes = [
            'bank' => 'Bank',
            'rek' => 'Nama Rekening',
            'bukti' => 'Bukti Pembayaran',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = new TransaksiModel;
            $data->order_id = $id;
            $data->jenis_pembayaran = 'Online';
            $data->bank = $request->bank;
            $data->namaRek = $request->rek;
            $data->total_pembayaran = $request->total;
            $data->expired_at = \Carbon\Carbon::now()->subDays(1)->format('Y-m-d H:i:s');

            if ($request->hasFile('bukti')){
                $file = $request->file('bukti');
                $filename = time()."_".$file->getClientOriginalName();
                $file->move(public_path('assets/img/bukti'), $filename);

                $data->bukti_pembayaran = $filename;
            }

            $data->save();

            Alert::success('Berhasil Melakukan Pembayaran');

            return redirect()->route('history.order');
        }
    }

    public function CetakNota($id, $kategori)
    {
        switch ($kategori) {
            case 'Travel':
                $data = TransaksiModel::where('id', $id)->with([
                    'getOrderFromTransaksi',
                    'getOrderFromTransaksi.getDetailOrderFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder.getTravelFromProduk'])
                    ->first();
                break;

            case 'Bimbel':
                $data = TransaksiModel::where('id', $id)->with([
                    'getOrderFromTransaksi',
                    'getOrderFromTransaksi.getDetailOrderFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder.getBimbelFromProduk'])
                    ->first();
                break;

            default:
                $data = TransaksiModel::where('id', $id)->with([
                    'getOrderFromTransaksi',
                    'getOrderFromTransaksi.getDetailOrderFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder',
                    'getOrderFromTransaksi.getProdukFromOrder.getJasaFotoFromProduk'])
                    ->first();
                break;
        }

        $pdf = PDF::loadView('user.transaksi.cetak', ['data' => $data])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function LaporanTravel()
    {
        $getProduk = ProdukModel::where('kategori', 'Travel')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
                'getAdminFromTransaksi',
                'getOrderFromTransaksi',
                'getOrderFromTransaksi.getAdminFromOrder',
                'getOrderFromTransaksi.getDetailOrderFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder.getTravelFromProduk'])
            ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
                $q->whereIn('produk_id', $getProduk);
            })
            ->get();
        return view('laporan.transaksi-travel.index', compact('data'));
    }

    public function CetakLaporanTravel(Request $request)
    {
        $date = explode('-', $request->filter);
        $start = \Carbon\Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = \Carbon\Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $getProduk = ProdukModel::where('kategori', 'Travel')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
            'getAdminFromTransaksi',
            'getOrderFromTransaksi',
            'getOrderFromTransaksi.getAdminFromOrder',
            'getOrderFromTransaksi.getDetailOrderFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder.getTravelFromProduk'])
        ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
            $q->whereIn('produk_id', $getProduk);
        })
        ->whereBetween('created_at', [$start, $end])
        ->get();

        $pdf = PDF::loadView('laporan.transaksi-travel.cetak', ['data' => $data, 'ndate' => $date])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function LaporanBimbel()
    {
        $getProduk = ProdukModel::where('kategori', 'Bimbel')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
                'getAdminFromTransaksi',
                'getOrderFromTransaksi',
                'getOrderFromTransaksi.getAdminFromOrder',
                'getOrderFromTransaksi.getDetailOrderFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder.getBimbelFromProduk'])
            ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
                $q->whereIn('produk_id', $getProduk);
            })
            ->get();
        return view('laporan.transaksi-bimbel.index', compact('data'));
    }

    public function CetakLaporanBimbel(Request $request)
    {
        $date = explode('-', $request->filter);
        $start = \Carbon\Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = \Carbon\Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $getProduk = ProdukModel::where('kategori', 'Bimbel')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
            'getAdminFromTransaksi',
            'getOrderFromTransaksi',
            'getOrderFromTransaksi.getAdminFromOrder',
            'getOrderFromTransaksi.getDetailOrderFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder.getBimbelFromProduk'])
        ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
            $q->whereIn('produk_id', $getProduk);
        })
        ->whereBetween('created_at', [$start, $end])
        ->get();

        $pdf = PDF::loadView('laporan.transaksi-bimbel.cetak', ['data' => $data, 'ndate' => $date])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function LaporanJasaFoto()
    {
        $getProduk = ProdukModel::where('kategori', 'Foto')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
                'getAdminFromTransaksi',
                'getOrderFromTransaksi',
                'getOrderFromTransaksi.getAdminFromOrder',
                'getOrderFromTransaksi.getDetailOrderFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder',
                'getOrderFromTransaksi.getProdukFromOrder.getJasaFotoFromProduk'])
            ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
                $q->whereIn('produk_id', $getProduk);
            })
            ->get();
        return view('laporan.transaksi-jasa-foto.index', compact('data'));
    }

    public function CetakLaporanJasaFoto(Request $request)
    {
        $date = explode('-', $request->filter);
        $start = \Carbon\Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = \Carbon\Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $getProduk = ProdukModel::where('kategori', 'Foto')->pluck('id')->toArray();

        $data = TransaksiModel::where('status', 'Diterima')->with([
            'getAdminFromTransaksi',
            'getOrderFromTransaksi',
            'getOrderFromTransaksi.getAdminFromOrder',
            'getOrderFromTransaksi.getDetailOrderFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder',
            'getOrderFromTransaksi.getProdukFromOrder.getJasaFotoFromProduk'])
        ->whereHas('getOrderFromTransaksi',  function($q) use($getProduk)  {
            $q->whereIn('produk_id', $getProduk);
        })
        ->whereBetween('created_at', [$start, $end])
        ->get();

        $pdf = PDF::loadView('laporan.transaksi-jasa-foto.cetak', ['data' => $data, 'ndate' => $date])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}

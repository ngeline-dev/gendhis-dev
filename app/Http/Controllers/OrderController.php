<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\OrderModel;
use App\Models\DetailOrderModel;
use App\Models\TransaksiModel;
use Validator, Auth, Alert;

class OrderController extends Controller
{
    public function FormOrder($id)
    {
        $data = ProdukModel::where('id', $id)
            ->with(['getTravelFromProduk','getBimbelFromProduk','getJasaFotoFromProduk'])->first();
        return view('user.order.index', compact('data'));
    }

    public function StoreOrder(Request $request, $id)
    {
        $dataProduk = ProdukModel::where('id', $id)->first();
        $now = \Carbon\Carbon::now()->subDays('1')->format('Y-m-d');

        switch ($dataProduk->kategori) {
            case 'Travel':
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'min:16'],
                ];
                break;

            case 'Bimbel':
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    // 'ktp' => ['required', 'min:16'],
                    'anak' => ['required'],
                    'usia' => ['required'],
                ];
                break;

            default:
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'min:16'],
                    'tanggal' => ['required','after:'.$now],
                    'alamat' => ['required'],
                ];
                break;
        }

        $messages = [];

        $attributes = [
            'nama' => 'Nama Pemesan',
            'telepon' => 'Telepon Pemesan',
            'ktp' => 'KTP Pemesan',
            'anak' => 'Anak Yang Didaftarkan',
            'usia' => 'Usia Anak Yang Didaftarkan',
            'tanggal' => 'Tanggal Pemesanan',
            'alamat' => 'Alamat Pemesanan',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = new OrderModel;
            $data->produk_id = $id;
            $data->users_id = Auth::user()->id;
            $data->save();

            $detail = new DetailOrderModel;
            $detail->order_id = $data->id;
            $detail->nama_pemesan = $request->nama;
            $detail->nomor_telepon_pemesan = $request->telepon;
            $detail->nomor_ktp_pemesan = $request->ktp;

            switch ($dataProduk->kategori) {
                case 'Bimbel':
                    $detail->bi_nama_anak = $request->anak;
                    $detail->bi_usia_anak = $request->usia;
                    break;

                case 'Foto':
                    $detail->ft_tanggal_pemesanan = $request->tanggal;
                    $detail->ft_alamat_pemesanan = $request->alamat;
                    break;

                default:
                    break;
            }

            $detail->save();

            $transaksi = new TransaksiModel;
            $transaksi->order_id = $data->id;
            $transaksi->save();

            Alert::success('Berhasil Melakukan Pemesanan');

            return redirect()->route('history.order');
        }
    }

    public function HistoryOrder()
    {
        $data = OrderModel::where('users_id', Auth::user()->id)->with(['getDetailOrderFromOrder','getProdukFromOrder.getTravelFromProduk','getProdukFromOrder.getBimbelFromProduk','getProdukFromOrder.getJasaFotoFromProduk','getTransaksiFromOrder'])->latest()->get();
        return view('user.order.show', compact('data'));
    }

    public function ListOrderTravel()
    {
        $getProduk = ProdukModel::where('kategori', 'Travel')->pluck('id')->toArray();

        $data = OrderModel::whereIn('produk_id', $getProduk)
            ->with([
                'getDetailOrderFromOrder',
                'getProdukFromOrder.getTravelFromProduk',
                'getTransaksiFromOrder'])
            ->latest()->get();
        return view('admin.list-order-travel.index', compact('data'));
    }

    public function ListOrderTravelCreate()
    {
        $data = ProdukModel::where('kategori', 'Travel')->with(['getTravelFromProduk'])->get();
        return view('admin.list-order-travel.create', compact('data'));
    }

    public function ListOrderBimbelCreate()
    {
        $data = ProdukModel::where('kategori', 'Bimbel')->with(['getBimbelFromProduk'])->get();
        return view('admin.list-order-bimbel.create', compact('data'));
    }

    public function ListOrderJasaFotoCreate()
    {
        $data = ProdukModel::where('kategori', 'Foto')->with(['getJasaFotoFromProduk'])->get();
        return view('admin.list-order-jasa-foto.create', compact('data'));
    }

    public function OfflineStore(Request $request)
    {
        $now = \Carbon\Carbon::now()->subDays('1')->format('Y-m-d');

        switch ($request->kategori) {
            case 'Travel':
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'min:16'],
                    'paket' => ['required']
                ];
                break;

            case 'Bimbel':
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    // 'ktp' => ['required', 'min:16'],
                    'anak' => ['required'],
                    'usia' => ['required'],
                    'paket' => ['required']
                ];
                break;

            default:
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'min:16'],
                    'tanggal' => ['required','after:'.$now],
                    'alamat' => ['required'],
                    'paket' => ['required']
                ];
                break;
        }

        $messages = [];

        $attributes = [
            'nama' => 'Nama Pemesan',
            'telepon' => 'Telepon Pemesan',
            'ktp' => 'KTP Pemesan',
            'anak' => 'Anak Yang Didaftarkan',
            'usia' => 'Usia Anak Yang Didaftarkan',
            'tanggal' => 'Tanggal Pemesanan',
            'alamat' => 'Alamat Pemesanan',
            'paket' => 'Paket Pesanan'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $produk = ProdukModel::where('id', $request->paket)
                ->with([
                    'getTravelFromProduk',
                    'getBimbelFromProduk',
                    'getJasaFotoFromProduk'])
                ->first();

            $data = new OrderModel;
            $data->produk_id = $request->paket;
            $data->users_id = Auth::user()->id;
            $data->admin_id = Auth::user()->id;
            $data->status = 'Diterima';
            $data->save();

            $detail = new DetailOrderModel;
            $detail->order_id = $data->id;
            $detail->nama_pemesan = $request->nama;
            $detail->nomor_telepon_pemesan = $request->telepon;
            $detail->nomor_ktp_pemesan = $request->ktp;

            switch ($request->kategori) {
                case 'Bimbel':
                    $detail->bi_nama_anak = $request->anak;
                    $detail->bi_usia_anak = $request->usia;
                    break;

                case 'Foto':
                    $detail->ft_tanggal_pemesanan = $request->tanggal;
                    $detail->ft_alamat_pemesanan = $request->alamat;
                    break;

                default:
                    break;
            }

            $detail->save();

            $transaksi = new TransaksiModel;
            $transaksi->order_id = $data->id;
            $transaksi->admin_id = Auth::user()->id;
            $transaksi->jenis_pembayaran = 'Offline';

            if ($produk->getTravelFromProduk) {
                $transaksi->total_pembayaran = $produk->getTravelFromProduk->harga_paket;
            }
            if ($produk->getBimbelFromProduk) {
                $transaksi->total_pembayaran = $produk->getBimbelFromProduk->harga_paket;
            }
            if ($produk->getJasaFotoFromProduk) {
                $transaksi->total_pembayaran = $produk->getJasaFotoFromProduk->harga_paket;
            }

            $transaksi->status = 'Diterima';
            $transaksi->expired_at = \Carbon\Carbon::now()->subDays(2)->format('Y-m-d H:i:s');
            $transaksi->save();

            switch ($request->kategori) {
                case 'Travel':
                    Alert::success('Berhasil Melakukan Pemesanan');
                    return redirect()->route('list-order.travel');
                    break;

                case 'Bimbel':
                    Alert::success('Berhasil Melakukan Pemesanan');
                    return redirect()->route('list-order.bimbel');
                    break;

                default:
                    Alert::success('Berhasil Melakukan Pemesanan');
                    return redirect()->route('list-order.foto');
                    break;
            }
        }
    }

    public function ListOrderBimbel()
    {
        $getProduk = ProdukModel::where('kategori', 'Bimbel')->pluck('id')->toArray();

        $data = OrderModel::whereIn('produk_id', $getProduk)
            ->with([
                'getDetailOrderFromOrder',
                'getProdukFromOrder.getBimbelFromProduk',
                'getTransaksiFromOrder'])
            ->latest()->get();
        return view('admin.list-order-bimbel.index', compact('data'));
    }

    public function ListOrderJasaFoto()
    {
        $getProduk = ProdukModel::where('kategori', 'Foto')->pluck('id')->toArray();

        $data = OrderModel::whereIn('produk_id', $getProduk)
            ->with([
                'getDetailOrderFromOrder',
                'getProdukFromOrder.getJasaFotoFromProduk',
                'getTransaksiFromOrder'])
            // ->whereHas('getTransaksiFromOrder',  function($q) {
            //     $q->where('status', 'Diterima');
            // })
            ->latest()->get();
        return view('admin.list-order-jasa-foto.index', compact('data'));
    }

    public function KonfirmasiOrder(Request $request, $id)
    {
        if ($request->status == 'Dibatalkan') {
            $rules = [
                'status' => ['required'],
                'alasan' => ['required'],
            ];
        } else {
            $rules = [
                'status' => ['required'],
            ];
        }

        $messages = [];

        $attributes = [
            'status' => 'Status Pemesanan',
            'alasan' => 'Alasan Dibatalkan',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            Alert::error('Terjadi Kesalahan');
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            OrderModel::where('id', $id)->update([
                'status' => $request->status,
                'alasan_pembatalan' => $request->alasan,
                'admin_id' => Auth::user()->id
            ]);

            TransaksiModel::where('order_id', $id)->update([
                'expired_at' => \Carbon\Carbon::now()->subDays(2)->format('Y-m-d H:i:s')
            ]);

            Alert::success('Berhasil Melakukan Konfirmasi Pemesanan');

            switch ($request->kategori) {
                case 'Travel':
                    return redirect()->route('list-order.travel');
                    break;

                case 'Bimbel':
                    return redirect()->route('list-order.bimbel');
                    break;

                default:
                    return redirect()->route('list-order.foto');
                    break;
            }
        }
    }

    public function KonfirmasiPembayaran(Request $request, $id)
    {
        if ($request->status == 'Dibatalkan') {
            $rules = [
                'status' => ['required'],
                'alasan' => ['required'],
            ];
        } else {
            $rules = [
                'status' => ['required'],
            ];
        }

        $messages = [];

        $attributes = [
            'status' => 'Status Pembayaran',
            'alasan' => 'Alasan Dibatalkan',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            Alert::error('Terjadi Kesalahan');
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            TransaksiModel::where('order_id', $id)->update([
                'status' => $request->status,
                'alasan_pembatalan' => $request->alasan,
                'admin_id' => Auth::user()->id,
            ]);

            Alert::success('Berhasil Melakukan Konfirmasi Pembayaran');

            switch ($request->kategori) {
                case 'Travel':
                    return redirect()->route('list-order.travel');
                    break;

                case 'Bimbel':
                    return redirect()->route('list-order.bimbel');
                    break;

                default:
                    return redirect()->route('list-order.foto');
                    break;
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\OrderModel;
use App\Models\DetailOrderModel;
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
                    'ktp' => ['required', 'min:16'],
                    'anak' => ['required'],
                    'usia' => ['required'],
                ];
                break;

            default:
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'min:16'],
                    'tanggal' => ['required'],
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

            Alert::success('Berhasil Melakukan Pemesanan');

            return redirect()->route('history.order');
        }
    }

    public function HistoryOrder()
    {
        $data = OrderModel::with(['getDetailOrderFromOrder','getProdukFromOrder.getTravelFromProduk','getProdukFromOrder.getBimbelFromProduk','getProdukFromOrder.getJasaFotoFromProduk','getTransaksiFromOrder'])->get();
        return view('user.order.show', compact('data'));
    }
}

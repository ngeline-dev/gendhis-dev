<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\TransaksiModel;
use Validator, Alert, File;

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
}

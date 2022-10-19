<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;

class OrderController extends Controller
{
    public function FormOrder($id)
    {
        $data = ProdukModel::where('id', $id)
            ->with(['getTravelFromProduk','getBimbelFromProduk','getJasaFotoFromProduk'])->first();
        return view('user.order.index', compact('data'));
    }

    public function StoreOrder($id)
    {
        $dataProduk = ProdukModel::where('id', $id)->first();

        switch ($dataProduk->kategori) {
            case 'Travel':
                $rules = [
                    'nama' => ['required'],
                    'telepon' => ['required'],
                    'ktp' => ['required', 'numeric|min:2'],
                    'harga' => ['required'],
                    'jadwal' => ['required',],
                    'waktu' => ['required'],
                ];
                break;

            case 'Bimbel':
                $rules = [
                    'nama' => ['required'],
                    'deskripsi' => ['required'],
                    'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
                    'harga' => ['required'],
                    'jadwal' => ['required',],
                    'waktu' => ['required'],
                ];
                break;

            default:
                $rules = [
                    'nama' => ['required'],
                    'deskripsi' => ['required'],
                    'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
                    'harga' => ['required'],
                    'jadwal' => ['required',],
                    'waktu' => ['required'],
                ];
                break;
        }

        $messages = [];

        $attributes = [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'foto' => 'Foto Paket',
            'harga' => 'Harga Paket',
            'jadwal' => 'Jadwal Bimbel',
            'waktu' => 'Waktu Bimbel',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = MasterBimbelModel::where('id', $id)->first();
            $data->nama_paket = $request->nama;
            $data->deskripsi_paket = $request->deskripsi;

            if ($request->hasFile('foto')){
                $file = $request->file('foto');
                $filename = time()."_".$file->getClientOriginalName();
                $file->move(public_path('assets/img'), $filename);

                $path = public_path() . '/assets/img/' . $data->foto_paket;
                File::delete($path);

                $data->foto_paket = $filename;
            }
            $data->harga_paket = $request->harga;
            $data->jadwal_bimbel = $request->jadwal;
            $data->waktu_bimbel = \Carbon\Carbon::parse($request->waktu)->format('H:i');

            $data->save();

            Alert::success('Berhasil Memperbarui Data');

            return redirect()->route('master-bimbel.index');
        }
    }
}

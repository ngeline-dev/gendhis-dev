<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBimbelModel;
use App\Models\ProdukModel;
use Validator, Alert, File;

class MasterBimbelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MasterBimbelModel::where('status', 'Aktif')->latest()->get();
        return view('admin.master-bimbel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master-bimbel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
            'harga' => ['required'],
            'jadwal' => ['required'],
            'waktu' => ['required'],
        ];

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
            $produk = new ProdukModel;
            $produk->kategori = 'Bimbel';
            $produk->save();

            $data = new MasterBimbelModel;
            $data->produk_id = $produk->id;
            $data->nama_paket = $request->nama;
            $data->deskripsi_paket = $request->deskripsi;

            if ($request->hasFile('foto')){
                $file = $request->file('foto');
                $filename = time()."_".$file->getClientOriginalName();
                $file->move(public_path('assets/img'), $filename);

                $data->foto_paket = $filename;
            }
            $data->harga_paket = $request->harga;
            $data->jadwal_bimbel = $request->jadwal;
            $data->waktu_bimbel = \Carbon\Carbon::parse($request->waktu)->format('H:i');

            $data->save();

            Alert::success('Berhasil Menambahkan Data');

            return redirect()->route('master-bimbel.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MasterBimbelModel::where('id', $id)->first();
        return view('admin.master-bimbel.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('foto_paket')) {
            $rules = [
                'nama' => ['required'],
                'deskripsi' => ['required'],
                'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
                'harga' => ['required'],
                'jadwal' => ['required',],
                'waktu' => ['required'],
            ];
        } else {
            $rules = [
                'nama' => ['required'],
                'deskripsi' => ['required'],
                'harga' => ['required'],
                'jadwal' => ['required'],
                'waktu' => ['required'],
            ];
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterBimbelModel::where('id', $id)->update(['status' => 'Tidak']);

        Alert::success('Berhasil Menghapus Data');

        return redirect()->route('master-bimbel.index');
    }
}

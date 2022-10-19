<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJasaFotoModel;
use App\Models\ProdukModel;
use Validator, Alert, File;

class MasterJasaFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MasterJasaFotoModel::where('status', 'Aktif')->latest()->get();
        return view('admin.master-jasa-foto.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master-jasa-foto.create');
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
        ];

        $messages = [];

        $attributes = [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'foto' => 'Foto Paket',
            'harga' => 'Harga Paket',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $produk = new ProdukModel;
            $produk->kategori = 'Foto';
            $produk->save();

            $data = new MasterJasaFotoModel;
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

            $data->save();

            Alert::success('Berhasil Menambahkan Data');

            return redirect()->route('master-jasa-foto.index');
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
        $data = MasterJasaFotoModel::where('id', $id)->first();
        return view('admin.master-jasa-foto.edit', compact('data'));
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
            ];
        } else {
            $rules = [
                'nama' => ['required'],
                'deskripsi' => ['required'],
                'harga' => ['required'],
            ];
        }

        $messages = [];

        $attributes = [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'foto' => 'Foto Paket',
            'harga' => 'Harga Paket',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = MasterJasaFotoModel::where('id', $id)->first();
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

            $data->save();

            Alert::success('Berhasil Memperbarui Data');

            return redirect()->route('master-jasa-foto.index');
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
        MasterJasaFotoModel::where('id', $id)->update(['status' => 'Tidak']);

        Alert::success('Berhasil Menghapus Data');

        return redirect()->route('master-jasa-foto.index');
    }
}

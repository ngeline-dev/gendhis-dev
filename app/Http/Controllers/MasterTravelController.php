<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTravelModel;
use App\Models\ProdukModel;
use Validator, Alert, File;

class MasterTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MasterTravelModel::where('status', 'Aktif')->latest()->get();
        return view('admin.master-travel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master-travel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = \Carbon\Carbon::now()->subDays('1')->format('Y-m-d');
        $rules = [
            'nama' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
            'harga' => ['required'],
            'tanggal' => ['required','after:'.$now],
            'waktu' => ['required'],
        ];

        $messages = [];

        $attributes = [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'foto' => 'Foto Paket',
            'harga' => 'Harga Paket',
            'tanggal' => 'Tanggal Travel',
            'waktu' => 'Waktu Travel',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $produk = new ProdukModel;
            $produk->kategori = 'Travel';
            $produk->save();

            $data = new MasterTravelModel;
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
            $data->tanggal_travel = \Carbon\Carbon::parse($request->tanggal)->format('Y-m-d');
            $data->waktu_travel = \Carbon\Carbon::parse($request->waktu)->format('H:i');

            $data->save();

            Alert::success('Berhasil Menambahkan Data');

            return redirect()->route('master-travel.index');
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
        $data = MasterTravelModel::where('id', $id)->first();
        return view('admin.master-travel.edit', compact('data'));
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
        $now = \Carbon\Carbon::now()->subDays('1')->format('Y-m-d');

        if ($request->hasFile('foto_paket')) {
            $rules = [
                'nama' => ['required'],
                'deskripsi' => ['required'],
                'foto' => ['required', 'file', 'mimes:png,jpg,jpeg'],
                'harga' => ['required'],
                'tanggal' => ['required','after:'.$now],
                'waktu' => ['required'],
            ];
        } else {
            $rules = [
                'nama' => ['required'],
                'deskripsi' => ['required'],
                'harga' => ['required'],
                'tanggal' => ['required','after:'.$now],
                'waktu' => ['required'],
            ];
        }

        $messages = [];

        $attributes = [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'foto' => 'Foto Paket',
            'harga' => 'Harga Paket',
            'tanggal' => 'Tanggal Travel',
            'waktu' => 'Waktu Travel',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = MasterTravelModel::where('id', $id)->first();
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
            $data->tanggal_travel = \Carbon\Carbon::parse($request->tanggal)->format('Y-m-d');
            $data->waktu_travel = \Carbon\Carbon::parse($request->waktu)->format('H:i');

            $data->save();

            Alert::success('Berhasil Memperbarui Data');

            return redirect()->route('master-travel.index');
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
        MasterTravelModel::where('id', $id)->update(['status' => 'Tidak']);

        Alert::success('Berhasil Menghapus Data');

        return redirect()->route('master-travel.index');
    }
}

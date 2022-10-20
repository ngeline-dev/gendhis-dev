<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator, Alert, File;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', 'Admin')->latest()->get();
        return view('owner.akun.index', compact('data'));
    }

    public function create()
    {
        return view('owner.akun.create');
    }

    public function store(Request $request)
    {

            $data = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $data->save();

            Alert::success('Berhasil Menambahkan Data');

            return redirect()->route('master-travel.index');
        
    }
    
    // Membuat Role Admin
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Berhasil Tambah Data '.$user-> name);
    }

    // edit
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('owner.akun.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = User::where('id', $request->id)->first();
        $data->name = $request->name;
        $data->role = $request->role;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        Alert::success('Berhasil Menambah Data');


        return redirect()->route('master-kelolaadmin.index');
    }

    // Hapus Akun Ademin
    public function destroy($id)
    {
        //memanggil model, query dengan kondisi where frist
        $data = User::where('id', $id)->first();
        $data->delete();

        //redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Berhasil Hapus Data '.$data->name);
    }

    public function laporan(Request $request)
    {
            $transaksi =  DB::table('tb_transaksi')
            ->get();
            return view('owner.laporan.index');
    }

    
}

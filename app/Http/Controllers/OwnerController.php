<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // Dashboard Owner
    public function show()
    {
        return view('owner.index' );
    }

    public function index(Request $request)
    {
        return view('owner.akun.kelolaakun');
    }

    public function kelolaakun(Request $request)
    {
        $cari=$request->input('cari');
        if(empty($cari)){
            $ndata = User::paginate(5);
        }
        return view('owner.akun.kelolaakun', compact('ndata'));
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
        //memanggil model, query funsi cari
        $data = User::find($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = User::where('id',$request->id)->first();
        // $data = Role::where('id', $request->$role_id)->get();

        $data->name = $request->name;
        $data->role = $request->role;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();

        return redirect()->back()->with('success', 'Berhasil Edit Data '.$data-> name);
    }

    // Hapus Akun Ademin
    public function destroy($id)
    {
        //memanggil model, query dengan kondisi where frist
        $data = AdminModel::where('id', $id)->first();
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

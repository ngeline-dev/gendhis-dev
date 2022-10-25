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
        $data = User::where('role', 'Admin')->where('status', 'Aktif')->latest()->get();
        return view('owner.akun.index', compact('data'));
    }

    public function create()
    {
        return view('owner.akun.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
        ];

        $messages = [];

        $attributes = [
            'name' => 'Nama Admin',
            'email' => 'Email Admin',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = User::create([
                'name' => $request->name,
                'role' => 'Admin',
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'status' => 'Aktif',
            ]);

            $data->save();

            Alert::success('Berhasil Menambahkan Data');

            return redirect()->route('master-kelolaadmin.index');
        }
    }

    // Membuat Role Admin
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'role' => 'Admin',
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'status' => 'Aktif',
        ]);

        Alert::success('Berhasil Menambahkan Data');

        return redirect()->route('master-kelolaadmin.index');
    }

    // edit
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('owner.akun.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        if ($data->email == $request->email) {
            $rules = [
                'name' => ['required'],
            ];
        } else {
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
            ];
        }

        $messages = [];

        $attributes = [
            'name' => 'Nama Admin',
            'email' => 'Email Admin',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {

            $data->name = $request->name;
            $data->role = $request->role;
            $data->email = $request->email;
            // $data->password = Hash::make('12345678');
            $data->save();

            Alert::success('Berhasil Memperbarui Data');

            return redirect()->route('master-kelolaadmin.index');
        }
    }

    // Hapus Akun Ademin
    public function destroy($id)
    {
        //memanggil model, query dengan kondisi where frist
        User::where('id', $id)->update(['status' => 'Tidak']);

        Alert::success('Berhasil Hapus Data');

        return redirect()->route('master-kelolaadmin.index');
    }

    public function laporan(Request $request)
    {
            $transaksi =  DB::table('tb_transaksi')
            ->get();
            return view('owner.laporan.index');
    }


}

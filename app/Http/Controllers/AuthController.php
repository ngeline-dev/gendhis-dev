<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth, Validator, Alert;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function postLogin(Request $request){
        if (Auth::attempt($request->only('email', 'password'))){
            $userStatus = Auth::user()->status;
            $userRole = Auth::user()->role;

            if ($userStatus == 'Aktif') {
                if ($userRole != 'Customer') {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('beranda');
                }
            } else {
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(['email' => 'Akun Anda sudah kadaluarsa']);
            }
        }
        else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Akun Anda tidak ditemukan']);
        }
    }

    public function postRegister(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $messages = [];

        $attributes = [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if(!$validator->passes()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        } else {
            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->role = 'Customer';

            $data->save();

            Alert::success('Berhasil Melakukan Registrasi');

            return redirect()->route('login');
        }
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }
}

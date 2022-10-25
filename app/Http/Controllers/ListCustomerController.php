<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ListCustomerController extends Controller
{
    public function ListCustomer()
    {
        $data = User::where('status', 'Aktif')->where('role', 'Customer')->get();
        return view('admin.list-user.index', compact('data'));
    }
}

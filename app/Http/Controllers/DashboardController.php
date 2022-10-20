<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlTravel = TransaksiModel::where('status', 'Diterima')->with([
            'getOrderFromTransaksi.getProdukFromOrder'])
        ->whereHas('getOrderFromTransaksi.getProdukFromOrder',  function($q) {
            $q->where('kategori', 'Travel');
        })
        ->count('id');

        $jmlBimbel = TransaksiModel::where('status', 'Diterima')->with([
            'getOrderFromTransaksi.getProdukFromOrder'])
        ->whereHas('getOrderFromTransaksi.getProdukFromOrder',  function($q) {
            $q->where('kategori', 'Bimbel');
        })
        ->count('id');

        $jmlFoto = TransaksiModel::where('status', 'Diterima')->with([
            'getOrderFromTransaksi.getProdukFromOrder'])
        ->whereHas('getOrderFromTransaksi.getProdukFromOrder',  function($q) {
            $q->where('kategori', 'Foto');
        })
        ->count('id');

        $pendapatan = TransaksiModel::where('status', 'Diterima')->sum('total_pembayaran');

        $data = [$jmlTravel, $jmlBimbel, $jmlFoto, $pendapatan];

        return view('dashboard.index', compact('data'));
    }

    public function indexcust()
    {
        return view('user.beranda');
    }
}

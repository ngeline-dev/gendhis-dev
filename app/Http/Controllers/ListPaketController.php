<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTravelModel;
use App\Models\MasterBimbelModel;
use App\Models\MasterJasaFotoModel;

class ListPaketController extends Controller
{
    public function ListTravel()
    {
        $data = MasterTravelModel::where('status', 'Aktif')->get();
        return view('user.list-paket-travel.index', compact('data'));
    }

    public function ListBimbel()
    {
        $data = MasterBimbelModel::where('status', 'Aktif')->get();
        return view('user.list-paket-bimbel.index', compact('data'));
    }

    public function ListJasaFoto()
    {
        $data = MasterJasaFotoModel::where('status', 'Aktif')->get();
        return view('user.list-paket-jasa-foto.index', compact('data'));
    }
}

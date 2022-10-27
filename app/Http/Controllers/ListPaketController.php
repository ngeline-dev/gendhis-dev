<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTravelModel;
use App\Models\MasterBimbelModel;
use App\Models\MasterJasaFotoModel;

class ListPaketController extends Controller
{
    public function ListTravel(Request $request)
    {
        if ($request->cari) {
            $data = MasterTravelModel::where('status', 'Aktif')->where('nama_paket', 'like', '%' . $request->cari . '%')->get();
            $msg = $request->cari;
        } else {
            $msg = '';
            $data = MasterTravelModel::where('status', 'Aktif')->get();
        }

        return view('user.list-paket-travel.index', compact('data','msg'));
    }

    public function ListBimbel(Request $request)
    {
        if ($request->cari) {
            $data = MasterBimbelModel::where('status', 'Aktif')->where('nama_paket', 'like', '%' . $request->cari . '%')->get();
            $msg = $request->cari;
        } else {
            $msg = '';
            $data = MasterBimbelModel::where('status', 'Aktif')->get();
        }

        return view('user.list-paket-bimbel.index', compact('data','msg'));
    }

    public function ListJasaFoto(Request $request)
    {
        if ($request->cari) {
            $data = MasterJasaFotoModel::where('status', 'Aktif')->where('nama_paket', 'like', '%' . $request->cari . '%')->get();
            $msg = $request->cari;
        } else {
            $msg = '';
            $data = MasterJasaFotoModel::where('status', 'Aktif')->get();
        }

        return view('user.list-paket-jasa-foto.index', compact('data','msg'));
    }
}

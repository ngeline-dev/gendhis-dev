@extends('layouts.appcust')

@section('content')
<div class="container py-4">
<br><br><br>
    <center>
        <h2>PAKET BIMBEL<h2>
    </center>
        <br>
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page" >Daftar Paket Bimbel</li>
                            
                    <div class="col-md-7" style="position: absoulte; top: 5%; left: 56%">
                        <div class="input-group mb-3">
                        <form action="{{ url('cari') }}" method="GET">
                            <input type="text" name="name" placeholder="Cari..." class="form-control bg-light" style="color: black;" >
                        </form>
                            <div class="input-group-prepend">
                                <span class="input-group-text"  style="background-color: #8B0000;" id="basic-addon1">
                                    <i class="fas fa-search" style="color: white;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </ol>
                    
            </nav>
        </div>
                            
    </div>

    <section class="layanan" id="layanan">
        <br>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="row">
                            @forelse ($data as $ndata)
                                <div class="col-md-3 mt-3 mb-3">
                                    <div class="card">
                                        <div class="card-header bg-secondry text-black">
                                            <center>
                                            </center>
                                            <img src="/assets/img/{{ $ndata->foto_paket }}" width="100px" height="150px"
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body text-center">
                                            <h4>
                                                {{ $ndata->nama_paket }}<br>
                                                <span class="text-success">Rp
                                                    {{ number_format($ndata->harga_paket, 2, ',', '.') }}</span>
                                            </h4>
                                            <h6 class="text-muted">
                                                {{ $ndata->deskripsi_paket }} <br>
                                                Jadwal bimbel
                                                {{ $ndata->jadwal_bimbel }},
                                                Pukul
                                                {{ \Carbon\Carbon::parse($ndata->waktu_bimbel)->format('H:i') }}
                                            </h6>

                                            <div class="mt-3 text-center" role="group" aria-label="Basic example">
                                                <a href="{{ route('form.order', ['id' => $ndata->produk_id]) }}"
                                                    class="btn btn-primary">Pilih Paket</i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <h3>Data yang Anda cari tidak ada</h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('title', 'Edit Data Bimbel')
@section('heading', 'Edit Data Bimbel')
@section('page', 'Edit Data Bimbel')
@section('detailpage', '')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{ route('master-bimbel.update', ['master_bimbel' => $data->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama Paket</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Nama Paket" value="{{ old('nama', $data->nama_paket) }}"
                                autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Deskripsi Paket</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                name="deskripsi" id="deskripsi" placeholder="Deskripsi Paket Paket"
                                value="{{ old('deskripsi', $data->deskripsi_paket) }}" autofocus>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Upload File Foto</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                id="foto" value="{{ old('foto') }}">
                            @error('foto')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Harga Paket</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                                id="harga" placeholder="Harga Paket" value="{{ old('harga', $data->harga_paket) }}">
                            @error('harga')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Jadwal Bimbel</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('jadwal') is-invalid @enderror" name="jadwal"
                                id="jadwal" value="{{ old('jadwal', $data->jadwal_bimbel) }}" autofocus>
                            @error('jadwal')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Waktu Bimbel</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control @error('waktu') is-invalid @enderror" name="waktu"
                                id="waktu" placeholder="Waktu Travel" value="{{ old('waktu', $data->waktu_bimbel) }}"
                                autofocus>
                            @error('waktu')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div><br></div>
                    <a href="{{ route('master-bimbel.index') }}" class="btn icon icon-left btn-warning"><i
                            data-feather="info"></i> Kembali</a>
                    <button type="submit" class="btn icon icon-left btn-primary col-sm-2"><i data-feather="edit"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('title', 'Pesan Offline Studio Foto')
@section('heading', 'Pesan Offline Studio Foto')
@section('page', 'Pesan Offline Studio Foto')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pemesanan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('offline.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama Pemesan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Nama Pemesan" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nomor NIK Pemesan</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('ktp') is-invalid @enderror" name="ktp"
                                id="ktp" placeholder="No KTP Pemesan" value="{{ old('ktp') }}" autofocus>
                            @error('ktp')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nomor HP Pemesan</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                id="telepon" value="{{ old('telepon') }}" placeholder="No HP Pemesan">
                            @error('telepon')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                id="tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal Pemesanan">
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Alamat Pemesan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" placeholder="Alamat Pemesan" value="{{ old('alamat') }}" autofocus>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Kategori Paket Studio Foto</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                name="kategori" id="kategori" placeholder="Kategori Paket Studio Foto" value="Foto"
                                readonly disabled>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Paket Studio Foto</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="paket" id="paket" required>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}"
                                        data-harga="{{ $item->getJasaFotoFromProduk->harga_paket }}">
                                        {{ $item->getJasaFotoFromProduk->nama_paket }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Harga Paket Studio Foto</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="harga" readonly disabled>
                        </div>
                    </div>

                    <div><br></div>
                    <a href="{{ route('list-order.foto') }}" class="btn icon icon-left btn-warning"><i
                            data-feather="info"></i> Kembali</a>
                    <button type="submit" class="btn icon icon-left btn-primary col-sm-2"><i data-feather="edit"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

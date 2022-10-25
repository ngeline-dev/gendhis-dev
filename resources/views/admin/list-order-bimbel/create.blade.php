@extends('layouts.app')
@section('title', 'Pesan Offline Bimbel')
@section('heading', 'Pesan Offline Bimbel')
@section('page', 'Pesan Offline Bimbel')
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
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Nama Pemesan" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nomor HP Pemesan</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                id="telepon" placeholder="No Telepon Pemesan" value="{{ old('telepon') }}" autofocus>
                            @error('telepon')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama Anak</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('anak') is-invalid @enderror" name="anak"
                                id="anak" value="{{ old('anak') }}" placeholder="Nama Anak">
                            @error('anak')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Usia Anak</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('usia') is-invalid @enderror" name="usia"
                                id="usia" placeholder="Usia Anak" value="{{ old('usia') }}">
                            @error('usia')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Kategori Paket Bimbel</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                name="kategori" id="kategori" placeholder="Kategori Paket Bimbel" value="Bimbel" readonly
                                disabled>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Paket Bimbel</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="paket" id="paket" required>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}"
                                        data-harga="{{ $item->getBimbelFromProduk->harga_paket }}">
                                        {{ $item->getBimbelFromProduk->nama_paket }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Harga Paket Bimbel</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="harga" readonly disabled>
                        </div>
                    </div>

                    <div><br></div>
                    <a href="{{ route('list-order.bimbel') }}" class="btn icon icon-left btn-warning"><i
                            data-feather="info"></i> Kembali</a>
                    <button type="submit" class="btn icon icon-left btn-primary col-sm-2"><i data-feather="edit"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

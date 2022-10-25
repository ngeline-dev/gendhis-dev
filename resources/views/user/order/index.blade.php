@extends('layouts.appcust')
@section('content')
    <header class="item1 header margin-top-0"
        style="background-image: url(images/mobil.jpg);  width: 100%;
    height: 500px; " id="section-home"
        data-stellar-background-ratio="0.5">
        <div class="wrapper">
            <div class="container">
                <div class="row intro-text align-items-center justify-content-center">
                    <div class="col-md-10 animated tada">
                        <center>
                            <h1 class="site-heading site-animate" style="font-size: 47px;">
                                <strong class="d-block" data-scrollreveal="enter top over 1.5s after 0.1s">Layanan
                                    Order</strong>
                            </h1><br><br><br><br>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br><br>

    <!-- CONTENT =============================-->
    <section class="item content">
        <div class="container toparea">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems" style="font-size: 18px;">Silahkan isi form dibawah ini :)</h1>
                </div>
                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-2">
                    <form action="{{ route('store.order', ['id' => $data->id]) }}" method="POST" id="contactform">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nama Pemesan</label>
                                <input type="text" class="@error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama') }}" autofocus>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="">No Telepon Pemesan</label>
                                <input type="number" class="@error('telepon') is-invalid @enderror" name="telepon"
                                    value="{{ old('telepon') }}" autofocus>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if ($data->kategori !== 'Bimbel')
                                <div class="col-lg-12">
                                    <label for="">No KTP Pemesan</label>
                                    <input type="text" class="@error('ktp') is-invalid @enderror" name="ktp"
                                        value="{{ old('ktp') }}" autofocus>
                                    @error('ktp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                            @isset($data->getTravelFromProduk)
                                <div class="col-lg-12">
                                    <label for="">Kategori Pemesanan</label>
                                    <input type="text" value="{{ $data->kategori }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Jenis Paket</label>
                                    <input type="text" value="{{ $data->getTravelFromProduk->nama_paket }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Harga Paket</label>
                                    <input type="text" value="{{ $data->getTravelFromProduk->harga_paket }}" readonly>
                                </div>
                            @endisset
                            @isset($data->getBimbelFromProduk)
                                <div class="col-lg-12">
                                    <label for="">Nama Anak Yang Didaftarkan</label>
                                    <input type="text" class="@error('anak') is-invalid @enderror" name="anak"
                                        value="{{ old('anak') }}" autofocus>
                                    @error('anak')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Usia Anak Yang Didaftarkan</label>
                                    <input type="number" class="@error('usia') is-invalid @enderror" name="usia"
                                        value="{{ old('usia') }}" autofocus>
                                    @error('usia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Kategori Pemesanan</label>
                                    <input type="text" value="{{ $data->kategori }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Jenis Paket</label>
                                    <input type="text" value="{{ $data->getBimbelFromProduk->nama_paket }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Harga Paket</label>
                                    <input type="text" value="{{ $data->getBimbelFromProduk->harga_paket }}" readonly>
                                </div>
                            @endisset
                            @isset($data->getJasaFotoFromProduk)
                                <div class="col-lg-12">
                                    <label for="">Tanggal Pemesanan</label>
                                    <input type="date" class="@error('tanggal') is-invalid @enderror" name="tanggal"
                                        value="{{ old('tanggal') }}" autofocus>
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Lokasi Pemesanan</label>
                                    <input type="text" class="@error('alamat') is-invalid @enderror" name="alamat"
                                        value="{{ old('alamat') }}" autofocus>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Kategori Pemesanan</label>
                                    <input type="text" value="{{ $data->kategori }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Jenis Paket</label>
                                    <input type="text" value="{{ $data->getJasaFotoFromProduk->nama_paket }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Harga Paket</label>
                                    <input type="text" value="{{ $data->getJasaFotoFromProduk->harga_paket }}" readonly>
                                </div>
                            @endisset
                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section><br><br>
@endsection

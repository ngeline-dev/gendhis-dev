@extends('layouts.appcust')
@section('content')
    <!-- CONTENT =============================-->
    <div class="container py-4">
        <br><br><br>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('history-order') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history-order') }}"> Riwayat</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Pembayaran</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card shadow">
                    <div class="card-body" style="color: black;">
                        <p>Untuk pembayaran silahkan transfer ke rekening dibawah ini :</p>
                        <div class="media">
                            <img class="mr-3" src="{{ url('images/bri.png') }}" alt="Bank BRI" width="60">
                            <div class="media-body">
                                <h5 class="mt-0" style="color: black;">BANK BRI</h5>
                                transfer Ke NoRek CV Gendhis XXXXXXX-XXXXXXXX-XXXXXXXX atas nama <strong>CV GENDHIS</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 style="color: black;"><i style="color: black;" class="fa fa-pencil-alt"></i> Form pembayaran
                        </h4>
                        @if ($data->getProdukFromOrder->getTravelFromProduk)
                            <h2 style="color: red; font-size: 12pt;" align="right"> Total pembayaran anda adalah Rp.
                                <input type="hidden"
                                    value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}" name="total"
                                    readonly>
                                <input type="text"
                                    value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}" readonly>
                                <h2>
                        @endif
                        @if ($data->getProdukFromOrder->getBimbelFromProduk)
                            <h2 style="color: red; font-size: 12pt;" align="right"> Total pembayaran anda adalah Rp.
                                <input type="hidden"
                                    value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}" name="total"
                                    readonly>
                                <input type="text"
                                    value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}" readonly>
                                <h2>
                        @endif
                        @if ($data->getProdukFromOrder->getJasaFotoFromProduk)
                            <h2 style="color: red; font-size: 12pt;" align="right"> Total pembayaran anda adalah Rp.
                                <input type="hidden"
                                    value="{{ $data->getProdukFromOrder->getJasaFotoFromProduk->harga_paket }}"
                                    name="total" readonly>
                                <input type="text"
                                    value="{{ $data->getProdukFromOrder->getJasaFotoFromProduk->harga_paket }}" readonly>
                                <h2>
                        @endif
                    </div>

                    <div class="col-md-12 mt-2">
                        <form action="{{ route('store.pembayaran', ['id' => $data->id]) }}" method="POST" id="contactform"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Kategori Pemesanan</label>
                                    <input type="text" value="{{ $data->getProdukFromOrder->kategori }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Nama Paket</label>
                                    @if ($data->getProdukFromOrder->getTravelFromProduk)
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getTravelFromProduk->nama_paket }}"
                                            readonly>
                                    @endif
                                    @if ($data->getProdukFromOrder->getBimbelFromProduk)
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getBimbelFromProduk->nama_paket }}"
                                            readonly>
                                    @endif
                                    @if ($data->getProdukFromOrder->getJasaFotoFromProduk)
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}"
                                            readonly>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Nama Pemesan</label>
                                    <input type="text" value="{{ $data->getDetailOrderFromOrder->nama_pemesan }}"
                                        readonly>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Jenis Pembayaran</label>
                                    <input type="text" value="Online" name="jenis" readonly>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="">Pilih Bank</label>
                                    <select name="bank" id="bank" class="w-100 @error('bank') is-invalid @enderror">
                                        <option value="Mandiri" {{ old('bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri
                                        </option>
                                        <option value="BCA" {{ old('bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                        <option value="BRI" {{ old('bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                        <option value="BTN" {{ old('bank') == 'BTN' ? 'selected' : '' }}>BTN</option>
                                        <option value="Lainnya" {{ old('bank') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>

                                    @error('bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Nama Rekening</label>
                                    <input type="text" class="@error('rek') is-invalid @enderror" name="rek"
                                        value="{{ old('rek') }}">

                                    @error('rek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Total Pembayaran</label>
                                    @if ($data->getProdukFromOrder->getTravelFromProduk)
                                        <input type="hidden"
                                            value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}"
                                            name="total" readonly>
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}"
                                            readonly>
                                    @endif
                                    @if ($data->getProdukFromOrder->getBimbelFromProduk)
                                        <input type="hidden"
                                            value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}"
                                            name="total" readonly>
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}"
                                            readonly>
                                    @endif
                                    @if ($data->getProdukFromOrder->getJasaFotoFromProduk)
                                        <input type="hidden"
                                            value="{{ $data->getProdukFromOrder->getJasaFotoFromProduk->harga_paket }}"
                                            name="total" readonly>
                                        <input type="text"
                                            value="{{ $data->getProdukFromOrder->getJasaFotoFromProduk->harga_paket }}"
                                            readonly>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Bukti Pembayaran</label>
                                    <input type="file" class="@error('bukti') is-invalid @enderror" name="bukti"
                                        value="{{ old('bukti') }}">

                                    @error('bukti')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" value="Simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
    @endsection
    @section('js')
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $("#bank").select2({
                theme: "bootstrap",
                minimumResultsForSearch: -1
            });
        </script>
    @endsection

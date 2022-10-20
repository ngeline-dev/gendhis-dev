@extends('layouts.appcust')
@section('content')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3>Pesanan</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Kategori Paket</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pemesanan</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $ndata)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if ($ndata->getProdukFromOrder->getTravelFromProduk)
                                        {{ $ndata->getProdukFromOrder->getTravelFromProduk->nama_paket }}
                                    @endif
                                    @if ($ndata->getProdukFromOrder->getBimbelFromProduk)
                                        {{ $ndata->getProdukFromOrder->getBimbelFromProduk->nama_paket }}
                                    @endif
                                    @if ($ndata->getProdukFromOrder->getJasaFotoFromProduk)
                                        {{ $ndata->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}
                                    @endif
                                </td>
                                <td>
                                    {{ $ndata->getProdukFromOrder->kategori }}
                                </td>
                                <td>
                                    @if ($ndata->getProdukFromOrder->getTravelFromProduk)
                                        {{ $ndata->getProdukFromOrder->getTravelFromProduk->harga_paket }}
                                    @endif
                                    @if ($ndata->getProdukFromOrder->getBimbelFromProduk)
                                        {{ $ndata->getProdukFromOrder->getBimbelFromProduk->harga_paket }}
                                    @endif
                                    @if ($ndata->getProdukFromOrder->getJasaFotoFromProduk)
                                        {{ $ndata->getProdukFromOrder->getJasaFotoFromProduk->harga_paket }}
                                    @endif
                                </td>
                                <td>
                                    {{-- Jika Status Pemesanan Dibatalkan --}}
                                    @if ($ndata->status == 'Dibatalkan')
                                        {{ $ndata->status }} - {{ $ndata->alasan_pembatalan }}
                                    @else
                                        {{ $ndata->status }}
                                    @endif
                                </td>
                                <td>
                                    {{-- Jika Status Pembayaran Ada --}}
                                    @if ($ndata->getTransaksiFromOrder)
                                        {{-- Jika Status Pembayaran Dibatalkan --}}
                                        @if ($ndata->getTransaksiFromOrder->status == 'Dibatalkan')
                                            {{ $ndata->getTransaksiFromOrder->status }} -
                                            {{ $ndata->getTransaksiFromOrder->alasan_pembatalan }}
                                        @else
                                            {{ $ndata->getTransaksiFromOrder->status }}
                                        @endif
                                    @else
                                        {{-- Jika Status Pemesanan Diterima --}}
                                        @if ($ndata->status == 'Diterima')
                                            Menunggu Pembayaran Anda
                                        @else
                                            Menunggu Konfirmasi Pemesanan dari Admin
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- Jika Pemesanan Diterima --}}
                                    @if ($ndata->status == 'Diterima')
                                        {{-- Jika Transaksi Ada --}}
                                        @if ($ndata->getTransaksiFromOrder)
                                            {{-- Jika Transaki Diterima --}}
                                            @if ($ndata->getTransaksiFromOrder->status == 'Diterima')
                                                <a
                                                    href="{{ route('cetak.nota', ['id' => $ndata->getTransaksiFromOrder, 'kategori' => $ndata->getProdukFromOrder->kategori]) }}">Cetak
                                                    Sekarang</a>
                                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                    data-target="#detail{{ $ndata->id }}">Detail
                                                    Pemesanan</button>
                                            @else
                                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                    data-target="#detail{{ $ndata->id }}">Detail
                                                    Pemesanan</button>
                                            @endif
                                        @else
                                            <a href="{{ route('form.pembayaran', ['id' => $ndata->id]) }}">Bayar
                                                Sekarang</a>
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#detail{{ $ndata->id }}">Detail
                                                Pemesanan</button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#detail{{ $ndata->id }}">Detail
                                            Pemesanan</button>
                                    @endif
                                </td>

                                <!-- Modal Detail Pemesanan -->
                                <div id="detail{{ $ndata->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Detail Pemesanan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Detail Paket</h4>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="">Kategori Paket</label>
                                                        <input type="text"
                                                            value="{{ $ndata->getProdukFromOrder->kategori }}" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Nama Paket</label>
                                                        @if ($ndata->getProdukFromOrder->getTravelFromProduk)
                                                            <input type="text"
                                                                value="{{ $ndata->getProdukFromOrder->getTravelFromProduk->nama_paket }}"
                                                                readonly>
                                                        @endif
                                                        @if ($ndata->getProdukFromOrder->getBimbelFromProduk)
                                                            <input type="text"
                                                                value="{{ $ndata->getProdukFromOrder->getBimbelFromProduk->nama_paket }}"
                                                                readonly>
                                                        @endif
                                                        @if ($ndata->getProdukFromOrder->getJasaFotoFromProduk)
                                                            <input type="text"
                                                                value="{{ $ndata->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}"
                                                                readonly>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <h4>Detail Pemesanan</h4>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="">Nama Pemesan</label>
                                                        <input type="text"
                                                            value="{{ $ndata->getDetailOrderFromOrder->nama_pemesan }}"
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Nomor KTP</label>
                                                        <input type="text"
                                                            value="{{ $ndata->getDetailOrderFromOrder->nomor_ktp_pemesan }}"
                                                            readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Nomor Telepon</label>
                                                        <input type="text"
                                                            value="{{ $ndata->getDetailOrderFromOrder->nomor_telepon_pemesan }}"
                                                            readonly>
                                                    </div>
                                                    @if ($ndata->getProdukFromOrder->getBimbelFromProduk)
                                                        <div class="col-lg-6">
                                                            <label for="">Nama Anak Yang Didaftarkan</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getDetailOrderFromOrder->bi_nama_anak }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="">Usia Anak Yang Didaftarkan</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getDetailOrderFromOrder->usia_anak }}"
                                                                readonly>
                                                        </div>
                                                    @endif
                                                    @if ($ndata->getProdukFromOrder->getJasaFotoFromProduk)
                                                        <div class="col-lg-6">
                                                            <label for="">Tanggal Pemesanan</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getDetailOrderFromOrder->ft_tanggal_pemesanan }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="">Alamat Pemesanan</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getDetailOrderFromOrder->ft_alamat_pemesanan }}"
                                                                readonly>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-6">
                                                        <label for="">Status Pemesanan</label>
                                                        @if ($ndata->status == 'Dibatalkan')
                                                            <input type="text"
                                                                value="{{ $ndata->status }} - {{ $ndata->alasan_pembatalan }}"
                                                                readonly>
                                                        @else
                                                            <input type="text" value="{{ $ndata->status }}" readonly>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if ($ndata->getTransaksiFromOrder)
                                                    <hr>
                                                    <h4>Detail Transaksi</h4>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label for="">Jenis Pembayaran</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getTransaksiFromOrder->jenis_pembayaran }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="">Nama Bank</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getTransaksiFromOrder->bank }}" readonly>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="">Nama Rekening</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getTransaksiFromOrder->namaRek }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="">Total Pembayaran</label>
                                                            <input type="text"
                                                                value="{{ $ndata->getTransaksiFromOrder->total_pembayaran }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="">Status Pembayaran</label>
                                                            @if ($ndata->getTransaksiFromOrder->status == 'Dibatalkan')
                                                                <input type="text"
                                                                    value="{{ $ndata->getTransaksiFromOrder->status }} - {{ $ndata->getTransaksiFromOrder->alasan_pembatalan }}"
                                                                    readonly>
                                                            @else
                                                                <input type="text"
                                                                    value="{{ $ndata->getTransaksiFromOrder->status }}"
                                                                    readonly>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label for="">Bukti Pembayaran</label>
                                                            <img src="/assets/img/bukti/{{ $ndata->getTransaksiFromOrder->bukti_pembayaran }}"
                                                                width="100" height="100">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        </div>
        </div>
        <!--
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
                        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
                    </script> -->

        @include('sweetalert::alert')
        </body>

    @endsection

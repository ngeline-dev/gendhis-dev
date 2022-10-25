@extends('layouts.app')
@section('title', 'Laporan Transaksi Bimbel')
@section('heading', 'Laporan Transaksi Bimbel')
@section('page', 'Laporan Transaksi Bimbel')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('cetak-laporan.bimbel') }}" method="POST">
                    @csrf
                    <div class="col-sm-3">
                        <input type="text" name="filter" class="form-control ">
                    </div>
                    <br>
                    <button type="submit" class="btn icon icon-left btn-primary col-sm-2"><i data-feather="file-text"></i>
                        Print Data</button>
                </form>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Nama Paket</th>
                            <th>Jenis Transaksi</th>
                            <th>Status Pemesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $ndata)
                            <td>{{ $no++ }}</td>
                            <td>{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</td>
                            <td>
                                {{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}
                            </td>
                            <td>{{ $ndata->jenis_pembayaran }}</td>
                            <td>
                                {{ $ndata->getOrderFromTransaksi->status }} | Validasi oleh
                                {{ $ndata->getOrderFromTransaksi->getAdminFromOrder->name }}
                            </td>
                            <td>
                                {{ $ndata->status }} | Validasi oleh
                                {{ $ndata->getAdminFromTransaksi->name }}
                            </td>
                            <td>{{ $ndata->total_pembayaran }}</td>
                            <td>{{ $ndata->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                    data-target="#detail{{ $ndata->id }}">Detail Transaksi</button>
                            </td>

                            <!-- Modal Detail Pemesanan -->
                            <div id="detail{{ $ndata->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Detail Transaksi</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Detail Paket</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Kategori Paket</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->kategori }}"
                                                        readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Nama Paket</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Detail Pemesanan</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Nama Pemesan</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}"
                                                        readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Nomor Telepon</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nomor_telepon_pemesan }}"
                                                        readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Nama Anak Yang Didaftarkan</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->bi_nama_anak }}"
                                                        readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Usia Anak Yang Didaftarkan</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->bi_usia_anak }}"
                                                        readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Status Pemesanan</label>
                                                    <input type="text"
                                                        value="{{ $ndata->getOrderFromTransaksi->status }} | Validasi oleh {{ $ndata->getOrderFromTransaksi->getAdminFromOrder->name }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Detail Transaksi</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Jenis Pembayaran</label>
                                                    <input type="text" value="{{ $ndata->jenis_pembayaran }}" readonly>
                                                </div>
                                                @if ($ndata->jenis_pembayaran == 'Online')
                                                    <div class="col-lg-6">
                                                        <label for="">Nama Bank</label>
                                                        <input type="text" value="{{ $ndata->bank }}" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Nama Rekening</label>
                                                        <input type="text" value="{{ $ndata->namaRek }}" readonly>
                                                    </div>
                                                @endif
                                                <div class="col-lg-6">
                                                    <label for="">Total Pembayaran</label>
                                                    <input type="text" value="{{ $ndata->total_pembayaran }}" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Status Pembayaran</label>
                                                    <input type="text"
                                                        value="{{ $ndata->status }} | Validasi oleh {{ $ndata->getAdminFromTransaksi->name }}"
                                                        readonly>
                                                </div>
                                                @if ($ndata->jenis_pembayaran == 'Online')
                                                    <div class="col-lg-12">
                                                        <label for="">Bukti Pembayaran</label>
                                                        <img src="/assets/img/bukti/{{ $ndata->bukti_pembayaran }}"
                                                            width="100" height="100">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

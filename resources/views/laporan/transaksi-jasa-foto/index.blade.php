<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<body>
    <form action="{{ route('cetak-laporan.foto') }}" method="POST">
        @csrf
        <input type="text" name="filter">
        <input type="submit" value="Cetak">
    </form>
    <table>
        <thead>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Nama Paket</th>
            <th>Status Pemesanan</th>
            <th>Status Pembayaran</th>
            <th>Total Pembayaran</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $ndata)
                <td>{{ $no++ }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}</td>
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
                                            value="{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}"
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
                                        <label for="">Nomor KTP</label>
                                        <input type="text"
                                            value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nomor_ktp_pemesan }}"
                                            readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Nomor Telepon</label>
                                        <input type="text"
                                            value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nomor_telepon_pemesan }}"
                                            readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Tanggal Pemesanan</label>
                                        <input type="text"
                                            value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->ft_tanggal_pemesanan }}"
                                            readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Alamat Pemesanan</label>
                                        <input type="text"
                                            value="{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->ft_alamat_pemesanan }}"
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
                                    <div class="col-lg-4">
                                        <label for="">Jenis Pembayaran</label>
                                        <input type="text" value="{{ $ndata->jenis_pembayaran }}" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Nama Bank</label>
                                        <input type="text" value="{{ $ndata->bank }}" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Nama Rekening</label>
                                        <input type="text" value="{{ $ndata->namaRek }}" readonly>
                                    </div>
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
                                    <div class="col-lg-12">
                                        <label for="">Bukti Pembayaran</label>
                                        <img src="/assets/img/bukti/{{ $ndata->bukti_pembayaran }}" width="100"
                                            height="100">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function() {
            $('input[name="filter"]').daterangepicker();
        });
    </script>
</body>

</html>

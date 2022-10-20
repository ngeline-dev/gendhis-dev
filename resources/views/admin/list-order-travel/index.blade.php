<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<body>

    <table>
        <thead>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Nomor Telepon</th>
            <th>Nama Paket</th>
            <th>Tanggal Order</th>
            <th>Status Pemesanan</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $ndata)
                <td>{{ $no++ }}</td>
                <td>{{ $ndata->getDetailOrderFromOrder->nama_pemesan }}</td>
                <td>{{ $ndata->getDetailOrderFromOrder->nomor_telepon_pemesan }}</td>
                <td>{{ $ndata->getProdukFromOrder->getTravelFromProduk->nama_paket }}</td>
                <td>{{ $ndata->created_at }}</td>
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
                            Menunggu Pembayaran Customer
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
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#detail{{ $ndata->id }}">Detail Pemesanan</button>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#pemesanan{{ $ndata->id }}">Konfirmasi Pemesanan</button>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#pembayaran{{ $ndata->id }}">Konfirmasi Pembayaran</button>
                        @else
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#detail{{ $ndata->id }}">Detail Pemesanan</button>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#pemesanan{{ $ndata->id }}">Konfirmasi Pemesanan</button>
                        @endif
                    @else
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                            data-target="#detail{{ $ndata->id }}">Detail Pemesanan</button>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                            data-target="#pemesanan{{ $ndata->id }}">Konfirmasi Pemesanan</button>
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
                                        <input type="text" value="{{ $ndata->getProdukFromOrder->kategori }}"
                                            readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Nama Paket</label>
                                        <input type="text"
                                            value="{{ $ndata->getProdukFromOrder->getTravelFromProduk->nama_paket }}"
                                            readonly>
                                    </div>
                                </div>
                                <hr>
                                <h4>Detail Pemesanan</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">Nama Pemesan</label>
                                        <input type="text"
                                            value="{{ $ndata->getDetailOrderFromOrder->nama_pemesan }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Nomor KTP</label>
                                        <input type="text"
                                            value="{{ $ndata->getDetailOrderFromOrder->nomor_ktp_pemesan }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Nomor Telepon</label>
                                        <input type="text"
                                            value="{{ $ndata->getDetailOrderFromOrder->nomor_telepon_pemesan }}"
                                            readonly>
                                    </div>
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
                                                value="{{ $ndata->getTransaksiFromOrder->jenis_pembayaran }}" readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Nama Bank</label>
                                            <input type="text" value="{{ $ndata->getTransaksiFromOrder->bank }}"
                                                readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Nama Rekening</label>
                                            <input type="text" value="{{ $ndata->getTransaksiFromOrder->namaRek }}"
                                                readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Total Pembayaran</label>
                                            <input type="text"
                                                value="{{ $ndata->getTransaksiFromOrder->total_pembayaran }}" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Status Pembayaran</label>
                                            @if ($ndata->getTransaksiFromOrder->status == 'Dibatalkan')
                                                <input type="text"
                                                    value="{{ $ndata->getTransaksiFromOrder->status }} - {{ $ndata->getTransaksiFromOrder->alasan_pembatalan }}"
                                                    readonly>
                                            @else
                                                <input type="text"
                                                    value="{{ $ndata->getTransaksiFromOrder->status }}" readonly>
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal -->
                <div id="pemesanan{{ $ndata->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfirmasi Pemesanan</h4>
                            </div>
                            <form action="{{ route('order.konfirmasi', ['id' => $ndata->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $ndata->getProdukFromOrder->kategori }}"
                                    name="kategori" readonly>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Status Pemesanan</label>
                                            <select name="status" class="@error('status') is-invalid @enderror">
                                                <option
                                                    value="Diterima"{{ old('status') == 'Diterima' ? 'selected' : '' }}>
                                                    Diterima
                                                </option>
                                                <option
                                                    value="Dibatalkan"{{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>
                                                    Dibatalkan
                                                </option>
                                            </select>

                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="">Alasan Pembatalan</label>
                                            <input type="text" class="@error('alasan') is-invalid @enderror"
                                                name="alasan" value="{{ old('alasan') }}">

                                            @error('alasan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                    <input type="submit" value="Simpan">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- Modal -->
                <div id="pembayaran{{ $ndata->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfirmasi Pembayaran</h4>
                            </div>
                            <form action="{{ route('pembayaran.konfirmasi', ['id' => $ndata->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $ndata->getProdukFromOrder->kategori }}"
                                    name="kategori" readonly>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Status Pembayaran</label>
                                            <select name="status" class="@error('status') is-invalid @enderror">
                                                <option
                                                    value="Diterima"{{ old('status') == 'Diterima' ? 'selected' : '' }}>
                                                    Diterima
                                                </option>
                                                <option
                                                    value="Dibatalkan"{{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>
                                                    Dibatalkan
                                                </option>
                                            </select>

                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="">Alasan Pembatalan</label>
                                            <input type="text" class="@error('alasan') is-invalid @enderror"
                                                name="alasan" value="{{ old('alasan') }}">

                                            @error('alasan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                    <input type="submit" value="Simpan">
                                </div>
                            </form>
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

    @include('sweetalert::alert')
</body>

</html>

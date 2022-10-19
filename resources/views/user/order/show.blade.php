<html>

<body>
    <!-- Modal -->
    {{-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Pemesanan</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div> --}}
    {{-- END-MODAL --}}

    <table>
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
                                <a href="#">Cetak Sekarang</a>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                    data-target="#myModal">Detail
                                    Pemesanan</button>
                            @else
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                    data-target="#myModal">Detail
                                    Pemesanan</button>
                            @endif
                        @else
                            <a href="{{ route('form.pembayaran', ['id' => $ndata->id]) }}">Bayar Sekarang</a>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#myModal">Detail
                                Pemesanan</button>
                        @endif
                    @else
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                            data-target="#myModal">Detail
                            Pemesanan</button>
                    @endif
                </td>
            @endforeach
        </tbody>
    </table>

    @include('sweetalert::alert')
</body>

</html>

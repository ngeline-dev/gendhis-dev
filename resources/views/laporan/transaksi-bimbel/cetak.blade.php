<html>

<body>
    <h4>{{ $ndate[0] }} - {{ $ndate[1] }}</h4>
    <table>
        <thead>
            <thead>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Nama Paket</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Bayar</th>
            </thead>
        <tbody>
            @php
                $no = 1;
                $sum = 0;
            @endphp
            @foreach ($data as $ndata)
                <td>{{ $no++ }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}</td>
                <td>{{ $ndata->created_at }}</td>
                <td>{{ $ndata->total_pembayaran }}</td>

                @php
                    $sum += $ndata->total_pembayaran;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <td>Total</td>
            <td>Rp. {{ $sum }}</td>
        </tfoot>
        </thead>
    </table>
</body>

</html>

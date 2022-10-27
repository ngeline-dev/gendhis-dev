<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN TRANSAKSI BIMBEL CV GENDHIS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <center>
        <p style="color: #008080;"><b style="font-size: 24px;">LAPORAN TRANSAKSI BIMBEL CV GENDHIS </b><br> Jl. Pesantren No <br> No. HP : 0852-3577-5571
        </p>
    </center>
    <hr style="color: gray;">

    <h4>{{ $ndate[0] }} - {{ $ndate[1] }}</h4>
    <table class="table table-striped">
        <thead>
            <thead>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Nama Paket</th>
                <th>Jenis Transaksi</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Bayar</th>
            </thead>
        <tbody>
            @php
                $no = 1;
                $sum = 0;
            @endphp
            @foreach ($data as $ndata)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</td>
                <td>{{ $ndata->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}</td>
                <td>{{ $ndata->jenis_pembayaran }}</td>
                <td>{{ $ndata->created_at }}</td>
                <td>
                    Rp {{ number_format($ndata->total_pembayaran, 2, ',', '.') }}
                </td>

                @php
                    $sum += $ndata->total_pembayaran;
                @endphp
            @endforeach
            <tr>
        </tbody>
        <br><br>

        <tfoot>
            <td colspan="5" class="text-right">Total</td>
            <td colspan = "1" class="text-right">
                Rp {{ number_format($sum, 2, ',', '.') }}
            </td>
        </tfoot>
        </thead>
    </table>
    
</body>

</html>

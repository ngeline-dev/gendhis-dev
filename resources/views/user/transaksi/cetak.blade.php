<!DOCTYPE html>
<html>

<head>
    <title>CV GENDHIS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <center>
        <p style="color: #008080;"><b style="font-size: 24px;">CV GENDHIS </b><br> Jl. Pesantren No <br> No. HP : 0852-3577-5571
        </p>
    </center>
    <hr style="color: gray;">
    
    <h4 style="color:  #0000FF;"> Invoice</h4>
    <table class="table">
        <tbody style="color: gray;">
            <tr>
                <td>Nama Pemesan</td>
                <td>:</td>
                <td>{{ $data->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</h4>
                </td>
            </tr>
            <tr>
                <td>Jenis Paket</td>
                <td>:</td>
                <td>@if ($data->getOrderFromTransaksi->getProdukFromOrder->getTravelFromProduk)
        {{ $data->getOrderFromTransaksi->getProdukFromOrder->getTravelFromProduk->nama_paket }}
    @endif
    @if ($data->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk)
        {{ $data->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}
    @endif
    @if ($data->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk)
        {{ $data->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}
    @endif    
            </td>
            </tr>
            <tr>
                <td>Total Bayar</td>
                <td>:</td>
                <td>Rp. {{ $data->total_pembayaran }}</td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td>:</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        </tbody>
    </table>

    <br><br><br>
    <div style="color: #8B0000; font-weight:bold; font-size: 16px">
                        
    <h3 style="font-size: 16px; text-align: center; color: gray;"><b>Hormat Kami,</b></h3>
    <br><br><br>
    <h4 style="font-size: 14px; text-align: center; color: gray;">Admin CV Gendhis</h4>
</body>

</html>

<html>

<body>
    <h2>Berhasil</h2>
    <h4>Nama Pemesan : {{ $data->getOrderFromTransaksi->getDetailOrderFromOrder->nama_pemesan }}</h4>
    @if ($data->getOrderFromTransaksi->getProdukFromOrder->getTravelFromProduk)
        <h4>Nama Paket : {{ $data->getOrderFromTransaksi->getProdukFromOrder->getTravelFromProduk->nama_paket }}</h4>
    @endif
    @if ($data->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk)
        <h4>Nama Paket : {{ $data->getOrderFromTransaksi->getProdukFromOrder->getBimbelFromProduk->nama_paket }}</h4>
    @endif
    @if ($data->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk)
        <h4>Nama Paket : {{ $data->getOrderFromTransaksi->getProdukFromOrder->getJasaFotoFromProduk->nama_paket }}</h4>
    @endif
    <h4>Total Bayar : Rp. {{ $data->total_pembayaran }}</h4>
    <h4>Tanggal Pembayaran : {{ $data->created_at }}</h4>
</body>

</html>

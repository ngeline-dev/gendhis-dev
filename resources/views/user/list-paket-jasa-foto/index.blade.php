<html>

<body>
    @foreach ($data as $ndata)
        <a href="{{ route('form.order', ['id' => $ndata->produk_id]) }}">Order Sekarang</a>
    @endforeach
</body>

</html>

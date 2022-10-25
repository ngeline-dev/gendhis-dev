<html>

<body>
    <form action="{{ route('offline.store') }}" method="POST">
        @csrf
        <h5>Detail Pemesan</h5>
        <div class="row">
            <div class="col-lg-6">
                <label for="">Nama Pemesan</label>
                <input type="text" class="@error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}"
                    autofocus>
                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="">Nomor NIK Pemesan</label>
                <input type="number" class="@error('ktp') is-invalid @enderror" name="ktp"
                    value="{{ old('ktp') }}" autofocus>
                @error('ktp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="">Nomor HP Pemesan</label>
                <input type="number" class="@error('telepon') is-invalid @enderror" name="telepon"
                    value="{{ old('telepon') }}" autofocus>
                @error('telepon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="">Tanggal Pemesanan</label>
                <input type="date" class="@error('tanggal') is-invalid @enderror" name="tanggal"
                    value="{{ old('tanggal') }}" autofocus>
                @error('tanggal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="">Alamat Pemesanan</label>
                <input type="text" class="@error('alamat') is-invalid @enderror" name="alamat"
                    value="{{ old('alamat') }}" autofocus>
                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <hr>
        <h5>Paket</h5>
        <div class="row">
            <div class="col-lg-6">
                <label for="">Kategori Paket</label>
                <input type="hidden" name="kategori" value="Foto" readonly>
                <input type="text" value="Foto" readonly>
            </div>
            <div class="col-lg-6">
                <label for="">Paket Jasa Foto</label>
                <select name="paket" id="paket" class="">
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}"
                            data-harga="{{ $item->getJasaFotoFromProduk->harga_paket }}">
                            {{ $item->getJasaFotoFromProduk->nama_paket }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <label for="">Harga Paket</label>
                <input type="text" id="harga" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" value="Simpan">
            </div>
        </div>
    </form>
    <script>
        var selection = document.getElementById("paket");

        selection.onchange = function(event) {
            var harga = event.target.options[event.target.selectedIndex].dataset.harga;
            $('#harga').val(harga);
        };
    </script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
</body>

</html>

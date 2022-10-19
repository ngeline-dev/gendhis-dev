<html>

<body>
    <form action="{{ route('master-bimbel.update', ['master_bimbel' => $data->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <label for="">Nama Paket</label>
                <input type="text" class="@error('nama') is-invalid @enderror" name="nama"
                    value="{{ old('nama', $data->nama_paket) }}" autofocus>
                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Deskripsi Paket</label>
                <input type="text" class="@error('deskripsi') is-invalid @enderror" name="deskripsi"
                    value="{{ old('deskripsi', $data->deskripsi_paket) }}" autofocus>
                @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Foto Paket</label>
                <input type="file" class="@error('foto') is-invalid @enderror" name="foto"
                    value="{{ old('foto') }}" autofocus>
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Harga Paket</label>
                <input type="number" class="@error('harga') is-invalid @enderror" name="harga"
                    value="{{ old('harga', $data->harga_paket) }}" autofocus>
                @error('harga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Jadwal Bimbel</label>
                <input type="text" class="@error('jadwal') is-invalid @enderror" name="jadwal"
                    value="{{ old('jadwal', $data->jadwal_bimbel) }}" placeholder="e.g: Senin - Kamis" autofocus>
                @error('jadwal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Waktu Bimbel</label>
                <input type="time" class="@error('waktu') is-invalid @enderror" name="waktu"
                    value="{{ old('waktu', $data->waktu_bimbel) }}" autofocus>
                @error('waktu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <input type="submit" value="Simpan">
            </div>
        </div>
    </form>
</body>

</html>

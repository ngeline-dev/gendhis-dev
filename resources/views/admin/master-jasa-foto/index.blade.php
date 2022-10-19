<html>

<body>
    <a href="{{ route('master-jasa-foto.create') }}">Tambah</a>
    <table>
        <thead>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Foto Paket</th>
            <th>Harga</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $ndata)
                <td>{{ $no++ }}</td>
                <td>{{ $ndata->nama_paket }}</td>
                <td><img src="/assets/img/{{ $ndata->foto_paket }}" width="50" height="50"></td>
                <td>{{ $ndata->harga_paket }}</td>
                <td>
                    <a href="{{ route('master-jasa-foto.edit', ['master_jasa_foto' => $ndata->id]) }}">Edit</a>
                    <a href="{{ route('master-jasa-foto.destroy', ['master_jasa_foto' => $ndata->id]) }}">Hapus</a>
                </td>
            @endforeach
        </tbody>
    </table>

    @include('sweetalert::alert')
</body>

</html>

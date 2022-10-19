<html>

<body>
    <a href="{{ route('master-bimbel.create') }}">Tambah</a>
    <table>
        <thead>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Foto Paket</th>
            <th>Jadwal</th>
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
                <td>{{ $ndata->jadwal_bimbel }} | {{ $ndata->waktu_bimbel }}</td>
                <td>{{ $ndata->harga_paket }}</td>
                <td>
                    <a href="{{ route('master-bimbel.edit', ['master_bimbel' => $ndata->id]) }}">Edit</a>
                    <a href="{{ route('master-bimbel.destroy', ['master_bimbel' => $ndata->id]) }}">Hapus</a>
                </td>
            @endforeach
        </tbody>
    </table>

    @include('sweetalert::alert')
</body>

</html>

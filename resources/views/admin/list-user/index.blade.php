<html>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Email Customer</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $ndata)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $ndata->name }}</td>
                    <td>{{ $ndata->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

@extends('layouts.app')
@section('title', 'Master Data Kelola Admin')
@section('heading', 'Master Data Kelola Admin')
@section('page', 'Master Data Kelola Admin')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                <td>{{ $ndata->role }}</td>
                                <td>{{ $ndata->email }}</td>
                                <td>{{ $ndata->status }}</td>
                                <td><a href="{{ route('master-kelolaadmin.edit', ['master_kelolaadmin' => $ndata->id]) }}"
                                        class="btn icon icon-left btn-warning"
                                        onclick="return confirm('Apakah Kamu yakin ?')"><i data-feather="trash"></i>
                                        Edit Data</a></td>
                                <td><a href="{{ route('master-kelolaadmin.destroy', ['master_kelolaadmin' => $ndata->id]) }}"
                                        class="btn icon icon-left btn-danger" role="button"><i data-feather="download"></i>
                                        Delete Data</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('master-kelolaadmin.create') }}" class="btn btn-primary btn-l" role="button">Tambah Data
                    Admin</a>
            </div>
        </div>
    </section>
@endsection

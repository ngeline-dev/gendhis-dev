@extends('layouts.app')
@section('title', 'Master Data Studio Foto')
@section('heading', 'Master Data Studio Foto')
@section('page', 'Master Data Studio Foto')
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
                            <th>Nama Paket</th>
                            <th>Foto Paket</th>
                            <th>Harga</th>
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
                                <td>{{ $ndata->nama_paket }}</td>
                                <td><img src="/assets/img/{{ $ndata->foto_paket }}" width="50" height="50"></td>
                                <td>{{ $ndata->harga_paket }}</td>
                                <td><a href="{{ route('master-jasa-foto.edit', ['master_jasa_foto' => $ndata->id]) }}"
                                        class="btn icon icon-left btn-warning"><i data-feather="edit"></i>
                                        Edit Data</a></td>
                                <td><a href="{{ route('master-jasa-foto.destroy', ['master_jasa_foto' => $ndata->id]) }}"
                                        onclick="return confirm('Apakah Kamu yakin ?')"
                                        class="btn icon icon-left btn-danger" role="button"><i data-feather="trash"></i>
                                        Delete Data</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('master-jasa-foto.create') }}" class="btn btn-primary btn-l" role="button">Tambah Data
                    Jasa Foto</a>
            </div>
        </div>
    </section>
@endsection

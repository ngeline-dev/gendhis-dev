@extends('layouts.app')
@section('title', 'Data Customer')
@section('heading', 'Data Customer')
@section('page', 'Data Customer')
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
            </div>
        </div>
    </section>
@endsection

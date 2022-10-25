@section('content')
    @extends('layouts.app')
@section('title', 'Master Data Kelola Admin')
@section('heading', 'Master Data Kelola Admin')
@section('page', 'Master Data Kelola Admin')
@section('detailpage', '')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{ route('master-kelolaadmin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                                id="role" placeholder="Role" value="Admin" autofocus readonly>
                            @error('role')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status"
                                id="status" placeholder="Status" value="Aktif" autofocus readonly>
                            @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div><br></div>
                    <a href="{{ route('master-kelolaadmin.index') }}" class="btn icon icon-left btn-warning"><i
                            data-feather="info"></i> Kembali</a>
                    <button type="submit" class="btn icon icon-left btn-primary col-sm-2"><i data-feather="edit"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

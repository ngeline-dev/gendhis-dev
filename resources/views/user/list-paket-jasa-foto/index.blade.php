@extends('layouts.appcust')

@section('content')


<section class="layanan" id="layanan"> 
        <center><h2>PAKET TRAVEL<h2></center>
        <br>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="row">
                                        @forelse ($data as $ndata)
                                            <div class="col-md-3 mt-3 mb-3">
                                                <div class="card">
                                                    <div class="card-header bg-secondry text-black">
                                                        <center>
                                                            </center>
                                                            <img src="/assets/img/{{ $ndata->foto_paket }}" width="100px"
                                                            height="150px" class="card-img-top" alt="...">
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <h4>{{ $ndata->nama_paket }}</h4>

                                                        <div class="mt-3 text-center" role="group" aria-label="Basic example">
                                                            <a href="{{ route('form.order', ['id' => $ndata->produk_id]) }}" class="btn btn-primary">Pilih Paket</i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h3>Data yang Anda cari tidak ada</h3>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
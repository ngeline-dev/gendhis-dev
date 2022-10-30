@extends('layouts.appcust')

@section('content')
    <header class="item header margin-top-0" style="background-image: url('assets/bg-web.png'); width: 100%; "
        id="section-home" data-stellar-background-ratio="0.5">
        <div class="wrapper">
            <div class="container">
                <div class="row intro-text align-items-center justify-content-center">
                    <div class="col-md-10 animated tada">
                        <center>
                            <h1 class="site-heading site-animate" style="font-size: 47px;">
                                Penawaran Terbaik Paket Liburan, Bimbel dan Foto hanya ada disini<strong class="d-block"
                                    data-scrollreveal="enter top over 1.5s after 0.1s">GENDHIS</strong></h1>

                        </center><br><br>
                        <div class="item content">
                            <div class="container text-center">
                                <a href="#paket" class="homebrowseitems">PILIH PAKET
                                </a>
                            </div>
                        </div>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <br><br><br><br>
    <div class="item content">
        <div class="container topareaberanda">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="col editContent">
                        <span class="numberstep"><i class="far fa-laugh-beam"></i></span>
                        <h3 class="numbertext">KEPUASAN TERJAMIN</h3>
                        <p>
                            Pelayanan Ramah dan
                            Harga yang Terjangkau
                        </p>
                    </div>
                    <!-- /.col-md-4 -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="far fa-calendar-alt"></i></i></span>
                        <h3 class="numbertext">JAM OPERASIONAL</h3>
                        <p>
                            Senin s.d Jum'at
                            08.00 - 14.00
                        </p>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="fas fa-tags"></i></i></span>
                        <h3 class="numbertext">PROMO</h3>
                        <p>
                            Hanya di bulan ini !!!
                            Dapatkan Diskon s.d 30% Pesan Sekarang
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <section class="item content">
            <div class="container toparea2">
                <div class="underlined-title">
                    <div class="editContent">
                        <h1 class="text-center latestitems">APA ITU CV GENDHIS</h1>
                    </div>
                    <div class="wow-hr type_short">
                        <span class="wow-hr-h">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="productbox2">
                            <img src="assets/bg-web.png" alt="" width="100%">
                            <div class="clearfix">
                            </div>
                            <br />
                            <div class="product-details text-left">
                                <p style="font-size: 15px; color: #444; text-align:justify;"> Pilih Paket sesuai kebutuhan
                                    Anda sekarang !
                                    <a href="#paket">Pesan Sekarang</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h2 class="btn btn-buynow">GENDHIS</h2>
                        <div class="properties-box">
                            <div class="product-details text-left">
                                <p style="font-size: 15px; color: #444; text-align:justify;"> Berkomitmen secara signifikan
                                    dalam pelayanan
                                    yang kami berikan pada paket Liburan, Bimbel dan Foto. Untuk memberikan Kebahagiaan
                                    kepada orang-orang sekitar.
                                    <a href="{{ url('about') }}">Tentang Gendhis</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div><br>
        </section>

        <section class="item content" id="paket">
            <div class="container">
                <div class="underlined-title">
                    <div class="editContent">
                    </div>
                </div>
                <center>
                    <h2>PILIH PAKET<h2>
                </center>
                <br>
                <div class="card-deck">
                    <div class="card">
                        <a href="{{ url('list-paket-travel') }}">
                            <img class="card-img-top" src="{{ asset('assets/wisata.jpg') }}" alt="Card image cap"
                                height="240">
                            <div class="card-body">
                                <h5 class="card-title">Gendhis Travel</h5>
                                <p class="card-text">Liburan santai dan penuh Cinta bersama Keluarga dengan tenang</p>
                            </div>
                        </a>

                    </div>
                    <div class="card">
                        <a href="{{ url('list-paket-bimbel') }}">
                            <img class="card-img-top" src="{{ asset('assets/bimbel.jpg') }}" alt="Card image cap"
                                height="240">
                            <div class="card-body">
                                <h5 class="card-title">Gendhis Sinau</h5>
                                <p class="card-text">Menyediakan paket bimbel untuk segala jenjang dengan harga yang menarik
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{ url('list-paket-jasa-foto') }}">
                            <img class="card-img-top" src="{{ asset('assets/fotografer.jpg') }}" alt="Card image cap"
                                height="240">
                            <div class="card-body">
                                <h5 class="card-title">Gendhis Jasa Fotografer</h5>
                                <p class="card-text">Abadikan segala momen dengan orang orang yang anda sayangi</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div><br><br>
@endsection

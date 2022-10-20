@extends('layouts.appcust')

@section('content')
    <header class="item header margin-top-0" style="background-image: url(images/mobil.jpg); width: 100%; " id="section-home"
        data-stellar-background-ratio="0.5">
        <div class="wrapper">
            <div class="container">
                <div class="row intro-text align-items-center justify-content-center">
                    <div class="col-md-10 animated tada">
                        <center>
                            <h1 class="site-heading site-animate" style="font-size: 47px;">
                                Jaminan kualitas layanan terbaik<strong class="d-block"
                                    data-scrollreveal="enter top over 1.5s after 0.1s">BENGKEL MOBIL DELTA</strong></h1>

                        </center><br><br>
                        <div class="item content">
                            <div class="container text-center">
                                <a href="{{ url('booking') }}" class="homebrowseitems">Booking Servis
                                    <div class="homebrowseitemsicon">
                                        <i class="fa fa-star fa-spin"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="item content">
        <div class="container toparea">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="col editContent">
                        <span class="numberstep"><i class="far fa-laugh-beam"></i></span>
                        <h3 class="numbertext">KEPUASAN TERJAMIN</h3>
                        <p>
                            Setelah selesai servis tentunya mobil anda akan semakin nyaman dan membuat perjalanan anda
                            semakin nyaman.
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
                            Jam operasional bengkel mobil delta adalah Senin-Sabtu dari jam 8 pagi - 3 sore dan tutup setiap
                            hari Minggu.
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
                            Setiap servis mobil di bengkel kami sebanyak 10 kali akan mendapatkan promo terbaik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <!-- CONTENT =============================-->
    <section class="item content">
        <div class="container toparea2">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems">APA ITU BENGKEL MOBIL DELTA?</h1>
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
                        <img src="images/bengkel1.png" alt="" width="100%">
                        <div class="clearfix">
                        </div>
                        <br />
                        <div class="product-details text-left">
                            <p style="font-size: 15px; color: #444; text-align:justify;"> Mobil merupakan aset berharga di
                                masyarakat karena mobil dapat menjadi alat transportasi, hobi dan gaya hidup.
                                Oleh karena itu perlu dilakukan perbaikan secara berkala agar tidak rusak.
                                Bengkel Mobil Delta menyediakan bengkel yang menjamin kualitas pelayanan prima, cepat dan
                                terjangkau.
                                <a target="_blank" rel="nofollow" href="{{ url('booking') }}">Booking sekarang</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="btn btn-buynow">Layanan Servis</h2>
                    <div class="properties-box">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Servis</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br>
    </section>
    <!-- LATEST ITEMS =============================-->
    <section class="item content">
        <div class="container">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems" style="color: #444;;">BERITA BENGKEL MOBIL DELTA</h1>
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
                <div class="col-md-4">
                    <div class="productbox">
                        <div class="fadeshop">
                            <div class="captionshop text-center" style="display: none;">
                                <h3>bengkeldotcom</h3>
                                <p>
                                    Bengkel delta baru saja membuat rekor baru dengan mendatangkan sebuah ....
                                </p>
                                <p>
                                    <a href="" class="learn-more detailslearn"><i class="fab fa-readme"></i></i>
                                        BACA</a>
                                </p>
                            </div>
                            <span class="maxproduct"><img src="images/1.jpg" ajpeglt=""></span>
                        </div>
                        <div class="product-details" style="font-weight: bold;">
                            <h1>Kejutan! Bengkel Mobil Delta Mendapat Rekor Baru.</h1>
                        </div>
                    </div>
                </div>
                <!-- /.productbox -->
                <div class="col-md-4">
                    <div class="productbox">
                        <div class="fadeshop">
                            <div class="captionshop text-center" style="display: none;">
                                <h3>detiksport</h3>
                                <p>
                                    Belakangan ini banyak mobil sport datang ke bengkel delta karena ada yang ....
                                </p>
                                <p>
                                    <a href="" class="learn-more detailslearn"><i class="fab fa-readme"></i></i>
                                        BACA</a>
                                </p>
                            </div>
                            <span class="maxproduct"><img src="images/2.jpg" alt=""></span>
                        </div>
                        <div class="product-details">
                            <h1>Mobil Sport berdatangan ke Bengkel Mobil Delta!!!</h1>
                        </div>
                    </div>
                </div>
                <!-- /.productbox -->
                <div class="col-md-4">
                    <div class="productbox">
                        <div class="fadeshop">
                            <div class="captionshop text-center" style="display: none;">
                                <h3>okesport</h3>
                                <p>
                                    Pembalap asal Italia datang ke Bengkel Mobil Delta hanya ingin bertemu .....
                                </p>
                                <p>
                                    <a href="" class="learn-more detailslearn"><i class="fab fa-readme"></i></i>
                                        BACA</a>
                                </p>
                            </div>
                            <span class="maxproduct"><img src="images/3.jpg" alt=""></span>
                        </div>
                        <div class="product-details">
                            <h1>2022 Bengkel Delta resmi menjadi bengkel Internasional</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    </div><br><br>
@endsection

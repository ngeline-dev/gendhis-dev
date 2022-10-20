<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    More Templates Visit ==> Free-Template.co
    -->
    <title>LancarAbadi.id</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free Template by Free-Template.co" />
    <meta name="keywords"
        content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="Free-Template.co" />

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/animate.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/icomoon.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/exclusivity-master/css/style.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/Stellar-master/images/Logo.jpg" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script> -->
</head>

<body data-spy="scroll" data-target="#ftco-navbar" data-offset="200">


<div class="card-body">
<table class="table table-bordered" id="display-table">
     <thead>
         <tr>
             <th>No</th>
             <th>Nama</th>
             <th>Role</th>
             <th>Email</th>
             <th>Password</th>
             <th>Aksi</th>
         </tr>
     </thead>
     <tbody>
         <!-- 1 -->
         @forelse($ndata as $data)
             <tr>
                 <td>{{ $ndata->firstItem() + $loop->index }}</td>
                 <td>{{ $data->name }}</td>
                 <td>{{ $data->role }}</td>
                 <td>{{ $data->email }}</td>
                 <td>{{ $data->password }}</td>
                 <td align="center">
                 <div class="btn-group" role="group" aria-label="Basic example">
                     <a href="javascript:void(0)"
                         onclick="editAdmin({{ $data->id }})">
                         <i class="badge badge-warning p-2">Edit</i>
                     </a>
                     <a href="{{ route('o.adminDelete', $data->id) }}"
                         onclick="return confirm('Yakin Hapus data')">
                         <i class="badge badge-danger p-2">Delete</i>
                     </a>
                 </div>
                 </td>
             </tr>
         @empty
             <td class="text-center" colspan="6">Data yang Anda cari tidak ada
             </td>
         @endforelse
     </tbody>
    </table>
</div>



    <div class="col-md-6">
        <button type="button" id="btn_tambah" class="btn btn-primary">
            <i class="icon-plus"></i>
        </button>
    </div>

    <!-- END nav -->

    <div class="modal fade" id="tambah-data-admin" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('o.user.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama</label>
                                    <input type="text" hidden name="id" id="id">
                                    <input type="text" class="form-control" name="name" id="id_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Role</label>
                                    <!-- <input type="text" class="form-control" name="role" id="id_role_id"> -->
                                    <select name="role" class="form-control" required id="id_role">
                                        <option value="">Pilih Role</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Email</label>
                                    <input type="text" class="form-control" name="email" id="id_email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Password</label>
                                    <input type="text" class="form-control" name="password" id="id_password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-data-admin" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-user" action="" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama</label>
                                    <input type="text" hidden name="id" id="id">
                                    <input type="text" class="form-control" name="name" id="id_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Role</label>
                                    <!-- <input type="text" class="form-control" name="role" id="id_role_id"> -->
                                    <select name="role" class="form-control" required id="id_role">
                                        <option value="">Pilih Role</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Email</label>
                                    <input type="text" class="form-control" name="email" id="id_email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Password</label>
                                    <input type="text" class="form-control" name="password" id="id_password">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <section class="ftco-section bg-light  ftco-slant ftco-slant-white" id="section-services">
      
           
    </section> -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © LancarAbadi.id
                2022</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Website <a
                    href="https://www.lancarabadi.id" target="_blank">LancarAbadi.id</a> from LancarAbadi.id</span>
        </div>
    </footer>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#4586ff" />
        </svg></div>

    <script src="{{ asset('assets') }}/exclusivity-master/js/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/jquery.easing.1.3.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/owl.carousel.min.js"></script>
    <script src="{{ asset('assets') }}/exclusivity-master/js/jquery.animateNumber.min.js"></script>


    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="{{ asset('assets') }}/exclusivity-master/js/google-map.js"></script> -->

    <script src="{{ asset('assets') }}/exclusivity-master/js/main.js"></script>
    <script>
        $(function() {
            $("#btn_tambah").on('click', function() {
                $("#tambah-data-admin").modal('toggle');
            });
        });

        function editAdmin(id) {
            // cari id pada link admin/+id kemudian simpan data dari link admin/+id ke function (data)
            $.get('/manager/kelolaakun/' + id, function(data) {
                // isikan val(value) data ke id
                $('#form-edit-user #id_name').val(data.name);
                $('#form-edit-user #id_role').val(data.role);
                $('#form-edit-user #id_email').val(data.email);
                $('#form-edit-user #id_password').val(data.password);
                $('#form-edit-user #id').val(data.id);
                // buka modal permintaan
                $('#edit-data-admin').modal('toggle');
            });
        }
    </script>
</body>
</html>
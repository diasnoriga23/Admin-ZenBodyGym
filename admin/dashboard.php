<?php 
    include '../includes/myfirebase.php';
    include '../includes/expired.php';
    

    // data admin
    $reference_admin = 'Admin/admin001';
    $checkdata_admin = $database->getReference($reference_admin)->getValue();

    
   // cetak data admin
    $nama_admin_f = $checkdata_admin['nama_admin'];
    $hak_akses = $checkdata_admin['hak_akses'];   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta http-equiv="refresh" content="5">  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif/png" href="../asset/admin.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-collapse  justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link active py-1" aria-current="page"><i class="fa fa-home px-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="membership.php" class="nav-link py-1"><i class="fa fa-users px-1"></i>Membership</a>
                        </li>
                        <li class="nav-item">
                            <a href="trainers.php" class="nav-link py-1"><i class="fa fa-users px-1"></i>Trainers</a>
                        </li>
                        <li class="nav-item">
                            <a href="pembayaran.php" class="nav-link py-1"><i class="fa fa-credit-card px-1"></i>Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="pengunjung.php" class="nav-link py-1"><i class="fas fa-book px-1"></i>Buku Pengunjung</a>
                        </li>
                        <li class="nav-item">
                            <a href="manage.php" class="nav-link py-1"><i class="fas fa-chart-pie px-1"></i>Manage </a>
                        </li>
                        <li class="nav-item">
                            <a href="../includes/user_destroy.php" class="nav-link py-1"><i class="fas fa-sign-out-alt px-1"></i>Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="content position-relative">
        <div class="container my-4">
            <div class="row align-items-center">
                <div class="col-3 med" style="border-right: 1px solid rgb(100, 100, 100);">
                    <div class="col text-center"><img src="../asset/admin.svg" width="64px" height="64px"></div>
                    <div class="col text-center mt-1"><span><?php echo $nama_admin_f; ?></span></div>
                    <div class="col text-center"><span class="f12"><?php echo $hak_akses; ?></span></div>
                </div>
                <div class="col-4 mx-2">
                    <div class="col semi"><h3 class="my-0">Dashborad Admin</h3></div>
                    <div class="col med"><span>Laporan terbaru setiap saat</span></div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container my-4">
            <div class="animate__animated animate__fadeIn row d-flex justify-content-center align-items-center">
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3 mb-5" style="width: 250px; height: 150px;">
                    <div>
                   
                        <div class="text-center med"><span class="f18">Total Member</span></div>
                        <div class="text-center reg"><h1 class="display-4 total_member">...</h1></div>
                    </div>
                         
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3 mb-5" style="width: 250px; height: 150px;">
                    <div>
                    
                        <div class="text-center med"><span class="f18">Total Member Aktif</span></div>
                        <div class="text-center reg"><h1 class="display-4 total_member_aktif">...</h1></div>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3 mb-5" style="width: 250px; height: 150px;">
                    <div>
                   
                        <div class="text-center med"><span class="f18">Member Kurang dari 5 hari</span></div>
                        <div class="text-center reg"><h1 class="display-4 member_kurangdari5hari">...</h1></div>
                    </div>
                         
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3 mb-5" style="width: 250px; height: 150px;">
                    <div>
                    
                        <div class="text-center med"><span class="f18">Konfirmasi Pembayaran</span></div>
                        <div class="text-center reg"><h1 class="display-4 konfirmasi_pembayaran">...</h1></div>
                    </div>
                </div>
                <div class="col-12 col-dsb-bg mx-3 mb-5" style="padding:15px;max-width: 800px;">
                    <div>
                        <div class="text-center med" style="margin-bottom: 15px"><span class="f18">Member berakhir kurang dari 5 hari</span></div>
                        <div>
                            <table class="table table-borderless tabel text-center tblm5d" id="tblmemberexp5d">
                                <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Nama</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            total_member = $('.total_member');
            total_member_aktif = $('.total_member_aktif');
            member_kurangdari5hari = $('.member_kurangdari5hari');
            konfirmasi_pembayaran = $('.konfirmasi_pembayaran');
            var tdata = [];
            var table = $('.tblm5d').DataTable({
                "autoWidth": false,
                "info": false,
                "order": [],
                "data": tdata,
                "columns": [
                    {
                        "data": "username"
                    },
                    {
                        "data": "nama_leng"
                    },
                ],
                "language": {
                    "url": "../Indonesian.json"
                }
            });
            $('.tblm5d').css('min-height','200px');
            getData();
            function getData(){
                $.get('../includes/data_model.php?getdata=true', function(data, status){
                    total_member.text(data.total_user);
                    total_member_aktif.text(data.total_user - data.member_expired);
                    member_kurangdari5hari.text(data.member_kurangdari5hari.length);
                    konfirmasi_pembayaran.text(data.konfirmasi_pemabayaran);
                    tdata = data.member_kurangdari5hari;
                    table.clear().rows.add(tdata).draw();
                });
            }
            setInterval(() => {
                getData();
            }, 5000);
        });
    </script>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
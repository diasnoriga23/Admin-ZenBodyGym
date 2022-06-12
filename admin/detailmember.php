<?php 
    include '../includes/myfirebase.php';
    include '../includes/expired.php';
    

    // data admin
    $reference = 'Admin/admin001';
    $checkdata = $database->getReference($reference)->getValue();

    // data turis
    $username_url = $_GET['username'];

    // data detail user
   $path_user_details = 'User/'.$username_url;
   $checkdata_user_details = $database->getReference($path_user_details)->getValue();

   $path_pembayaran_details = 'Pembayaran/'.$username_url;
   $checkdata_pembayaran_details = $database->getReference($path_pembayaran_details)->getValue();


    // cetak data admin
    $nama_admin_f = $checkdata['nama_admin'];
    $hak_akses = $checkdata['hak_akses'];
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif/png" href="../asset/admin.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../css/custom.css">
    <title>Detail Membership</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-collapse  justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link py-1" aria-current="page"><i class="fa fa-home px-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="membership.php" class="nav-link active py-1"><i class="fa fa-users px-1"></i>Membership</a>
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
                            <a href="manage.php" class="nav-link py-1"><i class="fas fa-chart-pie px-1"></i>Manage</a>
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
        <div class="container my-4 animate__animated animate__fadeIn">
            <div class="col-4 semi">
                <div class="col my-1"><h2 class="my-0">Membership</h2></div>    
            </div>
            <hr>
        </div>
        <div class="container"  style="top: 300px; width: 600px; padding-bottom: 10px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2 med">
                    <h4 class="text-center ">Data Membership</h4>
                </div>   
                <hr class="col-10 mx-auto">  
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">ID Member</div>
                    <div class="col mt-4">: <?php  echo $checkdata_user_details['no_id']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Username</div>
                    <div class="col mt-4">: <?php echo $checkdata_user_details['username']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Nama Member</div>
                    <div class="col mt-4">: <?php echo $checkdata_user_details['nama_leng']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Nomor Whatshapp</div>
                    <div class="col mt-4">: <?php echo $checkdata_user_details['no_wa']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Email</div>
                    <div class="col mt-4">: <?php echo $checkdata_user_details['email']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Tanggal Lahir</div>
                    <div class="col mt-4">: <?php echo $checkdata_user_details['bt_datepicker']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-4 mx-5 mt-4">Personal Trainer</div>
                    <div class="col mt-4">: <?php echo $checkdata_pembayaran_details['cb_trainer']; ?></div>                
                </div>
                <div class="row mb-4 reg">
                    <div class="col-4 mx-5 mt-4">Tanggal Expired</div>
                    <div class="col mt-4">: <?php echo $checkdata_pembayaran_details['tgl_bayar_selanjutnya']; ?></div>                
                </div>
        </div>                  
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
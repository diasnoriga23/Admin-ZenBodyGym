<?php
    include '../includes/myfirebase.php';
    session_start();

    $reference_admin = 'Admin/' . $_SESSION['username'];
    $checkdata_admin = $database->getReference($reference_admin)->getValue();

    $checkdata_jadwal = $database->getReference('Jadwal')->orderByChild('trainer')->equalTo($_SESSION['username'])->getValue();

    $users = $database->getReference('User')->orderByChild('trainer')->equalTo($_SESSION['username'])->getValue();
    $pembayaran = $database->getReference('Pembayaran')->getValue();
    $belum_terjadwal = 0;
    $sudah_terjadwal = 0;
    foreach ($users as $v) {
        $pembayaran1 = $pembayaran[$v['username']];
        if ($pembayaran[$v['username']] && $pembayaran1['cb_trainer'] == 'Pakai Personal Trainer' && $pembayaran1['validasi_pembayaran'] == 'valid') {
            if (!isset($checkdata_jadwal[$v['username']])) {
                if ($pembayaran1['validasi_jadwal'] == 'Belum Terjadwal') {
                    $belum_terjadwal++;
                }
            }else{
                $sudah_terjadwal++;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif/png" href="../asset/personal.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../css/custom.css">
    <title>Dashboard Personal Trainer</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-collapse  justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboardpt.php" class="nav-link active py-1" aria-current="page"><i class="fa fa-home px-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwal.php" class="nav-link py-1"><i class="fa fa-calendar px-1"></i>Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwalhariini.php" class="nav-link py-1"><i class="fa fa-calendar px-1"></i>Jadwal Hari Ini</a>
                        </li>
                        <li class="nav-item">
                            <a href="buatjadwal.php" class="nav-link py-1"><i class="fas fa-calendar-plus px-1"></i>Buat Jadwal</a>
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
                <div class="col-3" style="border-right: 1px solid rgb(100, 100, 100);">
                    <div class="col text-center"><img src="../asset/personal.svg" width="64px" height="64px"></div>
                    <div class="col text-center mt-1 med"><span<span><?= $checkdata_admin['nama_admin'] ?></span></div>
                    <div class="col text-center med"><span class="f12"><?= $checkdata_admin['hak_akses'] ?></span></div>
                </div>
                <div class="col-5 mx-2">
                    <div class="col semi"><h3 class="my-0">Dashborad Personal Trainer</h3></div>
                    <div class="col med"><span>Laporan terbaru setiap saat</span></div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container my-4">
            <div class="animate__animated animate__fadeIn row d-flex justify-content-center align-items-center">
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3" style="width: 230px; height: 150px;">
                    <div>
                        <div class="text-center med"><span class="f18">Jadwal</span></div>
                        <div class="text-center reg"><h1 class="display-4"><?= $sudah_terjadwal ?></h1></div>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3" style="width: 230px; height: 150px;">
                    <div>
                        <div class="text-center med"><span class="f18">Buat Jadwal</span></div>
                        <div class="text-center reg"><h1 class="display-4"><?= $belum_terjadwal ?></h1></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
<?php
    include '../includes/myfirebase.php';
    $namahari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
    $username_url = $_GET['username'];
    $jadwals = $database->getReference('Jadwal/'.$username_url)->getValue();
    $jadwal_selesai = isset($jadwals['jadwal_selesai']) ? $jadwals['jadwal_selesai'] : [];

    function cekHadir($m, $h){
        global $jadwal_selesai;
        if (!empty($jadwal_selesai["ming$m" . "_tgl_ke$h"])) {
            if ($jadwal_selesai["ming$m" . "_tgl_ke$h"]['status'] == 'Hadir') {
                return 'hadir';
            }else{
                return 'tidakhadir';
            }
        }else{
            return '';
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
    <title>Detail Jadwal</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-collapse  justify-content-center">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a href="dashboardpt.php" class="nav-link py-1" aria-current="page"><i class="fa fa-home px-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwal.php" class="nav-link active py-1"><i class="fa fa-calendar px-1"></i>Jadwal</a>
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
            <div class="col-4">
                <div class="col my-1 semi"><h2 class="my-0">Detail Jadwal</h2></div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="animate__animated animate__fadeIn row d-flex justify-content-center align-items-center" style="padding-bottom: 20px">
                <?php for ($m=1; $m <= 4; $m++) { $minggu = $jadwals["minggu_ke_$m"]; ?>
                    <div class="col-3 d-flex align-items-center justify-content-center col-dsb-bg mx-3" style="width: 230px; padding-top: 15px">
                        <div class="text-center">
                            <span class="med">Minggu Ke <?= $m ?></span>
                <?php for ($h=1; $h <= 3; $h++) { $hari = $minggu["ming$m" . "_tgl_ke$h"]; ?>
                    <hr>
                    <div class="<?= cekHadir($m, $h) ?>">
                        <p class="mt-2 reg"><?= $namahari[date('w', strtotime($hari))] ?></p>   
                        <div style="width:150px;"> 
                            <p class="fa fa-calendar"><?= $hari ?></p>
                        </div>   
                        <div style="width:150px;">                             
                            <p class="fas fa-clock"><?= $minggu["ming$m" . "_jam_ke$h"]; ?></p>
                        </div>
                    </div>
                <?php } ?>
                    </div>
                        </div>
                <?php } ?>
                <?php if(!empty($jadwal_selesai)){ ?>
                    <div class="mt-4 text-center" style="max-width: 1000px;">
                        <div class="med mb-3">Catatan Kehadiran</div>
                        <table class="table table-borderless tabel text-center">
                            <tr>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                            <?php foreach ($jadwal_selesai as $v) { ?>
                                <tr>
                                    <td><?= ucfirst($v['status']) ?></td>
                                    <td><?= $v['note'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
            </div> 
        </div>  
    </div>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
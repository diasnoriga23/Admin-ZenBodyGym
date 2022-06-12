<?php
    include '../includes/myfirebase.php';
    session_start();

    $reference1 = 'User/';
    $checkdata1 = $database->getReference($reference1)->getValue();
    

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
    <title>Buat Jadwal</title>
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
                            <a href="jadwal.php" class="nav-link py-1"><i class="fa fa-calendar px-1"></i>Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwalhariini.php" class="nav-link py-1"><i class="fa fa-calendar px-1"></i>Jadwal Hari Ini</a>
                        </li>
                        <li class="nav-item">
                            <a href="buatjadwal.php" class="nav-link active py-1"><i class="fas fa-calendar-plus px-1"></i>Buat Jadwal</a>
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
                <div class="col my-1 semi"><h2 class="my-0">Buat Jadwal</h2></div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="animate__animated animate__fadeIn col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;">
                <table class="table table-borderless tabel text-center">
                    <thead class="med">
                        <tr>
                            <th scope="col" >ID Member</th>
                            <th scope="col" >Username</th>
                            <th scope="col" >Nama</th>
                            <th scope="col" >Status Penjadwalan</th>                    
                            <th scope="col" >Aksi</th>
                        </tr>
                    </thead>
                    <?php 
                        $reference_user = 'User/';
                        $checkdata_user = $database->getReference($reference_user)
                        ->orderByChild('trainer')
                        ->equalTo($_SESSION['username'])
                        ->getValue();
                        if($checkdata_user != null){
                        foreach($checkdata_user as $value){
                        $reference2 = 'Pembayaran/'.$value['username'];
                        $checkdata2 = $database->getReference($reference2)->getValue();
                        if($checkdata2['cb_trainer'] == 'Tidak Pakai Personal Trainer'){

                        }else{
                            if($checkdata2['validasi_jadwal'] == 'Sudah Terjadwal'){

                            }else{
                                if($checkdata2['validasi_pembayaran'] == 'invalid'){

                                }else{
                                    if($checkdata2['validasi_pembayaran'] == 'validasipt'){

                                    }else{
                   ?>
                    <tbody class="reg">
                        <tr>                        
                            <td><?php echo $value['no_id']; ?></td>
                            <td><?php echo $value['username']; ?></td>
                            <td><?php echo $value['nama_leng']; ?></td>
                            <td><?php echo $checkdata2['validasi_jadwal']; ?></td>
                            <td scope="col">
                                <a href="buatpenjadwalan.php?username=<?php echo $value['username']; ?>" type="submit" name="validasi_pembayaran" class="btn btn-primary">Buat Jadwal</a>
                            </td>
                        </tr>
                    </tbody> 
                    <?php }}}}} }else{
                        echo "Tidak Ada Pembuatan Jadwal";
                    } ?>               
                </table>
            </div>
        </div>  
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
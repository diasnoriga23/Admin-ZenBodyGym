<?php
    include '../includes/myfirebase.php';
    include '../includes/expired.php';
    
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
    <link rel="stylesheet" href="../css/custom.css">
    <title>Edit Kontak</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
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
                            <a href="manage.php" class="nav-link active py-1"><i class="fas fa-chart-pie px-1"></i>Manage</a>
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
    <div class="container animate__animated animate__fadeIn" style="top: 150px; width: 600px;">
        <div class="col-12 col-dsb-bg my-4 py-3">
        <h3 class="text-center med">Edit Kontak</h3> 
        <hr class="col-8 mx-auto">
        <?php 
                        $reference1 = 'No_Wa/';
                        $checkdata1 = $database->getReference($reference1)->getValue();
                   ?>
        <form method="POST" action="../includes/data_model.php">
                <div class="my-3 col-5 mx-auto reg">
                <label for="nama" class="form-label">Nama Personal Trainer</label>
                    <input name="nama_pt" value="<?php echo $checkdata1['nama_pt']; ?>" type="text" id="nama" class="form-control">
                </div>
                <div class="my-3 col-5 mx-auto reg">
                <label for="no" class="form-label">Nomor WhatsApp</label>
                    <input name="no_wa_pt" value="<?php echo $checkdata1['no_wa_pt']; ?>" type="number" id="no" class="form-control">
                </div>
                <div class="my-3 text-center mx-auto reg">
                        <td style="width:260px">
                            <Button name="updateWa" type="submit" class="btn btn-primary" style="width: 100px; margin-right: 3px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Simpan</Button>
                            <a href="manage.php" type="submit" class="btn btn-primary" style="width: 100px; margin-left: 3px;">Batal</a>
                        </td>
                </div>
        </form> 
        </div>
        </div>
    </div> 
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header justify-content-center" style="border-bottom:none !important">
        
        <a href="manage.php" type="button" class="btn-close" aria-label="Close"></a>
      </div>
        <div class="modal-body justify-content-center text-center ">
        <p class="modal-title" id="staticBackdropLabel" style="color:#000000; font-size:40px">Berhasil Disimpan ! !</p>
        <p class="fa fa-check-circle fa-5x " style="color:#000; width:100px; height:100px "></p>
        </div>
    </div>
  </div>
</div>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
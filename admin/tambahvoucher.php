<?php 
    include '../includes/myfirebase.php';
    if (isset($_POST['addvoucher'])) {
        $database->getReference('Voucher/' . $_POST['kode'])->set([
            'persen'    => isset($_POST['persen']) ? '1' : '0',
            'value'     => (int)$_POST['potongan'],
            'tos'       => $_POST['tos'],
            'op'        => $_POST['memberterm'],
            'expired'   => !empty($_POST['date_ex']) ? date('d-m-Y', strtotime($_POST['date_ex'])) : '-'
        ]);
        header('Location: manage.php');
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif/png" href="../asset/admin.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="../css/custom.css">
    <title>Tambah Voucher</title>
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
        <h3 class="text-center med">Tambah Voucher</h3>
        <hr class="col-8 mx-auto">
        <form method="POST" class="px-5">
                <div class="my-3 reg">
                    <label for="nama" class="form-label">Kode Voucher</label>
                    <input name="kode" type="text" class="form-control" id="nama" required>
                </div>
                <div class="my-3 reg">
                    <label for="no" class="form-label">Potongan</label>
                    <input name="potongan" type="number" class="form-control" id="no" required>
                    <small>
                        <div class="form-check">
                            <input type="checkbox" name="persen" class="form-check-input">
                            <label class="form-check-label">Persen</label>
                        </div>
                    </small>
                </div>
                <div class="my-3 reg">
                    <label for="nama" class="form-label">Syarat & ketentuan</label>
                    <textarea name="tos" rows="5" class="form-control" required></textarea>
                </div>
                <div class="my-3 reg">
                    <label class="form-label">Syarat Member</label>
                    <select name="memberterm" class="form-control" id="memberterm">
                        <option value="all" selected>Semua Member</option>
                        <option value="new">Member baru</option>
                        <option value="long" day="yes">Member Lama</option>
                    </select>
                </div>
                <div class="my-3 reg">
                    <label for="nama" class="form-label">Expired</label>
                    <input type="date" name="date_ex" class="form-control" />
                </div>
                <div class="my-3 text-center mx-auto reg">
                        <td style="width:260px">
                            <Button name="addvoucher" type="submit" class="btn btn-primary" style="width: 100px; margin-right: 3px;">Simpan</Button>
                            <a href="manage.php" type="submit" class="btn btn-primary" style="width: 100px; margin-left: 3px;">Batal</a>
                        </td>
                </div>
        </form> 
        </div>
    </div>
    </div> 
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script>
        $('#memberterm').change(function(e){
            e = e.currentTarget.selectedOptions[0];
            dayf = $('#day')[0];
            if (e.attributes['day'] && e.attributes['day'].value == 'yes') {
                dayf.disabled = false;
                dayf.required = true;
            }else{
                dayf.disabled = true;
                dayf.required = false;
            }
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
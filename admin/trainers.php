<?php 
    include '../includes/myfirebase.php';
    session_start();
    
    $trainers = $database->getReference('Admin')->orderByChild('hak_akses')->equalTo('Personal Trainer')->getValue();
    if (isset($_GET['deleteuname'])) {
        $uname = $_GET['deleteuname'];
        $jadwal = $database->getReference("Jadwal")->orderByChild('trainer')->equalTo($uname)->getValue();
        $jadwal_toremove = [];
        $jadwal_toremove["Admin/$uname"] = null;
        if ($jadwal != null) {
            foreach ($jadwal as $k => $v) {
                $jadwal_toremove["Jadwal/$k"] = null;
            }
        }
        $database->getReference()->update($jadwal_toremove);
        $user = $database->getReference("User")->orderByChild('trainer')->equalTo($uname)->getValue();
        if ($user != null) {
            $user_toedit = [];
            foreach ($user as $k => $v) {
                $user_toedit["User/$k/trainer"] = '';
                $user_toedit["Pembayaran/$k/validasi_jadwal"] = 'Belum Terjadwal';
            }
            $database->getReference()->update($user_toedit);
        }
        echo "deleted";
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
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../css/custom.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Trainers</title>
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
                            <a href="trainers.php" class="nav-link active py-1"><i class="fa fa-users px-1"></i>Trainers</a>
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
    <div class="container my-4">
            <div class="row">
                <div class="col-6 semi">
                    <div class="col my-1"><h2 class="my-0">Trainers</h2></div>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-end align-items-end h-100 reg">
                        <a href="tambahtrainer.php" type="button" class="btn btn-primary">Tambah Trainer</a>
                    </div>
                </div>
            </div>
            <hr>
        </div>     
        <div class="container">
            <div class="animate__animated animate__fadeIn col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;">
                <table class="table table-borderless tabel text-center">
                    <thead class="med">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php if($trainers != null){ foreach($trainers as $v){ ?>
                            <tr>
                                <td class="username"><?= $v['username'] ?></td>
                                <td><?= $v['nama_admin'] ?></td>
                                <td style="width:260px">
                                    <button  type="submit" id="<?= $v['username'] ?>" class="btn btn-primary hapus" style="width: 100px; margin-left: 3px;">Hapus</button>
                                </td>
                            </tr>
                    <?php } }else{
                        echo "Tidak Ada Membership";
                    }?>
                </table>
            </div>
        </div>  
    </div>      
    
    <!-- Modal -->
    <div class="modal fade" id="deleteTrainer" tabindex="-1" aria-labelledby="deleteTrainerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color:#000;" class="modal-title" id="deleteTrainerLabel">Hapus Trainer <span id="titlemsg"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="color:#000;">
        Apakah Anda Yakin Untuk Menghapus Trainer Tersebut ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button id="yesdelete" class="btn btn-danger">Hapus</a> 
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        uname = '';
        $('.hapus').click(function(e) {
            target = e.currentTarget.parentElement.parentElement;
            uname = target.children[0].innerText;
            $('#titlemsg').text(target.children[1].innerText);
            $('#deleteTrainer').modal('show');
        })
        $('#yesdelete').click(function(e){
            e = e.currentTarget;
            e.innerText = 'Please wait';
            e.disabled = true;
            $.get('?deleteuname=' + uname, function(data, status){
                location.reload();
            });
        })
    })
</script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
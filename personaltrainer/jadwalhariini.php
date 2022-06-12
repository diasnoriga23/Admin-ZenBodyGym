<?php
    include '../includes/myfirebase.php';
    session_start();
    if (!empty($_POST['done'])) {
        $d = (object)$_POST;
        $status = $d->alasan == 'hadir' ? 'Hadir' : 'Tidak Hadir';
        $database->getReference('Jadwal/' . $d->done . '/jadwal_selesai/' . $d->keytgl)->set([
            'status'    => $status,
            'note'      => $d->noteabsen
        ]);
        $exdata = $database->getReference("Jadwal/$d->done/$d->keymingg/$d->keytgl")->getValue();
        if (!empty($exdata) && !empty($d->motot) && !empty($d->mlemak) && !empty($d->bbadan) ) {
            $database->getReference('Report/' . $d->done . '/' . $exdata)->set([
                'motot'     => (double)$d->motot,
                'mlemak'    => (double)$d->mlemak,
                'bbadan'    => (double)$d->bbadan
            ]);
        }
        echo '<script>location.href = location.href</script>';
        return;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Jadwal</title>
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
                            <a href="jadwalhariini.php" class="nav-link active py-1"><i class="fa fa-calendar px-1"></i>Jadwal Hari Ini</a>
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
                <div class="col my-1 semi"><h2 class="my-0">Jadwal Hari Ini</h2></div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="animate__animated animate__fadeIn col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;">
                <table class="table table-borderless tabel text-center">
                    <thead class="med">
                        <tr>
                            <th scope="col">ID Member</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    
                    <?php 
                        $all_user = $database->getReference('User')->orderByChild('trainer')->equalTo($_SESSION['username'])->getValue();
                        $jadwal = $database->getReference('Jadwal')->orderByChild('trainer')->equalTo($_SESSION['username'])->getValue();
                        if($jadwal != null){foreach($jadwal as $k => $value){
                            for ($m=1; $m <= 4; $m++) { 
                                $keym = "minggu_ke_$m";
                                $minggu = $value[$keym];
                                for ($tgl=1; $tgl <= 3; $tgl++) { 
                                    if (strpos($minggu['ming' . $m ."_tgl_ke$tgl"], date('d-m-Y')) !== false) {
                                    ?>
                                        <tr mingg="<?= $keym ?>" tgl="<?= 'ming' . $m ."_tgl_ke$tgl" ?>">
                                            <td><?= $all_user[$k]['no_id']; ?></td>
                                            <td class="username"><?= $all_user[$k]['username']; ?></td>
                                            <td><?= $all_user[$k]['nama_leng']; ?></td>
                                            <td style="width:260px"><?= $minggu['ming' . $m . "_jam_ke$tgl"] ?></td>
                                            <td style="width:150px">
                                                <button class="btn btn-primary hapus" <?php if(!empty($value['jadwal_selesai']['ming' . $m ."_tgl_ke$tgl"])) echo 'disabled' ?> style="width: 100px; margin-left: 3px;">Selesai</button>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                            }
                        }}else{
                        echo "Tidak Ada Jadwal";
                    } ?>     
                </table>
            </div>
        </div>  
    </div>
    <!-- Modal -->
    <div class="modal fade" id="jadwalselesai" tabindex="-1" aria-labelledby="jadwalselesaiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
            <h5 style="color:#000;" class="modal-title" id="jadwalselesaiLabel">Selesaikan Jadwal Member <span id="titlemsg"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color:#000;">
            <div class="form-group">
                <label for="note">Maasa Otot</label>
                <input type="text" pattern="([0-9.,]+)" name="motot" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Massa Lemak</label>
                <input type="text" pattern="([0-9.,]+)" name="mlemak" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Berat Badan</label>
                <input type="text" pattern="([0-9.,]+)" name="bbadan" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Catatan</label>
                <textarea class="form-control" name="noteabsen" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <input type="hidden" name="done" id="usertodone"> 
            <input type="hidden" name="keymingg" id="keymingg"> 
            <input type="hidden" name="keytgl" id="keytgl"> 
            <button name="alasan" value="tidakhadir" class="btn btn-warning ml-5">Tidak Hadir 
            <button name="alasan" value="hadir" class="btn btn-primary">Hadir
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.hapus').click(function(e) {
            target = e.currentTarget.parentElement.parentElement;
            $('#usertodone').val(target.children[1].innerText);
            $('#keymingg').val(target.attributes['mingg'].value);
            $('#keytgl').val(target.attributes['tgl'].value);
            $('#titlemsg').text(target.children[2].innerText);
            $('#jadwalselesai').modal('show');
        })
    })
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
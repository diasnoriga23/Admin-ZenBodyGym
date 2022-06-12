<?php
    include '../includes/myfirebase.php';
    session_start();
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
                <div class="col my-1 semi"><h2 class="my-0">Jadwal</h2></div>
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php 
                    
                        $reference_user = 'User/';
                        $checkdata_user = $database->getReference($reference_user)->orderByChild('trainer')->equalTo($_SESSION['username'])->getValue();
                        if($checkdata_user != null){
                        foreach($checkdata_user as $value){
                        $reference_pembayaran = 'Pembayaran/'.$value['username'];
                        $checkdata_pembayaran = $database->getReference($reference_pembayaran)->getValue();
                        
                        if($checkdata_pembayaran['cb_trainer'] == 'Tidak Pakai Personal Trainer'){

                        }else{
                            if($checkdata_pembayaran['validasi_jadwal'] == 'Belum Terjadwal'){

                            }else{
                    
                   ?>
                    <tbody class="reg">                    
                        <tr>
                            <td><?php echo $value['no_id']; ?></td>
                            <td class="username"><?php echo $value['username']; ?></td>
                            <td><?php echo $value['nama_leng']; ?></td>
                            <td style="width:350px">
                                <a href="detailjadwal.php?username=<?php echo $value['username']; ?>" type="submit" class="btn btn-primary" style=" margin-right: 3px; ">Detail Jadwal</a>
                                <a href="buatpenjadwalan.php?edit=<?= $value['username']; ?>" class="btn btn-primary" style=" margin-right: 3px; ">Edit</a>
                                <button  type="submit" class="btn btn-primary hapus" style="width: 100px; margin-left: 3px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Selesai</button>
                            </td>
                        </tr>
                    </tbody>
                    <?php }}}}else{
                        echo "Tidak Ada Jadwal";
                    } ?>     
                </table>
            </div>
        </div>  
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color:#000;" class="modal-title" id="exampleModalLabel">Jadwal Member <input type="text" class="namauser" value="<?php echo $value['username']; ?>" style="background-color: white; border: none; color: black; font-weight: 500; width: 100px;" disabled></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="color:#000;">
        Apakah Anda Yakin Jadwal Tersebut Sudah Selesai ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form method="POST" action="../includes/data_model.php">
        <input type="hidden" name="username" id="hapus_username" value="<?php echo $value['username']; ?>"> 
        <button name="deleteJadwal" type="submit" class="btn btn-secondary">Selesai</a>
        </form> 
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.hapus').click(function(e) {
            e.preventDefault();

            var username = $(this).closest('tr').find('.username').text();
            // console.log(menu_id);
            $('#hapus_username').val(username);

            $('.namauser').val(username);
            
        })
    })
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
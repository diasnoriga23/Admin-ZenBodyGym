<?php 
    include '../includes/myfirebase.php';
    // include '../includes/expired.php';

    if (isset($_GET['getdata'])) {
        $users = $database->getReference('User')->getValue();
        $pembayaran = $database->getReference('Pembayaran')->getValue();
        if($users != null){
            $users = array_values($users);
            foreach($users as $k => $v){
                $users[$k]['payment'] = $pembayaran[$v['username']];
            }
        }else{
            $users = [];
        }
        echo json_encode(['data' => $users]);
        exit(0);
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
    <link rel="stylesheet" href="../css/datatables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Membership</title>
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
    <div class="container my-4">
            <div class="row">
                <div class="col-6 semi">
                    <div class="col my-1"><h2 class="my-0">Membership</h2></div>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-end align-items-end h-100 reg">
                        <a href="tambahmember.php" type="button" class="btn btn-primary">Tambah Member</a>
                    </div>
                </div>
            </div>
            <hr>
        </div>     
        <div class="container">
            <div class="animate__animated animate__fadeIn col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;padding:15px;">
                <table class="table table-borderless table-responsive text-center tabel tmember">
                    <thead class="med">
                        <tr>
                            <th class="text-center">ID Member</th>
                            <th>Username</th>
                            <th>Nomor Whatshapp</th>
                            <th>Tanggal Expired</th>
                            <th style="max-width:213px;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>  
    </div>      
    
    <!-- Modal -->
    <div class="modal fade" id="hapusmdl" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color:#000;" class="modal-title" id="hapusLabel">Hapus Member <span id="dialog_namauser"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="color:#000;">
        Apakah Anda Yakin Untuk Menghapus Member Tersebut ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form method="POST" action="../includes/data_model.php">
        <input type="hidden" name="username" id="hapus_username" value=""> 
        <button name="deleteUser" type="submit" class="btn btn-danger">Hapus</a>
        </form> 
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="../js/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        var table = $('.tmember').DataTable({
            "autoWidth": false,
            "info": false,
            "ajax" : "?getdata=true",
            "columns": [
                { "data": "no_id", "className": "text-start" },
                { "data": "username" },
                { "data": "no_wa" },
                { "data": "payment.tgl_bayar_selanjutnya" },
                { 
                    "width": "213px",
                    "data": null, 
                    "defaultContent" : '<td style="width:260px">\
                        <button  type="submit" class="btn btn-primary detail" style="width: 100px; margin-right: 3px;">Detail</button>\
                        <button  type="submit" class="btn btn-primary hapus" style="width: 100px; margin-left: 3px;">Hapus</button>\
                    </td>',
                    "orderable": false
                }
            ],
            "language": {
                "url": "../Indonesian.json"
            }
        });
        $('.tmember tbody').on('click', 'button', function (e) {
            var data = table.row($(this).parents('tr')).data();
            e = e.currentTarget;
            if (e.classList.contains("hapus")) {
                $('#hapus_username').val(data.username);
                $('#dialog_namauser').text(data.nama_leng);
                $('#hapusmdl').modal('toggle');
            }else{
                location.href = 'detailmember.php?username=' + data.username ;
            }
        });
    })
</script>
</body>
</html>
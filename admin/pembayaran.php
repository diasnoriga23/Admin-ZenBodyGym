<?php 
    // print_r($_POST);
    // exit(0);
    include '../includes/myfirebase.php';
    if (isset($_GET['getdata'])) {
        $users = $database->getReference('User')->getValue();
        $pembayaran = $database->getReference('Pembayaran')->getValue();
        if($users != null){
            $users = array_values($users);
            foreach($users as $k => $v){
                $p = $pembayaran[$v['username']];
                if (($p['validasi_pembayaran'] == 'invalid' || $p['validasi_pembayaran'] == 'validasipt') && empty($p['bayar_nanti'])) {
                    $users[$k]['pembayaran'] = $p;
                }else{
                    unset($users[$k]);
                }
            }
        }else{
            $users = [];
        }
        echo json_encode(['data' => array_values($users)]);
        exit(0);
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <title>Pembayaran</title>
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
                            <a href="pembayaran.php" class="nav-link active py-1"><i class="fa fa-credit-card px-1"></i>Pembayaran</a>
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
            <div class="col-4 semi">
                <h2 class="my-0">Pembayaran</h2>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="animate__animated animate__fadeIn col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;padding:15px;">
                <table class="table table-borderless tabel text-center tpayment">
                    <thead class="med">
                        <tr>
                            <th scope="col">ID Member</th>
                            <th scope="col">Username</th>
                            <th scope="col">Lama Member</th>
                            <th scope="col">Personal Trainer</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Bukti Transfer</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>  
    </div>
<form action="../includes/data_model.php" method="POST" id="form1">
    <input type="hidden" name="id_member" id="id_member">
    <input type="hidden" name="lama_member" id="lama_member">
    <input type="hidden" name="valid" id="validmode">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="../js/datatables.min.js"></script>
<script src="../js/main.js"></script>
<script>
    $(document).ready(function(){
        var table = $('.tpayment').DataTable({
            "autoWidth": false,
            "info": false,
            "order" : [],
            "ajax" : "?getdata=true",
            "columns": [
                { "data": "no_id", "className": "text-start" },
                { "data": "username" },
                { "data": function(e){ return e.pembayaran.validasi_pembayaran == 'validasipt' ? e.pembayaran.tgl_bayar_selanjutnya : e.lama_member + ' Bulan' } },
                { "data": function(e){ return e.pembayaran.cb_trainer } },
                { "data": function(e){ return number_format(e.pembayaran.total_harga) } },
                { "data": function(e){ return e.pembayaran.url_foto != 'null' ? '<a href="' + e.pembayaran.url_foto + '" target="_blank"  type="button" class="btn btn-primary">Lihat</span></a>' : '' } },
                { "data": function(e){
                    return '<button type="submit" name="' + (e.pembayaran.validasi_pembayaran == 'validasipt' ? 'validasi_pt' : 'validasi_pembayaran') + '" class="btn btn-primary" >Konfirmasi </button>\
                            <button name="tolak" type="submit" class="btn btn-primary" >Tolak</button>';
                }, "orderable" : false }
            ],
            "language": {
                "url": "../Indonesian.json"
            }
        });
        $('.tpayment tbody').on('click', 'button', function (e) {
            var data = table.row($(this).parents('tr')).data();
            e = e.currentTarget;
            $('#id_member').val(data.username);
            $('#lama_member').val(data.lama_member);
            btn = $('#validmode');
            btn.attr('name', e.name);
            btn.val(true);
            $('#form1').submit();
        });
    })
</script>
</body>
</html>
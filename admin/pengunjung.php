<?php 
    include '../includes/myfirebase.php';
    $date = empty($_GET['tgl']) ? date('d-m-Y') : date('d-m-Y', strtotime($_GET['tgl']));
    if (isset($_GET['getdata'])) {
        $pengunjung = $database->getReference('Pengunjung/' . $date)->getValue();
        if($pengunjung != null){
            $pengunjung = array_values($pengunjung);
        }else{
            $pengunjung = [];
        }
        echo json_encode(['data' => $pengunjung]);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Buku Pengunjung</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container">
                <div class="navbar-collapse  justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link py-1" aria-current="page"><i
                                    class="fa fa-home px-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="membership.php" class="nav-link py-1"><i
                                    class="fa fa-users px-1"></i>Membership</a>
                        </li>
                        <li class="nav-item">
                            <a href="trainers.php" class="nav-link py-1"><i class="fa fa-users px-1"></i>Trainers</a>
                        </li>
                        <li class="nav-item">
                            <a href="pembayaran.php" class="nav-link py-1"><i
                                    class="fa fa-credit-card px-1"></i>Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="pengunjung.php" class="nav-link active py-1"><i class="fas fa-book px-1"></i>Buku
                                Pengunjung</a>
                        </li>
                        <li class="nav-item">
                            <a href="manage.php" class="nav-link py-1"><i class="fas fa-chart-pie px-1"></i>Manage </a>
                        </li>
                        <li class="nav-item">
                            <a href="../includes/user_destroy.php" class="nav-link py-1"><i
                                    class="fas fa-sign-out-alt px-1"></i>Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="animate__animated animate__fadeIn content position-relative">
        <div class="container my-4">
            <div class="col-4 semi">
                <div class="col my-1">
                    <h2 class="my-0">Buku Pengunjung</h2>
                </div>
            </div>
            <hr>
        </div>
        <div class="container" style="top: 300px; width: 900px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2">
                    <div class="row">
                        <div class="col-6 med">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="tglf" class="col-form-label">Tanggal</label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="tglf" class="form-control" name="tgl" value="<?= date('Y-m-d', strtotime($date)) ?>">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" id="showf">Lihat</button>
                            </div>
                        </div>
                        </div>
                        <div class="col">
                            <div class="col d-flex justify-content-end align-items-end h-100 reg">
                                <a href="tambahpengunjung.php" type="button" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless tabel text-center tblpengunjung">
                        <thead class="med">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
        <script src="../js/datatables.min.js"></script>
        <script>
        $(document).ready(function() {
            var table = $('.tblpengunjung').DataTable({
                "autoWidth": false,
                "info": false,
                "order": [],
                'processing': true,
                "ajax": "?getdata=true",
                "columns": [
                    {
                        "data": "nama"
                    },
                    {
                        "data": "alamat"
                    },
                ],
                "language": {
                    "url": "../Indonesian.json"
                }
            });
            $('.tblpengunjung').css('min-height','200px');
            $('#showf').click(function(){
                table.ajax.url("?getdata=true&tgl=" + $('#tglf').val()).load()
            });
        });
        </script>
</body>

</html>
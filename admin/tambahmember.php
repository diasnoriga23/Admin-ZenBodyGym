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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Tambah Member</title>
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
    <div class="container animate__animated animate__fadeIn" style="top: 300px; width: 700px; padding-bottom:20px;">
    <div class="col-12 col-dsb-bg my-4 py-3">
        <h3 class="text-center med">Tambah Member</h3>
        <hr class="col-8 mx-auto">
        <div class="d-flex justify-content-center">
            <form method="POST" action="../includes/data_model.php" class="w-100">
                <div class="my-3 col-8 mx-auto reg">
                    <label for="usernames" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="username" required>
                </div>
                <div class="my-3 col-8 mx-auto reg">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input name="nama_leng" type="text" class="form-control" id="nama" required>
                </div>
                <div class="row justify-content-center">
                    <div class="my-3 col-4 reg">
                        <label for="tgl" class="form-label">Tanggal Lahir</label>
                        <input name="bt_datepicker" type="date" class="form-control" id="tgl" required>
                    </div>
                    <div class="my-3 col-4 reg">
                        <label for="no" class="form-label">Nomor Whatsapp</label>
                        <input name="no_wa" type="number" class="form-control inpu-number" id="no" required>
                    </div>
                </div>
                <div class="my-3 col-8 mx-auto reg">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="text" class="form-control" id="email" required>
                </div>
                <div class="my-3 col-8 mx-auto reg">
                    <label for="pass" class="form-label">Password</label>
                    <div class="input-group col-10">
                    <input name="password" type="password" class="form-control" id="pass" style="border:none;" required>
                    <span class="input-group-text" style="background-color:white; color:grey;">
                        <a class="text-dark" id="icon-click">
                            <i class="fas fa-eye p-1" id="eye"></i>
                        </a>
                    </span>
                    </div>
                </div>
                    <div class="my-3 col-3 offset-2 reg">
                    <label for="lama" class="form-label">Lama Member</label>
                    <select class="form-select" name="lama_member" required>
                        <option value="1">1 Bulan</option>
                        <option value="2">2 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="4">4 Bulan</option>
                        <option value="5">5 Bulan</option>
                    </select>
                </div>
                <div class="row mx-1 reg">
                <div class="form-check my-2 col-7 offset-2">
                    <input name="cb_trainer" class="form-check-input" type="checkbox" value="Pakai Personal Trainer">
                    <label class="form-check-label" for="flexCheckDefault">
                    Pakai Personal Trainer (Untuk 1 Bulan)
                </label>
                </div>
                </div>
                <div class="row reg">
                    <div class="my-3 col-8 mx-auto">
                        <td style="width:260px">
                            <Button name="addUser" type="submit" class="btn btn-primary" style="width: 100px; margin-right: 3px;">Simpan</Button>
                            <a href="membership.php" type="submit" class="btn btn-primary" style="width: 100px; margin-left: 3px;">Batal</a>
                        </td>
                    </div>
                </div>
            </form>
        </div>      
    </div>
    </div>
    <div class="modal fade" id="modlusernamedigunakan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body">
                <div style="color:black" id="msg">Username telah digunakan.<br>Silahkan pilih yang lain !</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $("#icon-click").click(function(){
            $("#eye").toggleClass('fa-eye-slash');
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
        btn_submit = $('[name="addUser"]');
        username = $('#username');
        checkusername = true;
        username.change(function(){
            if (!checkusername) {
                checkusername = true;
            }
        });
        username.blur(function(er){
            if (checkusername) {
                btn_submit.text("Please Wait ...");
                btn_submit.attr('disabled', true);
                $.get('../includes/data_model.php?checkUsername=true&username=' + username.val(), function(data, status){
                    if (!data.status) {
                        username.val("");
                        checkusername = false;
                        msg = $('#modlusernamedigunakan');
                        msg.find('#msg').text("Username Telah digunakan");
                        msg.modal('show');
                        username.focus();
                    }else{
                        btn_submit.attr('disabled', false);
                    }
                    btn_submit.text("Simpan");
                });
            }
        });

        email = $('#email');
        checkemail = true;
        email.change(function(){
            if (!checkemail) {
                checkemail = true;
            }
        });
        email.blur(function(er){
            if (checkemail) {
                btn_submit.text("Please Wait ...");
                btn_submit.attr('disabled', true);
                $.get('../includes/data_model.php?checkEmail=true&email=' + email.val(), function(data, status){
                    if (!data.status) {
                        email.val("");
                        checkemail = false;
                        msg = $('#modlusernamedigunakan');
                        msg.find('#msg').text("Email Telah digunakan");
                        msg.modal('show');
                        email.focus();
                    }else{
                        btn_submit.attr('disabled', false);
                    }
                    btn_submit.text("Simpan");
                });
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
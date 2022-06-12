<?php 
    include '../includes/myfirebase.php'; 
    include '../includes/expired.php';
    if (isset($_GET['deletevoucher'])) {
        $database->getReference('Voucher/' . $_GET['deletevoucher'])->remove();
        echo 'deleted';
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
    <title>Manage</title>
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
                            <a href="manage.php" class="nav-link active py-1"><i class="fas fa-chart-pie px-1"></i>Manage </a>
                        </li>
                        <li class="nav-item">
                            <a href="../includes/user_destroy.php" class="nav-link py-1"><i class="fas fa-sign-out-alt px-1"></i>Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:#000;" class="modal-title" id="exampleModalLabel">Hapus Bank <input type="text" class="namabank" value="<?php echo $value['bank']; ?>" style="background-color: white; border: none; color: black; font-weight: 500;" disabled></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color:#000;">
                Apakah Anda Yakin Untuk Menghapus Bank Tersebut ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="../includes/data_model.php">
                <input type="hidden" name="bank" id="hapus_bank" value="<?php echo $value['bank']; ?>"> 
                <button name="deleteRekening" type="submit" class="btn btn-danger">Hapus</a>
                </form> 
            </div>
        </div>
  </div>
</div>
<div class="modal fade" id="modaldelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:#000;" class="modal-title" id="exampleModalLabel">Hapus <span id="delname"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color:#000;">
                Apakah Anda Yakin Untuk Menghapusnya ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="deletevoucher" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
    <div class="animate__animated animate__fadeIn content position-relative">
        <div class="container my-4">
            <div class="col-4 semi">
                <div class="col my-1"><h2 class="my-0">Manage</h2></div>
            </div>
            <hr>
        </div>
        <div class="container" style="top: 300px; width: 900px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2">
                <table class="table table-borderless tabel text-center">
                <div class="row">
                <div class="col-6 med">
                    <div class="col my-1"><h2 class="my-0">Bank Pembayaran</h2></div>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-end align-items-end h-100 reg">
                        <a href="tambahrekening.php" type="button" class="btn btn-primary">Tambah Bank</a>
                    </div>
                </div>
            </div>
            <hr>
                    <thead class="med">
                        <tr>
                            <th scope="col">Bank</th>
                            <th scope="col">Nama Pemilik Rekening</th>
                            <th scope="col">Nomor Rekening</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    
                        $reference_rekening = 'Rekening/';
                        $checkdata_rekening = $database->getReference($reference_rekening)->getValue();
                        if($checkdata_rekening != null){
                        foreach($checkdata_rekening as $value){
                   ?>
                    <tbody class="reg">                    
                        <tr>
                            <td class="bank"><?php echo $value['bank']; ?></td>
                            <td><?php echo $value['nama_rek']; ?></td>
                            <td><?php echo $value['no_rek']; ?></td>
                            <td style="width:260px">
                                <a href="editrekening.php?bank=<?php echo $value['bank']; ?>" type="button" class="btn btn-primary" style="width: 100px; margin-right: 3px; ">Edit</a>
                                <button  type="submit" class="btn btn-primary hapus" style="width: 100px; margin-left: 3px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                    <?php } }else{
                        echo "Tidak Ada Bank";
                    }?>
                </table>
                </div>
            </div>
        </div>  
        <div class="container" style="top: 300px; width: 900px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2">
                <table class="table table-borderless tabel text-center">
                <div class="row">
                <div class="col-6 med">
                    <div class="col my-1"><h2 class="my-0">Voucher</h2></div>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-end align-items-end h-100 reg">
                        <a href="tambahvoucher.php" type="button" class="btn btn-primary">Tambah Voucher</a>
                    </div>
                </div>
            </div>
            <hr>
                    <thead class="med">
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Potongan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php
                        $checkdata_rekening = $database->getReference('Voucher')->getValue();
                        if($checkdata_rekening != null){
                        foreach($checkdata_rekening as $k => $v){
                   ?>
                    <tr>
                        <td class="bank"><?= $k ?></td>
                        <td><?= $v['value'] . ($v['persen'] == '1' ? '%' : '') ?></td>
                        <td style="width:260px">
                            <button id="<?= $k ?>" class="btn btn-primary hapusv" style="width: 100px; margin-left: 3px;" >Hapus</button>
                        </td>
                    </tr>
                    <?php } }else{
                        echo "Tidak Ada Voucher";
                    }?>
                </table>
                </div>
            </div>
        </div>  

                    <?php 
                        $reference_paketpt = 'Paket_Pt/pakai_pt';
                        $checkdata_paketpt = $database->getReference($reference_paketpt)->getValue();
                       
                   ?>
        <div class="container" style="top: 300px; width: 900px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2">
            <div class="row">
                <div class="col-6 semi">
                    <div class="col my-1"><h2 class="my-0">Paket</h2></div>
                </div>
            </div>
            <hr>
                <div class="row reg">
                    <div class="col-5 mx-1">Personal Trainer</div>
                    <div class="col">: Rp.<?php
                            if($checkdata_paketpt['harga'] != null){
                                echo number_format($checkdata_paketpt['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                    <?php 
                        $reference_paketmb = 'Paket_Member/1bulan';
                        $checkdata_paketmb = $database->getReference($reference_paketmb)->getValue();
                   ?>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Lama Membership 1 Bulan</div>
                    <div class="col mt-4">: Rp.<?php
                            if($checkdata_paketmb['harga'] != null){
                                echo number_format($checkdata_paketmb['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                <?php 
                        $reference_paketmb = 'Paket_Member/2bulan';
                        $checkdata_paketmb = $database->getReference($reference_paketmb)->getValue();
                   ?>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Lama Membership 2 Bulan</div>
                    <div class="col mt-4">: Rp.<?php
                            if($checkdata_paketmb['harga'] != null){
                                echo number_format($checkdata_paketmb['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                <?php 
                        $reference_paketmb = 'Paket_Member/3bulan';
                        $checkdata_paketmb = $database->getReference($reference_paketmb)->getValue();
                   ?>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Lama Membership 3 Bulan</div>
                    <div class="col mt-4">: Rp.<?php
                            if($checkdata_paketmb['harga'] != null){
                                echo number_format($checkdata_paketmb['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                <?php 
                        $reference_paketmb = 'Paket_Member/4bulan';
                        $checkdata_paketmb = $database->getReference($reference_paketmb)->getValue();
                   ?>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Lama Membership 4 Bulan</div>
                    <div class="col mt-4">: Rp.<?php
                            if($checkdata_paketmb['harga'] != null){
                                echo number_format($checkdata_paketmb['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                <?php 
                        $reference_paketmb = 'Paket_Member/5bulan';
                        $checkdata_paketmb = $database->getReference($reference_paketmb)->getValue();
                   ?>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Lama Membership 5 Bulan</div>
                    <div class="col mt-4">: Rp.<?php
                            if($checkdata_paketmb['harga'] != null){
                                echo number_format($checkdata_paketmb['harga']);
                            }else {
                                echo "0";
                            }?></div>
                </div>
                <div class="row reg">
                    <div class="col-3 mx-1 mt-4">
                    <a href="editpaket.php" type="button" class="btn btn-primary">Edit Paket</a>
                </div>
                </div>
                </div>
            </div>
        </div>  
        <?php 
                        $reference8 = 'No_Wa/';
                        $checkdata8 = $database->getReference($reference8)->getValue();
                   ?>
      
      <div class="container" style="top: 300px; width: 900px; padding-bottom: 20px;">
            <div class="col-12 col-dsb-bg my-4 py-3">
                <div class="col mx-5 my-2">
            <div class="row">
                <div class="col semi">
                    <div class="col my-1"><h2 class="my-0">Nomor Whatshapp Personal Trainer</h2></div>
                </div>
            </div>
            <hr>
                <div class="row reg">
                    <div class="col-5 mx-1">Nama Trainer</div>
                    <div class="col">: <?php echo $checkdata8['nama_pt']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-5 mx-1 mt-4">Nomor Whatshapp</div>
                    <div class="col mt-4">: <?php echo $checkdata8['no_wa_pt']; ?></div>
                </div>
                <div class="row reg">
                    <div class="col-3 mx-1 mt-4">
                    <a href="editkontak.php" type="button" class="btn btn-primary" style="margin-right: 3px; ">Edit Kontak</a>
                </div>
            </div>
        </div> 
        </div>
    </div>
<script>
    $(document).ready(function(){
        $('.hapus').click(function(e) {
            e.preventDefault();

            var bank = $(this).closest('tr').find('.bank').text();
            // console.log(menu_id);
            $('#hapus_bank').val(bank);

            $('.namabank').val(bank);
            
        });
        voucher_todelete = '';
        modal_delete = $('#modaldelete');
        $('.hapusv').click(function(e){
            e = e.currentTarget;
            voucher_todelete = e.id;
            modal_delete.find('#delname').text(e.id);
            modal_delete.modal('show');
        });
        $('#deletevoucher').click(function(e){
            e = e.currentTarget;
            e.innerText = 'Proses ...';
            $.get('?deletevoucher=' + voucher_todelete, function(data, status){
                location.reload();
            });
        });
    })
    </script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
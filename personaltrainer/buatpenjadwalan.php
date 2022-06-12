<?php
    include '../includes/myfirebase.php';
    // data detail user
    $isedit = false;
   if (!empty($_GET['edit'])) {
       $edata = $database->getReference('Jadwal/' . $_GET['edit'])->getValue();
       $isedit = isset($edata);
   }

   $username_url = empty($edata) ? $_GET['username'] : $_GET['edit'];
   $path_user_details = 'User/'.$username_url;
   $checkdata_user_details = $database->getReference($path_user_details)->getValue();

   function getTgl($minggu, $tgl){
       global $edata;
        return date('Y-m-d', strtotime($edata["minggu_ke_$minggu"]['ming' . $minggu . "_tgl_ke$tgl"]));
   }
   function getJam($minggu, $jam){
        global $edata;
        return $edata["minggu_ke_$minggu"]['ming' . $minggu . "_jam_ke$jam"];
   }
   function canEdit($minggu, $tgl){
       global $edata;
       return isset($edata['jadwal_selesai']['ming' . $minggu . "_tgl_ke$tgl"]) && $edata['jadwal_selesai']['ming' . $minggu . "_tgl_ke$tgl"]['status'] == 'Hadir' ? 'disabled ' : '';
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
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <title>Buat Jadwal</title>
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
                            <a href="jadwalhariini.php" class="nav-link py-1"><i class="fa fa-calendar px-1"></i>Jadwal Hari Ini</a>
                        </li>
                        <li class="nav-item">
                            <a href="buatjadwal.php" class="nav-link active py-1"><i class="fas fa-calendar-plus px-1"></i>Buat Jadwal</a>
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
                <div class="col my-1"><h2 class="my-0">Buat Jadwal</h2></div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="col-12 col-dsb-bg my-4 py-3" style="min-height: 300px;">
                <table class="table table-borderless tabel text-center">
                    <thead class="med">
                        <tr>
                        <div class="col mx-5 mb-3"><span>Username : <b><?php echo $checkdata_user_details['username']; ?></b></span></div>
                            <th scope="col">Minggu Ke 1</th>
                            <th scope="col">Minggu Ke 2</th>
                            <th scope="col">Minggu Ke 3</th>
                            <th scope="col">Minggu Ke 4</th>
                        </tr>
                    </thead>
                    <tbody class="reg">
                    <form method="POST" action="../includes/data_model.php">
                    <input type="hidden" name="isEdit" value="<?= isset($edata) ? '1' : '0' ?>">
                    <input type="hidden" name="username" value="<?php echo $username_url ?>">
                        <tr hari="1">
                            <td class="col-1 mt-3" align="center" minggu="1">
                            <p>Hari Ke 1</p>   
                                <div style="width:180px;">                                                            
                                    <input name="ming1_tgl_ke1" <?php if($isedit){ echo  canEdit(1, 1); echo 'value="' . getTgl(1, 1) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(1, 1); echo 'value="' . getJam(1, 1) . '"'; } ?> name="ming1_jam_ke1" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px" ></div> 
                                </div>    
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="2">
                            <p>Hari Ke 1</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming2_tgl_ke1" <?php if($isedit){ echo  canEdit(2, 1); echo 'value="' . getTgl(2, 1) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(2, 1); echo 'value="' . getJam(2, 1) . '"'; } ?> name="ming2_jam_ke1" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="3">
                            <p>Hari Ke 1</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming3_tgl_ke1" <?php if($isedit){ echo  canEdit(3, 1); echo 'value="' . getTgl(3, 1) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required> 
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(3, 1); echo 'value="' . getJam(3, 1) . '"'; } ?> name="ming3_jam_ke1" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="4">
                            <p>Hari Ke 1</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming4_tgl_ke1" <?php if($isedit){ echo  canEdit(4, 1); echo 'value="' . getTgl(4, 1) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(4, 1); echo 'value="' . getJam(4, 1) . '"'; } ?> name="ming4_jam_ke1" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                        </tr>
                        <tr hari="2">
                            <td class="col-1 mt-3" align="center" minggu="1">
                            <p>Hari Ke 2</p>   
                                <div class="input-group" style="width:180px;">                                                            
                                    <input name="ming1_tgl_ke2" <?php if($isedit){ echo  canEdit(1, 2); echo 'value="' . getTgl(1, 2) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(1, 2); echo 'value="' . getJam(1, 2) . '"'; } ?> name="ming1_jam_ke2" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="2">
                            <p>Hari Ke 2</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming2_tgl_ke2" <?php if($isedit){ echo  canEdit(2, 2); echo 'value="' . getTgl(2, 2) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(2, 2); echo 'value="' . getJam(2, 2) . '"'; } ?> name="ming2_jam_ke2" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="3">
                            <p>Hari Ke 2</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming3_tgl_ke2" <?php if($isedit){ echo  canEdit(3, 2); echo 'value="' . getTgl(3, 2) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(3, 2); echo 'value="' . getJam(3, 2) . '"'; } ?> name="ming3_jam_ke2" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="4">
                            <p>Hari Ke 2</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming4_tgl_ke2" <?php if($isedit){ echo  canEdit(4, 2); echo 'value="' . getTgl(4, 2) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(4, 2); echo 'value="' . getJam(4, 2) . '"'; } ?> name="ming4_jam_ke2" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                        </tr>
                        <tr hari="3">
                            <td class="col-1 mt-3" align="center" minggu="1">
                            <p>Hari Ke 3</p>   
                                <div class="input-group" style="width:180px;">                                                            
                                    <input name="ming1_tgl_ke3" <?php if($isedit){ echo  canEdit(1, 3); echo 'value="' . getTgl(1, 3) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(1, 3); echo 'value="' . getJam(1, 3) . '"'; } ?> name="ming1_jam_ke3" type="text" id="inputPassword6" class="form-control mt-3 jadwal_field" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                                
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="2">
                            <p>Hari Ke 3</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming2_tgl_ke3" <?php if($isedit){ echo  canEdit(2, 3); echo 'value="' . getTgl(2, 3) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(2, 3); echo 'value="' . getJam(2, 3) . '"'; } ?> name="ming2_jam_ke3" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="3">
                            <p>Hari Ke 3</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming3_tgl_ke3" <?php if($isedit){ echo  canEdit(3, 3); echo 'value="' . getTgl(3, 3) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required>
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(3, 3); echo 'value="' . getJam(3, 3) . '"'; } ?> name="ming3_jam_ke3" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>
                            </td>
                            <td class="col-1 mt-3" align="center" minggu="4">
                            <p>Hari Ke 3</p>  
                                <div class="input-group" style="width:180px;">                             
                                    <input name="ming4_tgl_ke3" <?php if($isedit){ echo  canEdit(4, 3); echo 'value="' . getTgl(4, 3) . '"'; } ?> type="date" id="inputPassword6" class="form-control jadwal_field" aria-describedby="nama" required> 
                                </div>      
                                <div class="input-group" style="width:180px;">                             
                                    <input style="border: none;" <?php if($isedit){ echo canEdit(4, 3); echo 'value="' . getJam(4, 3) . '"'; } ?> name="ming4_jam_ke3" type="text" id="inputPassword6" class="form-control jadwal_field mt-3" aria-describedby="nama" required>
                                    <div class="input-group-text fas fa-clock p-2 mt-3" style="background-color:white; width: 50px"></div> 
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td class="col-1 mt-3" align="center">
                            <Button name="addJadwal" type="submit" class="btn btn-primary" style="width: 100px; margin-right: 3px; ">Simpan</Button>  
                            <a href="buatjadwal.php" type="submit" class="btn btn-primary" style="width: 100px; margin-left: 3px;">Batal</a>    
                        </td>
                        </tr>
                        </form> 
                    </tbody>                                    
                </table>
            </div>
        </div>  
    </div>  
    <div class="modal fade" id="modaljadwaldigunakan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body">
                <div style="color:black">Waktu pada tanggal yang sama telah digunakan</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script>
    selected_hari = null;
    btn_submit = $('[name="addJadwal"');
    isedit = false;
    $('.jadwal_field').blur(function(er){
        e = er.currentTarget.parentElement.parentElement;
        tgl = e.children[1].children[0].value;
        jam = e.children[2].children[0].value;
        hari = e.parentElement.attributes["hari"].value;
        minggu = e.attributes["minggu"].value;
        if (tgl != '' && jam != '' && selected_hari != hari && isedit) {
            selected_hari = hari;
            isedit = false;
            btn_submit.text("Please Wait ...");
            btn_submit.attr('disabled', true);
            $.post('../includes/data_model.php?checkJadwal=true', { hari: hari, minggu: minggu, tgl: tgl, jam: jam }, function(data, status){
                if (!data.status) {
                    $('#modaljadwaldigunakan').modal('show')
                    er.currentTarget.value = "";
                    er.currentTarget.focus();
                }else{
                    btn_submit.attr('disabled', false);
                }
                btn_submit.text("Simpan");
            });
        }
    });
    $('.jadwal_field').change(function(){
        if (selected_hari != null) {
            selected_hari = null;
        }
        isedit = true;
    });
</script>
</body>
</html>
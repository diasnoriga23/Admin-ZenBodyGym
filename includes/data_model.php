<?php

    include 'myfirebase.php';
    session_start();

    if(isset($_POST['masuk'])){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if($username != null){
            if($password != null){
                $reference = 'Admin/'.$username;
                $checkdata = $database->getReference($reference)->getValue();
                if($checkdata != null){
                    if($password != null){

                        //ambil data
                        $password_admin_saat_ini = $checkdata['password'];
                       
                       if($password == $password_admin_saat_ini){
                           //jawaban benar
                           $_SESSION['username'] = $username;
                            if ($checkdata['hak_akses']=='Admin'){
                               header('location: ../admin/dashboard.php'); 
                            }else if($checkdata['hak_akses']=='Personal Trainer'){
                                header('location: ../personaltrainer/dashboardpt.php'); 
                            }
                           
                       }else{
                        echo 'Password Salah';
                       }
                        
                    }
                    else{
                        echo 'Password Salah';
                    }
                }else{
                    echo 'Data Tidak Tersedia';
                }
            }
        }
    }

    else if(isset($_POST['deleteUser'])){

        $username_url = $_POST['username'];
     
        $reference = 'User/'.$username_url;
        $reference_pembayaran = 'Pembayaran/'.$username_url;
        $reference_jadwal= 'Jadwal/'.$username_url;

       
        // upload ke server
        $pushData = $database->getReference($reference)->remove();
        $removePembayaran = $database->getReference($reference_pembayaran)->remove();
        $removeJadwal = $database->getReference($reference_jadwal)->remove();
        $database->getReference("Report/$username_url")->remove();

        // lempar ke customer
        header('location: ../admin/membership.php'); 

    }

    else if(isset($_POST['validasi_pembayaran'])){
        // $awal_member            = date("d-m-Y");
        // $tigapiuh_hari          = mktime(0,0,0,date("n"),date("j")+30,date("Y"));
        // $tgl_bayar_selanjutnya  = date("d-m-Y", $tigapiuh_hari);

        $id_member = $_POST['id_member'];
        $lama = (int)$_POST['lama_member'];
        $tanggal = date('d-m-Y');
        // $next_date = date('d-m-Y', strtotime($tanggal . '+'.$lama. 'month'));
        $next_date = date('d-m-Y', strtotime($tanggal . ' + '.($lama * 30). ' days'));

        $data = [
            'validasi_pembayaran' => 'valid',
            'tgl_bayar_selanjutnya' => $next_date
          
        ];

        $old_payment = $database->getReference("Pembayaran/$id_member")->getValue();
        if (isset($old_payment) && empty($old_payment['start_member'])) {
            $data['start_member'] = $tanggal;
        }
     
        $reference = 'Pembayaran/'.$id_member;

        
        $reference_pembayaran = 'Pembayaran/'.$username_url;
        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/pembayaran.php'); 

    }

    else if(isset($_POST['validasi_pt'])){

        $id_member = $_POST['id_member'];

     
        $reference = 'Pembayaran/'.$id_member;

        $data = [
                    'validasi_pembayaran' => 'valid'
                  
                ];
        $reference_pembayaran = 'Pembayaran/'.$username_url;
        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/pembayaran.php'); 

    }
    
    else if(isset($_POST['addUser'])){
        
        $username = htmlspecialchars($_POST['username']);
        $reference_user = 'User/'.$username;
        $checkdata_user = $database->getReference($reference_user)->getValue();
        if($checkdata_user != null){
            // echo "<script> header('location:../Admin/Tambah_Member.php');</script>";
            echo "<script type='text/javascript'>alert('Username Telah Digunakan !!');</script>";
            echo "<script> window.location.href = '../admin/tambahmember.php'; </script>";
           
        }else{

        $lama = htmlspecialchars($_POST['lama_member']);
        $cb_trainer = htmlspecialchars($_POST['cb_trainer']);
        $tanggal = date('d-m-Y');
        $next_date = date('d-m-Y', strtotime($tanggal . '+'.$lama. 'month'));

        if($cb_trainer == null){
            $cb_trainer = "Tidak Pakai Personal Trainer";
            $harga_trainer = 0;
        }else{
            $tainer = 'Paket_Pt/pakai_pt';
            $checkdata_tainer = $database->getReference($tainer)->getValue();
            $harga_trainer = $checkdata_tainer['harga'];
        }
        $lama_member=$lama.'bulan';
        $paket = 'Paket_Member/'.$lama_member;
        $checkdata_paket = $database->getReference($paket)->getValue();
        $hargapaket = $checkdata_paket['harga'];
        $total_bayar = $hargapaket + $harga_trainer;
        

        $reference = 'Pembayaran/'.$username;

        $data = [   
                    'url_foto' => '-',
                    'cb_trainer' => $cb_trainer,                   
                    'tgl_bayar_selanjutnya' => "$next_date",
                    'total_harga' => $total_bayar,
                    'validasi_pembayaran' => 'valid',
                    'validasi_jadwal' => 'Belum Terjadwal'

                ];
        $pushData = $database->getReference($reference)->set($data);

        $username = htmlspecialchars($_POST['username']);
        $nama_leng = htmlspecialchars($_POST['nama_leng']);
        $bt_datepicker = htmlspecialchars($_POST['bt_datepicker']);
        $no_wa = htmlspecialchars($_POST['no_wa']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $lama_member = htmlspecialchars($_POST['lama_member']);
        $no_id = 'MB'.rand(1,9999);
     
        $reference = 'User/'.$username;

        $data = [
            'username' => $username,
            'nama_leng' => $nama_leng,
            'bt_datepicker' => $bt_datepicker,
            'no_wa' => $no_wa,
            'email' => $email,
            'password' => $password,
            'lama_member' => $lama_member,
            'no_id' => $no_id
            
        ];

        // upload ke server
        $pushData = $database->getReference($reference)->set($data);

        // lempar ke customer
        header('location: ../admin/membership.php'); 
    }
    }

    else if(isset($_POST['addJadwal'])){ 
        $username_url = htmlspecialchars($_POST['username']);
        $isEdit = $_POST['isEdit'] == '1';

        if (!$isEdit) {
            $database->getReference("Jadwal/" . $username_url)->remove();
            $pushData = $database->getReference('Pembayaran/'.$username_url)->update([   
                'validasi_jadwal' => 'Sudah Terjadwal'
            ]);
        }else{
            $data = $database->getReference('Jadwal/'.$username_url)->getValue();
        }

        for ($mingg=1; $mingg <= 4; $mingg++) {
            for ($tgl=1; $tgl <= 3; $tgl++) {
                if (!empty($_POST["ming$mingg" . "_tgl_ke$tgl"])) {
                    $newtgl = htmlspecialchars(date('d-m-Y', strtotime($_POST["ming$mingg" . "_tgl_ke$tgl"])));
                    $newjam = htmlspecialchars($_POST["ming$mingg" . "_jam_ke$tgl"]);

                    if ($data["minggu_ke_$mingg"]["ming$mingg" . "_tgl_ke$tgl"] != $newtgl || $data["minggu_ke_$mingg"]["ming$mingg" . "_jam_ke$tgl"] != $newjam) {
                        $data['jadwal_selesai']["ming$mingg" . "_tgl_ke$tgl"] = null;
                    }

                    $data["minggu_ke_$mingg"]["ming$mingg" . "_tgl_ke$tgl"] = $newtgl;
                    $data["minggu_ke_$mingg"]["ming$mingg" . "_jam_ke$tgl"] = $newjam;
                }
            }
        }
        $data['trainer'] = $_SESSION['username'];
        $database->getReference('Jadwal/'.$username_url)->set($data);

        // lempar ke customer
        header('location: ../personaltrainer/detailjadwal.php?username='.$username_url); 

    }

    else if(isset($_POST['updateRek'])){ 
        $bank_url = htmlspecialchars($_POST['bank_url']);
        $nama_rek = htmlspecialchars($_POST['nama_rek']);
        $no_rek = htmlspecialchars($_POST['no_rek']);
        

        $reference = 'Rekening/'.$bank_url;

        $data = [   
                    'nama_rek' => $nama_rek,
                    'no_rek' => $no_rek,
                    'bank' => $bank_url
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['updatePak'])){ 

        $nama_rek = htmlspecialchars($_POST['nama_rek']);
        $no_rek = htmlspecialchars($_POST['no_rek']);
        $bank = htmlspecialchars($_POST['bank']);

        $reference = 'Rekening/';

        $data = [   
                    'nama_rek' => $nama_rek,
                    'no_rek' => $no_rek,
                    'bank' => $bank
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['updateTrain'])){ 

        $harga = htmlspecialchars($_POST['harga']);
        $harga1 = htmlspecialchars($_POST['harga1']);
        $harga2 = htmlspecialchars($_POST['harga2']);
        $harga3 = htmlspecialchars($_POST['harga3']);
        $harga4 = htmlspecialchars($_POST['harga4']);
        $harga5 = htmlspecialchars($_POST['harga5']);

        $reference = 'Paket_Pt/pakai_pt';

        $data = [   
                    'harga' => $harga
                  
                ];

        $pushData = $database->getReference($reference)->update($data);


        $harga = htmlspecialchars($_POST['harga']);

        $reference = 'Paket_Member/1bulan';

        $data = [   
                    'harga' => $harga1
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        $harga = htmlspecialchars($_POST['harga']);

        $reference = 'Paket_Member/2bulan';

        $data = [   
                    'harga' => $harga2
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        $harga = htmlspecialchars($_POST['harga']);

        $reference = 'Paket_Member/3bulan';

        $data = [   
                    'harga' => $harga3
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        $harga4 = htmlspecialchars($_POST['harga4']);

        $reference = 'Paket_Member/4bulan';

        $data = [   
                    'harga' => $harga4
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        $harga5 = htmlspecialchars($_POST['harga5']);

        $reference = 'Paket_Member/5bulan';

        $data = [   
                    'harga' => $harga5
                  
                ];

        $pushData = $database->getReference($reference)->update($data);



        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['updateWa'])){ 

        $nama_pt = htmlspecialchars($_POST['nama_pt']);
        $no_wa_pt = htmlspecialchars($_POST['no_wa_pt']);

        $reference = 'No_Wa/';

        $data = [   
                    'nama_pt' => $nama_pt,
                    'no_wa_pt' => $no_wa_pt
                  
                ];

        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['deleteRekening'])){
        $bank_url = $_POST['bank'];
        $reference_rekening = 'Rekening/'.$bank_url;

       
        // upload ke server
        $pushData = $database->getReference($reference_rekening)->remove();

        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['addRek'])){

        $bank = htmlspecialchars($_POST['bank']);
        $nama_rek = htmlspecialchars($_POST['nama_rek']);
        $no_rek = htmlspecialchars($_POST['no_rek']);
       
        $reference = 'Rekening/'.$bank;

        $data = [
            'bank' => $bank,
            'nama_rek' => $nama_rek,
            'no_rek' => $no_rek
            
        ];

        // upload ke server
        $pushData = $database->getReference($reference)->set($data);

        // lempar ke customer
        header('location: ../admin/manage.php'); 

    }

    else if(isset($_POST['deleteJadwal'])){

        $username_url = $_POST['username'];
     
        $reference = 'Jadwal/'.$username_url;

       
        $pushData = $database->getReference($reference)->remove();


        $reference = 'Pembayaran/'.$username_url;

                            $data = [

                                'validasi_pembayaran' => 'invalid',
                                'validasi_jadwal' => 'Belum Terjadwal',
                                'total_harga' => '',
                                'url_foto' => 'null'
                            ];

                            // upload to server
                            $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../personaltrainer/jadwal.php'); 

    } 
    
    else if(isset($_POST['tolak'])){
        $id_member1 = $_POST['id_member'];
     
        $reference = 'Pembayaran/'.$id_member1;

        $data = [
                    'validasi_pembayaran' => 'valid',
                    'url_foto' => 'null'
                  
                ];
        $reference_pembayaran = 'Pembayaran/'.$username_url;
        $pushData = $database->getReference($reference)->update($data);

        // lempar ke customer
        header('location: ../admin/pembayaran.php'); 

    }

    else if(isset($_POST['addPengun'])){ 
        $hariini           = date("d-m-Y");
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);

        $reference11 = 'Pengunjung/'.$hariini.'/'.$nama;

        $data = [   
                    'nama' => $nama,
                    'alamat' =>  $alamat
                  
                ];
        $pushData = $database->getReference($reference11)->set($data);        

        // lempar ke customer
        header('location: ../admin/pengunjung.php'); 

    }

    else if (isset($_GET['checkJadwal'])) {
        $status = true;
        $check_jadwal = $database->getReference('Jadwal')
        ->getValue();
        if ($check_jadwal != null) {
            foreach ($check_jadwal as $v) {
                foreach ($v as $v2) {
                    if (is_array($v2)) {
                        foreach ($v2 as $k => $v3) {
                            if (is_string($v3) && $v3 == date('d-m-Y', strtotime($_POST['tgl']))) {
                                preg_match('/ming([0-9])_tgl_ke([0-9])/', $k, $out);
                                if (strpos($v2['ming' . $out[1] . '_jam_ke' . $out[2]], explode('-', $_POST['jam'])[0]) !== false) {
                                    $status = false;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode(['status' => $status]);
    }

    else if (isset($_GET['checkUsername']) && !empty($_GET['username'])) {
        $role = empty($_GET['role']) ? 'User' : 'Admin';
        $check_uname = $database->getReference($role)
        ->getValue();
        $status = empty($check_uname[$_GET['username']]);
        header("Content-type: application/json");
        echo json_encode(['status' => $status]);
    }
    else if (isset($_GET['checkEmail']) && !empty($_GET['email'])) {
        $check_uname = $database->getReference('User')
        ->getValue();
        $status = true;
        foreach ($check_uname as $v) {
            if ($v['email'] == $_GET['email']) {
                $status = false;
                break;
            }
        }
        header("Content-type: application/json");
        echo json_encode(['status' => $status]);
    }
    else if (isset($_GET['getdata'])) {
        $users = $database->getReference('User')->getValue();
        $pembayaran = $database->getReference('Pembayaran')->getValue();
        $konfirmasi_pemabayaran = 0;
        $member_kurangdari5hari = [];
        $member_expired = 0;
        foreach ($pembayaran as $k => $v) {
            if (isset($users[$k])) {
                if ($v['validasi_pembayaran'] == 'valid') {
                    $diff = strtotime($v['tgl_bayar_selanjutnya'] . ' +1 days') - time();
                    $diff = floor($diff/86400);
                    if ($diff <= 5 && $diff >= 1) {
                        $usr = $users[$k];
                        $member_kurangdari5hari[] = ['username' => $usr['username'], 'nama_leng' => $usr['nama_leng']];
                    }else if($diff < 1){
                        $member_expired++;
                    }
                }else{
                    $konfirmasi_pemabayaran++;
                }
            }
        }
        $data = [
            'total_user' => count($users),
            'konfirmasi_pemabayaran' => $konfirmasi_pemabayaran,
            'member_kurangdari5hari' => $member_kurangdari5hari,
            'member_expired' => $member_expired
        ];
        header("Content-type: application/json");
        echo json_encode($data);
    }

?> 
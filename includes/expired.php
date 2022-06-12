<?php
    $users = $database->getReference('User')->getValue();
    $data_pembayaran = $database->getReference('Pembayaran')->getValue();
    if($data_pembayaran != null){
        foreach($users as $value2){
            $username = $value2['username'];
            $exp_date = $data_pembayaran[$username]['tgl_bayar_selanjutnya'];

            if($exp_date != '-' && (strtotime($exp_date) < strtotime(date('d-m-Y')))){
            
                $reference = 'Pembayaran/'.$username;
                $data = [

                    'validasi_pembayaran' => 'invalid',
                    'tgl_bayar_selanjutnya' => '-',
                    'total_harga' => '',
                    'validasi_jadwal' => 'Belum Terjadwal',
                    'url_foto' => 'null'
                ];
                // upload to server
                $pushData = $database->getReference($reference)->update($data);
                // upload to server
                $pushData = $database->getReference('Jadwal/'.$username)->remove($data);
            }
        }
    }
?>
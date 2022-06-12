<?php  

include '../includes/myfirebase.php';


$tes = 'Admin/admin001';
$cek = $database->getReference($tes)->getValue();

echo $cek['username'];

?>
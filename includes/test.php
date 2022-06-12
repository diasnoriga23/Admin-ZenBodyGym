<?php
    include "./myfirebase.php";

    $data = $database->getReference('User/')
    ->orderByChild('trainer')
    ->equalTo('trainer2')
    ->getValue();
    print_r($data);
?>
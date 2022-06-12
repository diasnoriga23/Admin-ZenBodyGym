<?php 
if(isset($_POST['username'])){
    $username  = $_POST["username"];
    $reference_user = 'User/'.$username;
    $checkdata_user = $database->getReference($reference_user)->getValue();
    if(count($checkdata_user)==0){
         echo '<span class="text-danger">Not Exist</span>';
    }else{
        echo '<span class="text-success">Exist</span>';
    }

}
?> 
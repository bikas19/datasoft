<?php 
require('inc/auth.php');
//checking if file deletion is allowed
if($user && $user['role_id']>0 && $user['role_id']<3){

}
else{
    header('location: index.php');
}

if(isset($_GET['id'])){
    $id= $_GET['id'];

    $query="delete from foods where id='$id'";
    $r=$dbconnection->query($query);

    if($r){
        $_SESSION['message']="Successfully deleted food item";
        header('location: index.php');
    }
}else{
    $_SESSION['message']= "Invalid Request";
    header('location:index.php');
}
?>
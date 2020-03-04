<?php
require_once('db.php');
session_start();

//default is not logged in
$login = false;
$user = null;

if(isset($_SESSION['login']) &&  isset($_SESSION['user'])){
    $user_id= $_SESSION['user'];
    $login=$_SESSION['login'];
    
    //find user details as only id of logged in user is saved in cookies
    $query="select * from users where users.id='$user_id'";
    $result= $dbconnection->query($query);
    
    if($result){
        $user = $result->fetch_assoc();
        $login=true;
    }else{
        session_destroy();
        $user=null;
        $login = false;
    }
}

//if logged in, $login will be true and $user will contain details about logged in user fetched from database.

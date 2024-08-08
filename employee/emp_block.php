<?php
session_start();
 include '../conn.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION["status"]="Tolong login dengan akun anda";
    $_SESSION["code"]="warning";
    header("location: ../index.php");
    exit;
}
$sqli = "UPDATE users set status='".$_GET['type']."' WHERE id = '" . $_GET['id']. " ' ";
if(mysqli_query($con,$sqli))
{
	$_SESSION["title"]="Berhasil";
    if($_GET['type']=="Block"){
    $_SESSION["status"]="Blokir Akun Berhasil";
    }else{
        $_SESSION["status"]="Aktivasi Akun Berhasil";
    }
    $_SESSION["code"]="success";
    header("location: emp_list.php");
    exit;
}
else
{
	$_SESSION["title"]="Berhasil";
    if($GET['type']=="Block"){
    $_SESSION["status"]="Akun Tidak Diblokir";
    }else{
        $_SESSION["status"]="Akun Tidak Diaktivasi";
    }
    $_SESSION["code"]="error";
    header("location: emp_list.php");
    exit;
}

?>
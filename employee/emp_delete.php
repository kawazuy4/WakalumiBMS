<?php
session_start();
 include '../conn.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION["status"]="Tolong login dengan akun anda";
    $_SESSION["code"]="warning";
    header("location: ../index.php");
    exit;
}
$sqli = "DELETE FROM  emp_details WHERE id = '" . $_GET['id']. " ' ";
if(mysqli_query($con,$sqli))
{
	$_SESSION["title"]="Berhasil";
    $_SESSION["status"]="Akun Berhasil Dihapus";
    $_SESSION["code"]="success";
    header("location: emp_list.php");
    exit;
}
else
{
	$_SESSION["title"]="Berhasil";
    $_SESSION["status"]="Akun Tidak Dihapus";
    $_SESSION["code"]="error";
    header("location: emp_list.php");
    exit;
}

?>
<?php
session_start();
include '../conn.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $_SESSION["status"] = "Please login your account here";
  $_SESSION["code"] = "warning";
  header("location: ../index.php");
  exit;
}
if (isset($_POST['insert'])) {
  $name = $_POST['name'];
  $birth_place = $_POST['birth_place'];
  $nik = $_POST['nik'];
  $contact = $_POST['contact'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $postal = $_POST['postal'];
  $city = $_POST['city'];
  $address = $_POST['address'];
  $title = $_POST['title'];
  $type = $_POST['type'];
  $sql1 = "UPDATE accountsholder as a,accounts_info as c set a.name='$name',a.birth_place='$fname',a.nik='$nik',a.contact='$contact',a.dob='$dob',a.gender='$gender',a.email='$email',a.postal='$postal',a.city='$city',a.houseaddress='$address',c.account_type='$type',c.account_title='$title' where a.account=c.account and a.account='$id'";
  $rs = mysqli_query($con, $sql1) or die(mysqli_error($con));
  if ($rs) {

    $_SESSION["title"] = "Done";
    $_SESSION["status"] = "Akun Berhasil Diperbarui";
    $_SESSION["code"] = "success";
    header("location: search.php");
    exit();
  }
}
?>
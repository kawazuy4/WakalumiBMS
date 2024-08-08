<?php
session_start();
 include '../conn.php';
 include 'library.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION["status"]="Tolong login menggunakan akun anda";
    $_SESSION["code"]="warning";
    header("location: ../index.php");
    exit;
}
$id=$_GET['id'];
$sql="SELECT c.* , p.* FROM loanaccounts_info c, loan_accountsholder p WHERE c.loan_account = p.loan_account and p.loan_account='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 if (isset($_POST['insert'])){
        $name=$_POST['name'];
        $birth_place=$_POST['birth_place'];
        $nik=$_POST['nik'];
        $contact=$_POST['contact'];
        $dob=$_POST['dob'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
        $postal=$_POST['postal'];
        $city=$_POST['city'];
        $address=$_POST['address'];
        $title=$_POST['title'];
        $type=$_POST['type'];
        $sql1="UPDATE loan_accountsholder as a, loan_accounts_info as c set a.name='$name', a.birth_place='$birth_place', a.nik='$nik', a.contact='$contact', a.dob='$dob', a.gender='$gender', a.email='$email', a.postal='$postal', a.city='$city', a.house_address='$address', c.loanaccount_type='$type',c.loanaccount_title='$title' where a.loan_account=c.loan_account and a.loan_account='$id'";
        $rs=mysqli_query($con,$sql1)or die(mysqli_error($con));
        if($rs){
          
          $_SESSION["title"]="Done";
          $_SESSION["status"]="Akun Berhasil Diperbarui";
             $_SESSION["code"]="success";
             header("location: search.php");
             exit();
        }
 }
?>

<!DOCTYPE html>
<html>
<head>
    
    </style>
</head>
<body class="theme-blue">
<div class="overlay"></div>
    <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="../dashboard.php" style="font-size: 18px;">BPRS WAKALUMI</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="pull-right"><a href="logout.php"><i class="fa fa-fw fa-sign-out fa-lg"></i> Log Out</a>
                        </li>
                        <li class="pull-right"><a href="#bot"><i class="fa fa-fw fa-envelope fa-lg"></i> Kontak</a></li>
                        <!-- #END# Tasks -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['name']; ?></div>
                        <div class="email"><?php echo $_SESSION['email']; ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">more_vert</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="user_profile.php"><i class="material-icons">person</i>Profil</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="change_pin.php"><i class="material-icons">lock</i>Ganti Sandi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="menu">
                <ul class="list">
                    <li class="header">NAVIGASI UTAMA</li>
                    <li class="active">
                        <a href="../dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php
                    if ($_SESSION['type'] == "Admin" || $_SESSION["type"] == "Default") {
                        ?>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">group</i>
                                <span>Kelola Karyawan</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="new_emp.php">Tambah Akun Karyawan</a>
                                </li>
                                <li>
                                    <a href="emp_list.php">Daftar Karyawan</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Kelola Rekening</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="newaccount.php">Buat Rekening Baru</a>
                            </li>
                            <li>
                                <a href="search.php">Daftar Rekening</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">manage_accounts</i>
                            <span>Pengaturan Rekening</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="transfer.php">Transaksi</a>
                            </li>
                            <li>
                                <a href="deposit.php">Saldo Deposito</a>
                            </li>
                            <li>
                                <a href="withdraw.php">Penarikan Saldo</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_add</i>
                            <span>Aktivitas Rekening</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href="history.php?id=">Riwayat</a>
                            </li>
                            <li>
                                <a href="check_balance.php">Cek Saldo Terkini</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">store</i>
                            <span>Pinjaman dan Angsuran</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="new_loanaccount.php">Buat Akun Pinjaman Baru</a>
                            </li>
                            <li>
                                <a href="loanacc_list.php">Daftar Akun Pinjaman</a>
                            </li>
                            <li>
                                <a href="loan_new.php">Berikan Pinjaman</a>
                            </li>

                            <li>
                                <a href="loan_payment.php">Pembayaran Angsuran</a>
                            </li>
                            <li>
                                <a href="loan_history.php?id=">Riwayat Akun Pinjaman</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="bank_balance.php">
                            <i class="material-icons">account_balance</i>
                            <span>Saldo Bank</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_profile.php">
                            <i class="material-icons">person</i>
                            <span>Profil Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="change_pin.php">
                            <i class="material-icons">lock</i>
                            <span>Ganti Sandi</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
    </section>
    <section class="content" id="top">
        <div class="container-fluid">
            <div class="block-header">
                <div class="col-sm-8">
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">Informasi Rekening Pinjaman</p>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="gender" placeholder="Account number"
                        value="<?php echo $row['loan_account']; ?>" readonly>
                </div>
            </div>
            <!-- Widgets -->

            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <!--  -->
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
            </div>
                   <form  id="form" method="post" enctype="multipart/form-data">
                    
                        <center>
                     </center>
                        <hr style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                   <p style="text-align: left; font-weight: bold;">Informasi Pribadi</p>
                   <div class="box-body">
                        <div class="row">
                            <div  class="col-lg-4">
                                <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Name</p>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" required>
                             </div>
                             <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tempat Lahir</p>
                                <input type="text" class="form-control" name="birth_place" value="<?php echo $row['birth_place'];?>" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tanggal Lahir</p>
                                <input type="date" class="form-control" name="dob" value="<?php echo $row['dob'];?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-lg-4">
                                <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">NIK</p>
                                <input type="number" name="nik" class="form-control" value="<?php echo $row['nik'];?>" required>
                             </div>
                             <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Telepon</p>
                                <input type="number" class="form-control" name="contact" value="<?php echo $row['contact'];?>" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Email</p>
                                <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Jenis Kelamin</p>
                                <select class="form-control" name="gender" required>
                                  <?php if($row['gender']=="Laki-laki"){ ?>
                                  <option selected value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                <?php }
                                if($row['gender']=="Perempuan"){ ?>
                                  <option selected value="Perempuan">Perempuan</option>
                                  <option value="Laki-laki">Laki-laki</option>
                                <?php }
                                 ?>
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border-width:0; width: 100%; margin-bottom:-5px;color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Alamat</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kode Pos</p>
                                <input type="number" class="form-control" name="postal" value="<?php echo $row['postal'];?>" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Alamat Tempat Tinggal</p>
                                <input type="text" class="form-control" name="address" value="<?php echo $row['house_address'];?>" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kabupaten/Kota</p>
                                <input type="text" class="form-control" name="city" value="<?php echo $row['city'];?>" required>
                            </div>
                        </div>
                        <hr style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Informasi Rekening</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Nama Rekening</p>
                                <input type="text" class="form-control" name="title" value="<?php echo $row['loanaccount_title'];?>" required>
                            </div>
                            
                        </div>
                        <hr style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <div class="row">
                         <div class="col-sm-12">
                          <center>
                           <button type="submit" style="width: 40%; padding: 10px; border-radius: 10px; font-size: 15px;" class="btn btn-primary" name="insert">Perbarui Data Rekening Pinjaman</button>
                          </center>
                        </div>
                       </div>
                      </div>
                    </form>
            </div>
            </div>
        </div>
        <br>
<div class="row clearfix" id="not">
        <div class="footer-basic" id="bot">
                <footer>
                    <center>
                        <h4 style="margin-top: -15px;">Kontak Kami</h4>
                    </center>
                    <div class="social"><a href="https://www.instagram.com/bprswakalumi/">
                            <i class="icon ion-social-instagram"></i></a>
                    </div>
                    <hr style="height:1px;border-width:0; margin-top: -10px; color:gray; background-color:white">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="../dashboard.php">Home</a></li>
                        <li class="list-inline-item"><a href="about.php?type=Layanan">Layanan</a></li>
                        <li class="list-inline-item"><a href="about.php?type=Tentang Kami">Tentang Kami</a></li>
                        <li class="list-inline-item"><a href="about.php?type=Privasi">Mengenai Privasi</a></li>
                    </ul>
                    <hr style="height:1px;border-width:0; color:gray; background-color:white">
                    <p class="copyright" style="margin-top: 0px;">BPRS WAKALUMI © 2024</p>
                </footer>
            </div>
        </div>
</div>
    </section>
    <script type="text/javascript">
    function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      document.getElementById("imagetitle").innerHTML = "Update Image";
    }
    reader.readAsDataURL(e.files[0]);
  }
}
  </script>
<?php
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
?>
<script type="text/javascript">
  Swal.fire({
  position: 'top-center',
  icon: '<?php echo $_SESSION['code']?>',
  title: '<?php echo $_SESSION['status']?>',
  showConfirmButton: false,
  timer: 4000
});
</script>
<?php
 unset($_SESSION['status']);
}
?>
</body>

</html>

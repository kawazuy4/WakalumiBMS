<?php
session_start();
include '../conn.php';
include 'library.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"] = "Tolong login dengan akun anda";
    $_SESSION["code"] = "warning";
    header("location: ../index.php");
    exit;
}
$id = $_SESSION["id"];
$sql = "SELECT c.* , p.* FROM users c, emp_details p WHERE c.id=p.id and p.id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
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
                                <li><a href="user_profile.php"><i class="material-icons">person</i>Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="change_pin.php"><i class="material-icons">lock</i>Change Password</a></li>
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
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">Informasi Akun Pengguna</p>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="gender" placeholder="Nomor Akun Pengguna"
                        value="<?php echo $row['id']; ?>" readonly>
                </div>
            </div>
            <!-- Widgets -->

            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <!--  -->
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
            </div>
            <form id="form" method="post"> 
                <center>
                </center>
                <hr
                    style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                <br>
                <p style="text-align: left; font-weight: bold;">Data Pribadi</p>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nama Lengkap</p>
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>"
                                readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tempat Lahir</p>
                            <input type="text" class="form-control" name="birth_place" value="<?php echo $row['birth_place']; ?>"
                                readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tanggal Lahir</p>
                            <input type="text" class="form-control" name="dob" value="<?php echo $row['dob']; ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">NIK</p>
                            <input type="number" name="nik" class="form-control" value="<?php echo $row['nik']; ?>"
                                readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Telepon
                            </p>
                            <input type="number" class="form-control" name="contact"
                                value="<?php echo $row['contact']; ?>" readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Email Pengguna
                            </p>
                            <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Jenis Kelamin</p>
                            <input type="text" class="form-control" name="gender" value="<?php echo $row['gender']; ?>"
                                readonly>
                        </div>
                    </div>
                    <hr
                        style="height:1px;border-width:0; width: 100%; margin-bottom:-5px;color:red;background-color:gray;">
                    <br>
                    <p style="text-align: left; font-weight: bold;">Alamat</p>
                    <div class="row">
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kode Pos</p>
                            <input type="number" class="form-control" name="postal" value="<?php echo $row['postal']; ?>"
                                readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Alamat Tempat Tinggal</p>
                            <input type="text" class="form-control" name="address"
                                value="<?php echo $row['house_address']; ?>" readonly>
                        </div>
                        <div class="col-lg-4">
                            <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kota</p>
                            <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>"
                                readonly>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['type'] != "Default") {
                        ?>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Jenjang Pendidikan & Pengalaman</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pendidikan Terakhir
                                </p>
                                <input type="text" class="form-control" name="title" value="<?php echo $row['edu']; ?>"
                                    readonly>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pekerjaan Sekarang</p>
                                <input type="text" class="form-control" name="acc_type" value="<?php echo $row['title']; ?> "
                                    readonly>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pengalaman</p>
                                <input type="text" class="form-control" name="reg" value="<?php echo $row['exp']; ?>"
                                    readonly>
                            </div>
                        </div>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Detail Akun</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Username</p>
                                <input type="text" class="form-control" name="bnc" value="<?php echo $row['username']; ?>"
                                    readonly>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tipe Pengguna</p>
                                <input type="text" class="form-control" value="<?php echo $row['role']; ?>" readonly>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tanggal Didaftarkan
                                </p>
                                <input type="text" class="form-control" value="<?php echo $row['hired_date']; ?>" readonly>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
    </section>

</body>

</html>
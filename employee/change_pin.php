<?php
session_start(); // Start the session
include '../conn.php'; // Include database connection
include 'library.php'; // Include library file

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"] = "Tolong login dengan akun anda";
    $_SESSION["code"] = "warning";
    header("location: ../index.php");
    exit;
}
// Get user ID from session
$id = $_SESSION['id']; 

// Fetch the current password from the database
$query = "SELECT password FROM users WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$expass = $row['password']; // Get current password from database

// Check if form is submitted to change password
if (isset($_POST['chng'])) {
    $oldpass = trim($_POST['oldpass']); // Get old password from form and trim whitespace
    $newpass = trim($_POST['newpass']); // Get new password from form and trim whitespace
    $confirm = trim($_POST['confirm']); // Get confirm password from form and trim whitespace
   

    // Verify old password
    if ($expass === $oldpass) {
        // Check if new password and confirm password match
        if ($newpass === $confirm) {
            $id = $_SESSION['id']; // Get user ID from session
            $query = "UPDATE users SET password='$newpass' WHERE id='$id'"; // Update password query
            $rs1 = mysqli_query($con, $query); // Execute query

            // Check if password update was successful
            if ($rs1) {
                unset($_SESSION['pass']); // Unset old password from session
                date_default_timezone_set('Asia/Jakarta'); // Set timezone
                $tms1 = date("Y-m-d h:i:s"); // Get current timestamp
                
                $_SESSION['pass'] = $newpass; // Update session password
                $_SESSION["title"] = "Berhasil";
                $_SESSION["status"] = "Sandi Telah Diganti";
                $_SESSION["code"] = "success";
                header("location: change_pin.php"); // Redirect to change pin page
                exit;
            } else {
                // Password update failed
                $_SESSION["title"] = "Error";
                $_SESSION["status"] = "Sandi Gagal Diganti";
                $_SESSION["code"] = "error";
                header("location: change_pin.php");
                exit;
            }
        } else {
            // New password and confirm password do not match
            $_SESSION["title"] = "Error";
            $_SESSION["status"] = "Konfirmasi Sandi Salah";
            $_SESSION["code"] = "error";
            header("location: change_pin.php");
            exit;
        }
    } else {
        // Old password does not match current password
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Sandi Lama Tidak Sesuai";
        $_SESSION["code"] = "error";
        header("location: change_pin.php");
        exit;
    }
}
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
                        <?php echo $_SESSION['name']; ?>
                    </div>
                    <div class="email"><?php echo $_SESSION['email']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">more_vert</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="user_profile.php"><i class="material-icons">person</i>Profil</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="change_pin.php"><i class="material-icons">lock</i>Ganti Kata Sandi</a></li>
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
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">Ganti Kata Sandi</p>
                </div>
            </div>
            <div class="row clearfix">
            </div>
            <hr
                style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
            <br>
            <br><br>
            <div class="box-body">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Kata Sandi Lama</p>
                            <input type="password" class="form-control" name="oldpass" placeholder="Input kata sandi yang lama"
                                id="snd1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Kata Sandi Baru</p>
                            <input type="password" class="form-control" name="newpass" placeholder="Input kata sandi yang baru"
                                id="snd2" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Konfirmasi Kata Sandi Baru
                            </p>
                            <input type="password" class="form-control" name="confirm"
                                placeholder="Input untuk konfirmasi kata sandi yang baru" id="snd3" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <center>
                            <div class="col-sm-offset-3 col-sm-6">
                                <input type="submit" class="btn btn-primary form-control"
                                    style=" font-size: 17px; width: 170px; border-radius: 5px;" name="chng" id="sbtn1"
                                    value="Ganti Kata Sandi">
                            </div>
                        </center>
                    </div>
                </form>
            </div>
        </div>
        <br><br><br><br>
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
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        ?>
        <script type="text/javascript">
            Swal.fire({
                position: 'top-center',
                icon: '<?php echo $_SESSION['code'] ?>',
                title: '<?php echo $_SESSION['status'] ?>',
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
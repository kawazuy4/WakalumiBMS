<?php
session_start();
include '../conn.php';
include 'library.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"] = "Please login your account here";
    $_SESSION["code"] = "warning";
    header("location: ../index.php");
    exit;
}
if (isset($_POST['transfer'])) {
    $name = $_POST['name'];
    $acc = $_POST['sender2'];
    $email = $_POST['email'];
    $title = $_POST['sender1'];
    $blnc = $_POST['blnc'];
    $name1 = $_POST['name1'];
    $acc1 = $_POST['receiver2'];
    $email1 = $_POST['email1'];
    $title1 = $_POST['receiver1'];
    $blnc1 = $_POST['blnc1'];
    $newbnc = $_POST['amount'];
    if ($newbnc > $blnc) {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Saldo Tidak Cukup";
        $_SESSION["code"] = "error";
    } else {
        $bnc1 = $blnc - $newbnc;
        $bnc2 = $blnc1 + $newbnc;
        $query = "UPDATE accounts_info set balance='$bnc1' where account='$acc'";
        $query1 = "UPDATE accounts_info set balance='$bnc2' where account='$acc1'";
        $rs1 = mysqli_query($con, $query);
        $rs2 = mysqli_query($con, $query1);
        if ($rs1 && $rs2) {
            date_default_timezone_set('Asia/Jakarta');
            $regisdate = date("Y-m-d");
            $tms = date("h:i:s");
            $tms1 = date("Y-m-d h:i:s");
            mysqli_query($con, "INSERT INTO account_history(account,sender,s_name,receiver,r_name,dt,tm,type,amount) VALUES('$acc','$acc','$name','$acc1','$name1','$regisdate','$tms','Transaksi','$newbnc')");
            mysqli_query($con, "INSERT INTO account_history(account,sender,s_name,receiver,r_name,dt,tm,type,amount) VALUES('$acc1','$acc','$name','$acc1','$name1','$regisdate','$tms','Diterima','$newbnc')");

            $_SESSION["title"] = "Done";
            $_SESSION["status"] = "Transaksi Berhasil Dilakukan";
            $_SESSION["code"] = "success";
            header("location: transfer.php");
            exit;

        } else {
            $_SESSION["title"] = "Error";
            $_SESSION["status"] = "Dana Tidak Dapat Ditransaksikan  ";
            $_SESSION["code"] = "error";
            header("location: transfer.php");
            exit;

        }
    }


}
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body class="theme-blue">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
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
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">HALAMAN TRANSAKSI</p>
                </div>
            </div>
            <div class="row clearfix">
            </div>
            <hr
                style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
            <br>
            <p style="text-align: left; font-weight: bold;">Pencarian Rekening</p>
            <div class="box-body">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-5">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Rekening Pengirim
                            </p>
                            <input type="text" class="form-control" name="sender"
                                placeholder="Input Nomor Rekening Pengirim" id="snd" required>
                        </div>
                        <div class="col-sm-5">
                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Rekening Penerima
                            </p>
                            <input type="text" class="form-control" name="receiver"
                                placeholder="Input Nomor Rekening Penerima" id="rcn" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary form-control"
                                style="margin-top: 28px; font-size: 17px; width: 120px; border-radius: 5px;"
                                name="filter" id="sbtn" value="Cari">
                        </div>
                    </div>
                </form>
                <hr
                    style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
                <br>
                <?php
                if (isset($_POST['filter'])) {
                    $sender = $_POST['sender'];
                    $receiver = $_POST['receiver'];
                    $sql = "SELECT c.* , p.* FROM accounts_info c,accountsholder p WHERE c.account=p.account and p.account='$sender'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nm = (mysqli_query($con, $sql));
                    if (mysqli_num_rows($nm) > 0) {
                        if ($sender == $receiver) {
                            $_SESSION["title"] = "Error";
                            $_SESSION["status"] = "Pilih Rekening yang Berbeda";
                            $_SESSION["code"] = "error";
                        } else {
                            $sqi = "SELECT c1.* , p1.* FROM accounts_info c1,accountsholder p1 WHERE c1.account=p1.account and p1.account='$receiver'";
                            $result1 = mysqli_query($con, $sqi);
                            $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                            $x1 = (mysqli_query($con, $sqi));
                            if (mysqli_num_rows($x1) > 0) {
                                ?>
                                <p style="text-align: left; font-weight: bold;">Informasi Rekening</p>
                                <form id="form2" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Rekening Pengirim</p>
                                            <input type="text" class="form-control" name="sender1"
                                                value="<?php echo $row['account_title']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="blnc" value="<?php echo $row['balance']; ?>"
                                                readonly>
                                            <input type="hidden" class="form-control" name="email" value="<?php echo $row['email']; ?>"
                                                readonly>
                                            <input type="hidden" class="form-control" name="name" value="<?php echo $row['name']; ?>"
                                                readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Rekening Pengirim</p>
                                            <input type="text" class="form-control" name="sender2"
                                                value="<?php echo $row['account']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Rekening Penerima</p>
                                            <input type="text" class="form-control" name="receiver1"
                                                value="<?php echo $row1['account_title']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="blnc1"
                                                value="<?php echo $row1['balance']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="email1"
                                                value="<?php echo $row1['email']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="name1" value="<?php echo $row1['name']; ?>"
                                                readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Rekening Penerima</p>
                                            <input type="text" class="form-control" name="receiver2"
                                                value="<?php echo $row1['account']; ?>" readonly>
                                        </div>
                                    </div>
                                    <hr
                                        style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
                                    <br>
                                    <p style="text-align: left; font-weight: bold;">Transaksi di sini</p>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Jumlah Dana Transaksi
                                            </p>
                                            <input type="number" class="form-control" name="amount" id="am" min="50000"
                                                placeholder="Masukan Jumlah yang Ingin Ditransaksi" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="btn btn-primary form-control"
                                                style="margin-top: 28px; font-size: 17px; width: 120px; border-radius: 5px;"
                                                name="transfer" id="trans" value="Transfer"
                                                onclick="var vl = document.getElementById('am').value; var e=this;var s=document.getElementById('sbtn');setTimeout(function(){if(vl>=2000){e.disabled=true;s.disabled=true;}},0); return true;">
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } else {
                                //receiver...
                                $_SESSION["title"] = "Error";
                                $_SESSION["status"] = "Rekening Penerima Tidak Ditemukan";
                                $_SESSION["code"] = "error";
                            }
                        }
                    } else {
                        //sender
                        $_SESSION["title"] = "Error";
                        $_SESSION["status"] = "Rekening Pengirim Tidak Ditemukan";
                        $_SESSION["code"] = "error";
                    }
                }
                ?>
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
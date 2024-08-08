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

if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $acc = $_POST['loanacc'];
    $loan = $_POST['loan'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $layaway = $_POST['layawayInput'];
    $layaway_count = $_POST['layaway_count'];
    $newlayaway_count = (int)$layaway_count;

    // If newlayaway_count is 0 after deduction, update loan status to 'Lunas'

    $query = "UPDATE loanaccounts_info SET layaway_count='$newlayaway_count', layaway='$layaway', periode='$newlayaway_count', loan_amount='$loan', loan_status='Belum Lunas' WHERE loan_account='$acc'";
    $rs1 = mysqli_query($con, $query);

    if ($rs1) {
        date_default_timezone_set('Asia/Jakarta');
        $regisdate = date("Y-m-d");
        $tms = date("h:i:s");
        $tms1 = date("Y-m-d h:i:s");
        mysqli_query($con, "INSERT INTO loanaccount_history(loan_account, name, dt, tm, type) VALUES('$acc','$name', '$regisdate','$tms','Pinjam')");

        $_SESSION["title"] = "Done";
        $_SESSION["status"] = "Pinjaman telah diberikan";
        $_SESSION["code"] = "success";
        header("location: deposit.php");
        exit;

    } else {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Amount not deposit";
        $_SESSION["code"] = "error";
        header("location: deposit.php");
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
                    <a class="navbar-brand" href="dashboard.php" style="font-size: 18px;">BPRS WAKALUMI</a>
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
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">HALAMAN PEMINJAMAN</p>
                </div>
            </div>
            <div class="row clearfix">
            </div>
            <hr
                style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
            <br>
            <p style="text-align: left; font-weight: bold;">Cari Rekening Pinjaman</p>
            <div class="box-body">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="loanacc" placeholder="Input Nomor Rekening"
                                id="lnc" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-primary form-control"
                                style=" font-size: 17px; width: 120px; border-radius: 5px;" name="filter" id="sbtn"
                                value="Cari">
                        </div>
                    </div>
                </form>
                <hr
                    style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
                <br>
                <?php
                if (isset($_POST['filter'])) {
                    $loanacc = $_POST['loanacc'];
                    $sql = "SELECT c.* , p.* FROM loanaccounts_info c, loan_accountsholder p WHERE c.loan_account = p.loan_account and p.loan_account='$loanacc'";
                    $loan_status_query = "SELECT loan_status FROM loanaccounts_info  WHERE loan_account = '$loanacc'";
                    $result = mysqli_query($con, $sql);
                    
                    if (!$result) {
                        // Handle SQL error if needed
                        $_SESSION["title"] = "Error";
                        $_SESSION["status"] = "Database error occurred";
                        $_SESSION["code"] = "error";
                    } else {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $nm = (mysqli_query($con, $sql));
                        
                        $loan_status_result = mysqli_query($con, $loan_status_query);
                        if (!$loan_status_result) {
                            // Handle SQL error if needed
                            $_SESSION["title"] = "Error";
                            $_SESSION["status"] = "Database error occurred";
                            $_SESSION["code"] = "error";
                        } else {
                            $loan_status_row = mysqli_fetch_array($loan_status_result, MYSQLI_ASSOC);
                            $loan_status = isset($loan_status_row['loan_status']) ? $loan_status_row['loan_status'] : null;
                
                            if ($loan_status == "Belum Lunas") {
                                $_SESSION["title"] = "Error";
                                $_SESSION["status"] = "Akun ini belum melunasi pinjamannya";
                                $_SESSION["code"] = "error";
                        } else if (mysqli_num_rows($nm) > 0) {
                        ?>
                        <p style="text-align: left; font-weight: bold;">Detail Pinjaman</p>
                        <form id="form2" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="row">    
                            <div class="col-sm-4">
                                    <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nama Akun Pinjaman</p>
                                    <input type="text" class="form-control" name="title" value="<?php echo $row['loanaccount_title']; ?>" readonly>
                                </div>
                            
                                <div class="col-sm-4">
                                    <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nama Pemegang Akun</p>
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" readonly>
                                    <input type="hidden" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                                </div>
                                <div class="col-sm-4">
                                    <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Rekening Pinjaman</p>
                                    <input type="text" class="form-control" name="loanacc" value="<?php echo $row['loan_account']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p style="margin-bottom: 1px; margin-top: 8px;">Plafon</p>
                                <input type="number" class="form-control" id="ln" name="loan" min="500000" max="20000000"
                                    placeholder="Pinjaman minimal Rp 500.000,00- dan maksimal Rp Rp 20.000.000,00-" required
                                    oninput="calculateLayaway()">
                            </div>
                            <div class="col-lg-4">
                                <p style="margin-bottom: 1px; margin-top: 8px;">Tipe Rekening</p>
                                <select class="form-control" name="type" required>
                                    <option selected disabled hidden value="">Pilih Tipe Akun</option>
                                    <option value="Pinjaman">Pinjaman</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <p style="margin-bottom: 1px; margin-top: 8px;">Tenor</p>
                                <select class="form-control" name="layaway_count" id="layaway_count" required onchange="calculateLayaway()">
                                    <option selected disabled hidden value="">Pilih Periode Angsuran</option>
                                    <option value="6">6</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="24">24</option>
                                    <option value="30">30</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <p style="margin-bottom: 1px; margin-top: 8px;">Angsuran per Bulan</p>
                                <input type="text" class="form-control" id="layaway" name="layaway" readonly placeholder="Rp 0/Bulan">
                                <input type="hidden" id="layawayInput" name="layawayInput" value="">
                            </div>
                            
                        </div>
                        
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit"
                                        style="width: 40%; padding: 10px; border-radius: 10px; font-size: 15px;"
                                        class="btn btn-primary" name="insert">Berikan Pinjaman</button>
                                </center>
                            </div>
                        </div>
                        </form>

                        <?php
                        } else {
                        //sender
                        $_SESSION["title"] = "Error";
                        $_SESSION["status"] = "Akun Tidak Ditemukan";
                        $_SESSION["code"] = "error";
                        }
                    }
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <script>
    function calculateLayaway() {
        var loan = parseFloat(document.getElementById("ln").value);
        var tenor = parseInt(document.getElementById("layaway_count").value);
        var layaway = 0;

        if (loan && tenor) {
            switch (tenor) {
                case 6:
                    layaway = Math.floor((loan + loan * 0.05) / tenor);
                    break;
                case 12:
                    layaway = Math.floor((loan + loan * 0.07) / tenor);
                    break;
                case 18:
                    layaway = Math.floor((loan + loan * 0.09) / tenor);
                    break;
                case 24:
                    layaway = Math.floor((loan + loan * 0.12) / tenor);
                    break;
                case 30:
                    layaway = Math.floor((loan + loan * 0.14) / tenor);
                    break;
                case 36:
                    layaway = Math.floor((loan + loan * 0.16) / tenor);
                    break;
                default:
                    layaway = 0;
                    break;
            }
        }

        document.getElementById("layawayInput").value = layaway;
        document.getElementById("layaway").value = "Rp " + layaway.toLocaleString('id-ID') + ",00-/Bulan";
    }
    </script>
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
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
$sql_qery = "SELECT loanacc_count from counting";
$rslt = mysqli_query($con, $sql_qery);
$rzst = mysqli_fetch_array($rslt, MYSQLI_ASSOC);
$acc_num = $rzst["loanacc_count"];
$acc_num = $acc_num + 1;
$acc_full = "LOAN" . $acc_num;
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
    $loan = $_POST['loan'];
    $npwp = $_POST['npwp'];
    $tenor = $_POST['tenor'];
    $layaway = $_POST['layawayInput'];
    date_default_timezone_set('Asia/Jakarta');
    $regisdate = date("Y-m-d");
    $sqli_qery = "SELECT nik, email from loan_accountsholder where nik='$nik' or email='$email'";
    $dupli = mysqli_query($con, $sqli_qery);
    $duplicate = mysqli_fetch_array($dupli, MYSQLI_ASSOC);

    $dup_nik = isset($duplicate["nik"]) ? $duplicate["nik"] : "default_nik_value";
    $dup_email = isset($duplicate["email"]) ? $duplicate["email"] : "default_email_value";


    if ($dup_nik == $nik) {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Akun terduplikasi";
        $_SESSION["code"] = "error";
        header("location: new_loanaccount.php");
        exit;
    } else if ($dup_email == $email) {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Email terduplikasi";
        $_SESSION["code"] = "error";
        header("location: new_loanaccount.php");
        exit;
    } else {
        $sql = "INSERT INTO loan_accountsholder(loan_account, name, birth_place, nik, contact, dob, gender, email, postal, city, house_address, npwp) VALUES ('$acc_full','$name','$birth_place','$nik','$contact','$dob','$gender','$email','$postal','$city','$address','$npwp')";
        $current_id = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (isset($current_id)) {
            mysqli_query($con, "UPDATE counting set loanacc_count='$acc_num'");
            $sqli = "INSERT INTO loanaccounts_info(loan_account,loanaccount_title, loanaccount_type, loan_amount, periode, layaway, loan_status, layaway_count, register_date) VALUES ('$acc_full','$title','$type', '$loan', '$tenor', '$layaway', 'Belum Lunas', '$tenor', '$regisdate')" or die(mysqli_error($con));
            mysqli_query($con, $sqli);
            date_default_timezone_set('Asia/Jakarta');
            $regisdate = date("Y-m-d");
            $tms = date("h:i:s");
            $tms1 = date("Y-m-d h:i:s");
            mysqli_query($con, "INSERT INTO loanaccount_history(loan_account,name, dt, tm, type) VALUES('$acc_full','$name', '$regisdate','$tms','Pinjaman')");
            $connected = @fsockopen("www.google.com", 80);
            if ($connected) {
                $msg = "Halo Saudara " . $name . "! Kamu membuka akun pinjaman BPRS WAKALUMI pada tanggal" . $tms1 . ". Sebesar " . $loan . ",00- dengan sukses. Angsuran yang perlu dibayar adalah Rp " . $layaway . ",00- /Bulan-nya. Terima kasih telah menggunakan jasa BPR Syariah Wakalumi";
            }
            $_SESSION["title"] = "Done";
            $_SESSION["status"] = "Rekening berhasil terdaftar!";
            $_SESSION["code"] = "success";
            header("location: new_loanaccount.php");
            exit;
        } else {
            $_SESSION["title"] = "Error";
            $_SESSION["status"] = "Rekening gagal terdaftar!";
            $_SESSION["code"] = "error";
            header("location: new_loanaccount.php");
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
    <!-- Page Loader -->
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
                        <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">FORMULIR PENDAFTARAN REKENING PINJAMAN BARU</p>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="gender" value="<?php echo $acc_full ?>" readonly>
                    </div>
                </div>
                <!-- Widgets -->

                <!-- #END# Widgets -->
                <!-- CPU Usage -->
                <!--  -->
                <!-- #END# CPU Usage -->
                <div class="row clearfix">
                </div>
                <form id="form" method="post" enctype="multipart/form-data">
                    <hr
                        style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
                    <br>
                    <p style="text-align: left; font-weight: bold;">Data Pribadi</p>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">Nama Lengkap</p>
                                <input type="text" class="form-control" name="name" placeholder="Input Nama Lengkap"
                                    required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tempat Lahir
                                </p>
                                <input type="text" class="form-control" name="birth_place" placeholder="Input Tempat Lahir"
                                    required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tanggal Lahir
                                </p>
                                <input type="date" class="form-control" name="dob" placeholder="Input Tanggal Lahir"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">NIK</p>
                                <input type="text" name="nik" class="form-control" placeholder="Input NIK" required oninput="validateNIK(this)">
                                <small id="nikHelp" class="form-text text-muted">Input 16 digit NIK</small>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Nomor Telepon</p>
                                <input type="number" class="form-control" name="contact"
                                    placeholder="Input Nomor Telepon" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Alamat Email</p>
                                <input type="email" class="form-control" name="email" placeholder="Input Alamat Email"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Jenis Kelamin</p>
                                <select class="form-control" name="gender" required>
                                    <option selected disabled hidden value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Status Perkawinan</p>
                                <select class="form-control" name="marry" required>
                                    <option selected disabled hidden value="">Pilih Status Pernikahan</option>
                                    <option value="Married">Menikah</option>
                                    <option value="Unmarried">Belum Menikah</option>
                                    <option value="Unmarried">Cerai</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputEmail1" style="margin-bottom: 1px; margin-top: 8px;">NPWP</p>
                                <input type="text" name="npwp" class="form-control" placeholder="Input NPWP (15 digits)" required
                                    pattern="\d{15}" title="NPWP must be exactly 15 digits">
                                <small id="npwpHelp" class="form-text text-muted">Input NPWP 15 digit</small>
                            </div>
                        </div>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px;color:red;background-color:gray;">
                        <br>

                        <p style="text-align: left; font-weight: bold;">Alamat</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kode Pos
                                </p>
                                <input type="number" class="form-control" name="postal" placeholder="Input Kode Pos"
                                    required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Alamat Tempat Tinggal
                                </p>
                                <input type="text" class="form-control" name="address" placeholder="Input Alamat"
                                    required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Kota/Kabupaten</p>
                                <input type="text" class="form-control" name="city" placeholder="Input Kota/Kabupaten"
                                    required>
                            </div>
                        </div>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Detail Akun Pinjaman</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p style="margin-bottom: 1px; margin-top: 8px;">Nama Akun</p>
                                <input type="text" class="form-control" name="title" placeholder="Input Nama Akun" required>
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
                                <select class="form-control" name="tenor" id="tenor" required onchange="calculateLayaway()">
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
                                        class="btn btn-primary" name="insert">Daftarkan Akun Pinjaman</button>
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
        </section>
        <script type="text/javascript">
            function calculateLayaway() {
            var loan = parseFloat(document.getElementById("ln").value);
            var tenor = parseInt(document.getElementById("tenor").value);
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
        <script>
        function validateNIK(input) {
            // Remove any non-numeric characters from the input
            var cleaned = input.value.replace(/\D/g, '');

            // Check if the cleaned input has exactly 16 digits
            if (cleaned.length !== 16) {
                input.setCustomValidity('Input 16 digit NIK');
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            } else {
                input.setCustomValidity('');
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        }
        function validateNPWP(input) {
        // Remove any non-numeric characters from the input
        var cleaned = input.value.replace(/\D/g, '');

        // Ensure the cleaned input has exactly 15 digits
        if (cleaned.length !== 15) {
        input.setCustomValidity('NPWP harus 15 digit');
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        } else {
        input.setCustomValidity('');
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        }
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
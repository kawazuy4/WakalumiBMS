<?php
// Start the session
session_start();

// Include database connection and library files
include '../conn.php';
include 'library.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"] = "Tolong login dengan akun anda";
    $_SESSION["code"] = "warning";
    header("location: ../index.php");
    exit;
}

// Function to generate OTP (One Time Password)
function OTP($n)
{
    $result = "senin";
    return $result;
}

// Retrieve the current employee ID from the database
$sql_qery = "SELECT emp_id from counting";
$rslt = mysqli_query($con, $sql_qery);
$rzst = mysqli_fetch_array($rslt, MYSQLI_ASSOC);
$acc_num = $rzst["emp_id"];
$acc_num = $acc_num + 1;

// Generate a password for the new user
$pass = OTP(8);

// Check if the 'insert' form is submitted
if (isset($_POST['insert'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $birth_place = $_POST['birth_place'];
    $nik = $_POST['nik'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $marry = $_POST['marry'];
    $email = $_POST['email'];
    $postal = $_POST['postal'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $title = $_POST['title'];
    $experience = $_POST['experience'];
    $edu = $_POST['edu'];
    $username = $_POST['username'];
    $type = $_POST['user_type'];

    // Determine account prefix based on user type
    if ($type == "Admin") {
        $acc_full = "ADN" . $acc_num;
    } else if ($type == "Employee") {
        $acc_full = "EMP" . $acc_num;
    }

    // Get the current date and time
    date_default_timezone_set('Asia/Jakarta');
    $regisdate = date("Y-m-d");

    // Reconnect to the database if the connection is lost or inactive
    if (!$con || mysqli_ping($con) === false) {
        include '../conn.php'; // Re-establish the database connection
    }

    // Check for duplicate entries in the database
    $sqli_qery = "SELECT e.nik,e.email,u.username from emp_details e, users u WHERE u.username='$username' OR e.nik='$nik' OR e.email='$email'";
    $dupli = mysqli_query($con, $sqli_qery);
    $duplicate = mysqli_fetch_array($dupli, MYSQLI_ASSOC);

    $dup_nik = isset($duplicate["nik"]) ? $duplicate["nik"] : "default_nik_value";
    $dup_email = isset($duplicate["email"]) ? $duplicate["email"] : "default_email_value";
    $dup_user = isset($duplicate["username"]) ? $duplicate["username"] : "default_username_value";

    if ($dup_nik == $nik) {
        $_SESSION["title"] = "Kesalahan";
        $_SESSION["status"] = "Akun sudah ada";
        $_SESSION["code"] = "error";
        header("location: new_emp.php");
        exit;
    } else if ($dup_email == $email) {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Duplicate email entry";
        $_SESSION["code"] = "error";
        header("location: new_emp.php");
        exit;
    } else if ($dup_user == $username) {
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Duplicate username entry";
        $_SESSION["code"] = "error";
        header("location: new_emp.php");
        exit;
    } else {
        // Insert employee details into emp_details table
        $sql = "INSERT INTO emp_details(id, name, birth_place, nik, contact, dob, gender, marital, email, postal, city, house_address, edu, title, exp, hired_date) VALUES ('$acc_full','$name','$birth_place','$nik','$contact','$dob','$gender','$marry','$email','$postal','$city','$address','$edu','$title','$experience','$regisdate')";
        $current_id = mysqli_query($con, $sql);
        if (!$current_id) {
            // Query execution failed
            die("<b>Error:</b> Problem on Insert data<br/>" . mysqli_error($con));
        }

        if (isset($current_id)) {
            // Update employee ID in counting table
            mysqli_query($con, "UPDATE counting set emp_id='$acc_num'");
            // Insert user details into users table
            $sqli = "INSERT INTO users(id,username,password,role,status) VALUES ('$acc_full','$username','$pass','$type','Active')";
            mysqli_query($con, $sqli) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($con));
            
            // Set session variables and redirect
            $_SESSION["title"] = "Done";
            $_SESSION["status"] = "Akun Berhasil Terdaftar";
            $_SESSION["code"] = "success";
            header("location: new_emp.php");
            exit;
        } else {
            // Redirect with error message if insertion fails
            $_SESSION["title"] = "Error";
            $_SESSION["status"] = "Akun Gagal Terdaftar";
            $_SESSION["code"] = "error";
            header("location: new_emp.php");
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
                            <span>Profil Rekening</span>
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
                        <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">FORMULIR PENDAFTARAN KARYAWAN BARU</p>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="gender"
                            value="<?php if ($_SESSION['type'] == "Default") {
                                echo "ADN" . $acc_num . "  |  EMP" . $acc_num;
                            } else {
                                echo "EMP" . $acc_num;
                            } ?>"
                            readonly>
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
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Cerai">Cerai</option>
                                </select>
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
                        <p style="text-align: left; font-weight: bold;">Jenjang Pendidikan & Pengalaman</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pendidikan Terakhir</p>
                                <input type="text" class="form-control" name="edu" placeholder="Jenjang Pendidikan"
                                    required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pekerjaan sekarang</p>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Pekerjaan Sekarang" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Pengalaman Kerja
                                </p>
                                <select class="form-control" name="experience" required>
                                    <option selected disabled hidden value="">Pilih Pengalaman Kerja</option>
                                    <option value="Lulusan Baru">Lulusan Baru</option>
                                    <option value="Kurang dari Setahun">Kurang dari Setahun</option>
                                    <option value="1 Tahun">1 Tahun</option>
                                    <option value="2 Tahun">2 Tahun</option>
                                    <option value="3 Tahun">3 Tahun</option>
                                    <option value="4 Tahun">4 Tahun</option>
                                    <option value="5 Tahun">5 Tahun</option>
                                    <option value="Di Atas 5 Tahun">Di Atas 5 Tahun</option>
                                </select>
                            </div>
                        </div>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <p style="text-align: left; font-weight: bold;">Detail Akun</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Username</p>
                                <input type="email" class="form-control" name="username"
                                    placeholder="Masukan email untuk log in" required>
                            </div>
                            <div class="col-lg-4">
                                <p for="exampleInputPassword1" style="margin-bottom: 1px; margin-top: 8px;">Tipe Pengguna
                                </p>
                                <select class="form-control" name="user_type" required>
                                    <option selected disabled hidden value="">Pilih Tipe Pengguna</option>
                                    <option value="Employee">Karyawan</option>
                                    <?php if ($_SESSION['type'] == "Default") {
                                        ?>
                                        <option value="Admin">Asisten Admin</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <hr
                            style="height:1px;border-width:0; width: 100%; margin-bottom:-5px; color:red;background-color:gray;">
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit"
                                        style="width: 40%; padding: 10px; border-radius: 10px; font-size: 15px;"
                                        class="btn btn-primary" name="insert">Daftarkan</button>
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
                        <li class="list-inline-item"><a href="about.php?type=Services">Layanan</a></li>
                        <li class="list-inline-item"><a href="about.php?type=About">Tentang Kami</a></li>
                        <li class="list-inline-item"><a href="about.php?type=Privacy">Mengenai Privasi</a></li>
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
        input.setCustomValidity('NPWP must be exactly 15 digits.');
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
            unset($_SESSION['status']);
        }
        ?>
    </body>

</html>
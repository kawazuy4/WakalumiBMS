<?php
session_start();
include '../conn.php';
include 'library.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"]="Tolong login dengan akun anda";
    $_SESSION["code"]="warning";
    header("location: ../index.php");
    exit;
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
                    <p style="margin-left: -15px; font-size: 17px; font-weight: bold;"><?php echo $_GET["ty"]." Riwayat Saldo"?></p>
                </div>
                <div class="col-sm-4">
                    <?php
                    $type2 = $_GET["ty"];
                    $sl = mysqli_query($con, "SELECT SUM(amount) as total FROM account_history where type='$type2'");
                    $r = mysqli_fetch_array($sl);
                        $number = "Rp " . number_format($r['total'], 0, ',', '.') . ",00-";
                    if (isset($number)) {
                        # code...
                    } else {
                        $number = "Rp " . number_format($r['total'], 0, ',', '.') . ",00-";
                    }
                    ?>
                    <input type="text" name="pt" value="<?php echo $number ?>" readonly class="form-control">
                </div>
            </div>
            <br>
            <div class="row clearfix">
                <hr
                    style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px;  color:red;background-color:gray;">
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" id="myInput" class="cs form-control" onkeyup="myFunction()"
                            placeholder="Cari berdasarkan nama dan nomor rekening" title="Type in a name">
                    </div>
                    <form method="post" id="form_id">
                        <div class="col-sm-3">
                            <input type="date" name="date_start" class="form-control" placeholder="Enter start date" required>
                            <input type="hidden" name="sd" class="form-control" value="<?php echo $sender ?>">
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="date_end" class="form-control" placeholder="Enter end date" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary"
                                style="font-size: 17px; width: 120px; height: 32px; border-radius: 5px;" name="dt" value="Cari">
                        </div>
                    </form>
                </div>
                <br>
            </div>
            <div class="row clearfix">
                <div class="table-responsive" style="overflow:auto; min-height: 300px;" id="customers">
                    <table class="table" id="myTable">
                        <thead>
                            <tr style="text-align: center;" class="tb">
                                <th style="text-align: center; width: 15%;">Nama</th>
                                <th style="text-align: center; width: 13%;">Nomor Rekening</th>
                                <?php
                                if ($_GET["ty"] == "Transection") {
                                    ?>
                                    <th style="text-align: center; width: 17%;">Rekening Penerima</th>
                                    <th style="text-align: center; width: 17%;">Nama Penerima</th>
                                    <?php
                                }
                                ?>
                                <th style="text-align: center; width: 13%;">Tanggal</th>
                                <th style="text-align: center; width: 12%;">Tipe Riwayat</th>
                                <th style="text-align: center;width: 13%;">Jumlah Dana</th>
                            </tr>
                        </thead>
                        <tbody id="body">
                            <?php
                            $type1 = $_GET["ty"];
                            if (isset($_POST['dt'])) {
                                $st = $_POST['date_start'];
                                $et = $_POST['date_end'];
                                $sql = "SELECT c.* , p.* FROM accountsholder c,account_history p WHERE c.account=p.account and p.type='$type1' and p.dt between '$st' and '$et' ORDER BY no DESC";
                            } else {
                                $sql = "SELECT c.* , p.* FROM accountsholder c,account_history p WHERE c.account=p.account and p.type='$type1' ORDER BY no DESC";
                            }
                            $result = mysqli_query($con,$sql);
                            $num = (mysqli_query($con,$sql));
                            if (mysqli_num_rows($num)>0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['name'];?></td>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['account'];?></td>
                          <?php
                          if ($row['type']=="Transection" && $_GET["ty"]=="Transection") {
                          ?>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['reciever'];?></td>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['r_name'];?></td>
                          <?php
                          }
                          ?>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['dt']." ".$row['tm'];?></td>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['type'];?></td>
                          <td style="text-align: center;padding-top: 25px;">
                                <?php echo "Rp " . number_format($row['amount'], 0, ',', '.') . ",00-"; ?>
                            </td>
                      <?php
                         }
                         }else{
                        ?> 
                                    <td style="text-align: center;padding-top: 25px; font-size: 20px;" colspan="7">Tidak Ditemukan</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue, cn;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                cn = tr[i].getElementsByTagName("td")[1];
                if (td || cn) {
                    txtValue = td.textContent || td.innerText;
                    var txtValue1 = cn.textContent || cn.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>
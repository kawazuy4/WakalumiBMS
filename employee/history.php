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
          <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">RIWAYAT</p>
        </div>
      </div>
      <hr
        style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
      <br>
      <?php
      if ($_GET['id'] == "") {
        ?>
        <p style="text-align: left; font-weight: bold;">Cari Riwayat</p>
        <form id="form" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-8">
              <input type="text" class="form-control" name="sender" placeholder="Cari Riwayat Berdasarkan Nomor Rekening"
                id="snd" required>
            </div>
            <div class="col-sm-2">
              <input type="submit" class="btn btn-primary form-control"
                style=" font-size: 17px; width: 120px; border-radius: 5px;" name="filter" id="sbtn" value="Cari">
            </div>
          </div>
        </form>
        <hr
          style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 20px; color:red;background-color:gray;">
        <br>
        <?php
      }
      $dd = $_GET['id'];
      if (isset($_POST['filter']) || isset($_POST['dt']) || $dd != "") {
        if (isset($_POST['filter'])) {
          $sender = $_POST['sender'];
        } else if (isset($_POST['dt'])) {
          $sender = $_POST['sd'];
          $st = $_POST['date_start'];
          $et = $_POST['date_end'];
        } else if (isset($dd)) {
          $sender = $dd;
        }
        $sql1 = "SELECT * FROM accountsholder  WHERE account='$sender'";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $nm1 = (mysqli_query($con, $sql1));
        if (mysqli_num_rows($nm1) > 0) {
          ?>
          <div class="row">
            <div class="col-sm-4">
            <select class="form-control" onchange="myfun()" id="tp">
                <option selected disabled hidden value="">Pilih Tipe Riwayat</option>
                <option value="TRANSAKSI">Transaksi</option>
                <option value="DITERIMA">Dana diterima</option>
                <option value="DEPOSIT">Deposit</option>
                <option value="DITARIK">Dana ditarik</option>
                <option value="ALL">All</option>
            </select>   
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="col-sm-3">
                <input type="date" name="date_start" class="form-control" placeholder="Enter starting date" required>
                <input type="hidden" name="sd" value="<?php echo $row1['account']; ?>">
              </div>
              <div class="col-sm-3">
                <input type="date" name="date_end" class="form-control" placeholder="Enter ending date" required>
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary"
                  style="font-size: 17px; width: 120px; height: 32px; border-radius: 5px;" name="dt" value="Filter">
              </div>
            </form>
          </div>
          <br>
          <div class="box-body">
            <?php
            if (isset($_POST['filter'])) {
              $sql = "SELECT c.* , p.* FROM accountsholder c,account_history p WHERE c.account=p.account and p.account='$sender' ORDER BY p.no DESC";
            } else if (isset($_POST['dt'])) {
              $sql = "SELECT c.* , p.* FROM accountsholder c,account_history p WHERE c.account=p.account and p.account='$sender' and p.dt between '$st' and '$et' ORDER BY p.no DESC";
            } else if (isset($dd)) {
              $sql = "SELECT c.* , p.* FROM accountsholder c,account_history p WHERE c.account=p.account and p.account='$sender' ORDER BY p.no DESC";
            }
            $result = mysqli_query($con, $sql);
            $nm = (mysqli_query($con, $sql));
            ?>
            <div class="table-responsive" style="overflow:auto; min-height: 300px;" id="customers">
              <table class="table" id="myTable">
                <thead>
                  <tr style="text-align: center;" class="tb">
                    <th style="text-align: center; width: 15%;">Nama</th>
                    <th style="text-align: center; width: 12%;">Nomor Rekening</th>
                    <th style="text-align: center; width: 19%;">Pengirim/Penerima</th>
                    <th style="text-align: center; width: 17%;">Pengirim/Penerima</th>
                    <th style="text-align: center; width: 13%;">Tanggal</th>
                    <th style="text-align: center; width: 11%;">Tipe Riwayat</th>
                    <th style="text-align: center;width: 13%;">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="body">
                  <?php
                  if (mysqli_num_rows($nm) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                      ?>
                      <tr>
                        <td style="text-align: center;padding-top: 25px;"><?php echo $row['name']; ?></td>
                        <td style="text-align: center;padding-top: 25px;"><?php echo $row['account']; ?></td>
                        <?php
                        if ($row['type'] == "Transaksi") {
                          ?>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['receiver']; ?></td>
                          <td style="text-align: center;padding-top: 25px;"><?php echo $row['r_name']; ?></td>
                          <?php
                        } else if ($row['type'] == "Diterima") {
                          ?>
                            <td style="text-align: center;padding-top: 25px;"><?php echo $row['sender']; ?></td>
                            <td style="text-align: center;padding-top: 25px;"><?php echo $row['s_name']; ?></td>
                          <?php
                        } else {
                          ?>
                            <td style="text-align: center;padding-top: 25px;" colspan="1">- - -</td>
                            <td style="text-align: center;padding-top: 25px;" colspan="1">- - -</td>
                          <?php
                        }
                        ?>
                        <td style="text-align: center;padding-top: 25px;"><?php echo $row['dt'] . " " . $row['tm']; ?></td>
                        <td style="text-align: center;padding-top: 25px;"><?php echo $row['type']; ?></td>
                        <td style="text-align: center; padding-top: 25px;">
                            <?php echo 'Rp ' . number_format($row['amount'], 0, ',', '.') . ',00-'; ?>
                        </td>

                      </tr>
                      <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td style="text-align: center;padding-top: 25px; font-size: 20px;" colspan="7">Tidak Ditemukan
                      </td>
                    </tr>
                    <?php
                  } ?>
                  <tr class='no-records' style="display: none; text-align: center;padding-top: 25px; font-size: 20px;">
                    <td colspan='7'>Tidak Ditemukan</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <?php
        } else {
          //sender
          $_SESSION["title"] = "Error";
          $_SESSION["status"] = "Rekening Tidak Ditemukan";
          $_SESSION["code"] = "error";
        }
      }
      ?>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    function myfun() {
    var input, filter, table, tr, td, i, txtValue, txtValue1;
    input = document.getElementById("tp");
    filter = input.value.toUpperCase(); // Convert filter value to uppercase
    
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[5];
        var td1 = tr[i].getElementsByTagName("td")[4];
        
        if (td && td1) {
            txtValue = td.textContent || td.innerText;
            txtValue1 = td1.textContent || td1.innerText;
            
            if (filter === "TRANSAKSI" || filter === "DITERIMA" || filter === "DEPOSIT" || filter === "DITARIK") {
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            } else if (filter === "ALL") {
                // Show all rows when "ALL" is selected
                tr[i].style.display = "";
            } else {
                // Hide rows that don't match the filter
                tr[i].style.display = "none";
            }
        }
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
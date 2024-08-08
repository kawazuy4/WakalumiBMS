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
            <?php echo $_SESSION['name']; ?>
          </div>
          <div class="email"><?php echo $_SESSION['email']; ?></div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">more_vert</i>
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
        <p style="margin-left: -15px; font-size: 17px; font-weight: bold;">DAFTAR KARYAWAN</p>
      </div>
      <div class="row clearfix">
        <hr
          style="height:1px;border-width:0; width: 100%; margin-bottom:  -5px; margin-top: 5px; color:red;background-color:gray;">
        <br>
        <div class="row">
          <div class="col-sm-4">
            <input type="text" id="myInput" class="cs form-control" onkeyup="myFunction()"
              placeholder="Cari berdasarkan ID, Nama, atau NIK" title="Type in a name">
          </div>
          <?php
          if ($_SESSION['type'] == "Default") {
            ?>
            <div class="col-sm-2">
              <select class="form-control" onchange="myfun()" id="tp">
                <option selected disabled hidden value="">Select type</option>
                <option value="Admin">Admins</option>
                <option value="Employee">Employees</option>
                <option value="All">All</option>
              </select>
            </div>
            <?php
          }
          ?>
          <form method="post" id="form_id">
            <div class="col-sm-2">
              <input type="date" name="date_start" class="form-control" placeholder="Start date" required>
            </div>
            <div class="col-sm-2">
              <input type="date" name="date_end" class="form-control" placeholder="End date" required>
            </div>
            <div class="col-sm-2">
              <input type="submit" class="btn btn-primary"
                style="font-size: 17px; width: 120px; height: 32px; border-radius: 5px;" name="filter" value="Cari">
            </div>
          </form>
        </div>
      </div>
      <!-- Widgets -->

      <!-- #END# Widgets -->
      <!-- CPU Usage -->
      <!--  -->
      <!-- #END# CPU Usage -->
      <div class="row clearfix">
        <div class="table-responsive" style="overflow:auto; min-height: 300px; max-height: 1000px;" id="customers">
          <table class="table" id="myTable">
            <thead>
              <tr style="text-align: center;" class="tb">
                <th style="text-align: center; width: 14%;">ID Karyawan</th>
                <th style="text-align: center; width: 18%;">Nama</th>
                <th style="text-align: center; width: 14%;">NIK</th>
                <th style="text-align: center; width: 14%;">No. Telepon</th>
                <th style="text-align: center; width: 11%;">Tipe</th>
                <th style="text-align: center; width: 7%;">Status</th>
                <th style="text-align: center;width: 15%;">Aksi</th>
              </tr>
            </thead>
            <tbody id="body">
              <?php
              include '../conn.php'; // Include database connection
              
              // Check if the user is logged in; if not, redirect to the login page
              if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                $_SESSION["status"] = "Tolong login dengan akun anda";
                $_SESSION["code"] = "warning";
                header("location: ../index.php");
                exit;
              }

              $tp = "Block"; // Set the default type to "Block"
              
              // Check if the 'filter' form is submitted
              if (isset($_POST['filter'])) {
                $startdt = $_POST['date_start']; // Get the start date from the form
                $enddt = $_POST['date_end']; // Get the end date from the form
              
                // Prepare SQL query based on user type
                if ($_SESSION['type'] == "Default") {
                  $sql = "SELECT u.*, e.* FROM users u, emp_details e WHERE u.id = e.id AND e.hire_date BETWEEN '$startdt' AND '$enddt' ORDER BY e.hired_date DESC";
                } else {
                  $sql = "SELECT u.*, e.* FROM users u, emp_details e WHERE u.id = e.id AND u.role = 'Employee' AND e.hired_date BETWEEN '$startdt' AND '$enddt' ORDER BY e.hired_date DESC";
                }

                $result = mysqli_query($con, $sql); // Execute the query
                $num = mysqli_query($con, $sql); // Execute the query again for row count check
              
                // Check if any rows are returned
                if (mysqli_num_rows($num) > 0) {
                  // Loop through each row
                  while ($row = mysqli_fetch_array($result)) {
                    // Exclude the current user's record from the display
                    if ($_SESSION['id'] != $row['id']) {
                      ?>
                      <tr style="height: 50px;">
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['id']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['name']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['nik']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['contact']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['role']; ?></td>
                        <td style="text-align: center; padding-top: 15px;">
                          <div class="action_btn">
                            <a href="emp_profile.php?id=<?php echo $row['id']; ?>" class="click_ripple_shine success"
                              title="View">
                              <i class="icon fa fa-eye"></i>
                            </a>
                            <?php if ($row['status'] == "Active") { ?>
                              <a href="emp_block.php?id=<?php echo $row['id']; ?>&type=Block" class="dng1" title="Block Account">
                                <i class="icon fa fa-ban"></i>
                              </a>
                            <?php } ?>
                            <?php if ($row['status'] == "Block") { ?>
                              <a href="emp_block.php?id=<?php echo $row['id']; ?>&type=Active" class="success dng"
                                title="Activate Account">
                                <i class="icon fa fa-check"></i>
                              </a>
                            <?php } ?>
                            <a href="emp_update.php?id=<?php echo $row['id']; ?>" class="click_ripple_shine warning"
                              title="Edit">
                              <i class="icon fa fa-pencil-square-o"></i>
                            </a>
                            <a href="emp_delete.php?id=<?php echo $row['id']; ?>" class="danger" title="Delete">
                              <i class="icon fa fa-close"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                } else {
                  // If no records found, display a message
                  ?>
                  <tr>
                    <td style="text-align: center; padding-top: 25px; font-size: 20px;" colspan="7">Kosong</td>
                  </tr>
                  <?php
                }
              } else {
                // If the 'filter' form is not submitted, display all records based on user type
                if ($_SESSION['type'] == "Default") {
                  $sql = "SELECT u.*, e.* FROM users u, emp_details e WHERE u.id = e.id ORDER BY e.hired_date DESC";
                } else {
                  $sql = "SELECT u.*, e.* FROM users u, emp_details e WHERE u.id = e.id AND u.role = 'Employee' ORDER BY e.hired_date DESC";
                }

                $result = mysqli_query($con, $sql); // Execute the query
                $num = mysqli_query($con, $sql); // Execute the query again for row count check
              
                // Check if any rows are returned
                if (mysqli_num_rows($num) > 0) {
                  // Loop through each row
                  while ($row = mysqli_fetch_array($result)) {
                    // Exclude the current user's record from the display
                    if ($_SESSION['id'] != $row['id']) {
                      ?>
                      <tr style="height: 50px;">
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['id']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['name']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['nik']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['contact']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['role']; ?></td>
                        <td style="text-align: center; padding-top: 25px;"><?php echo $row['status']; ?></td>
                        <td style="text-align: center; padding-top: 15px;">
                          <div class="action_btn">
                            <a href="emp_profile.php?id=<?php echo $row['id']; ?>" class="click_ripple_shine success"
                              title="View">
                              <i class="icon fa fa-eye"></i>
                            </a>
                            <?php if ($row['status'] == "Active") { ?>
                              <a href="emp_block.php?id=<?php echo $row['id']; ?>&type=Block" class="dng1" title="Block Account">
                                <i class="icon fa fa-ban"></i>
                              </a>
                            <?php } ?>
                            <?php if ($row['status'] == "Block") { ?>
                              <a href="emp_block.php?id=<?php echo $row['id']; ?>&type=Active" class="success dng"
                                title="Activate Account">
                                <i class="icon fa fa-check"></i>
                              </a>
                            <?php } ?>
                            <a href="emp_update.php?id=<?php echo $row['id']; ?>" class="click_ripple_shine warning"
                              title="Edit">
                              <i class="icon fa fa-pencil-square-o"></i>
                            </a>
                            <a href="emp_delete.php?id=<?php echo $row['id']; ?>" class="danger" title="Delete">
                              <i class="icon fa fa-close"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                } else {
                  // If no records found, display a message
                  ?>
                  <tr>
                    <td style="text-align: center; padding-top: 25px; font-size: 20px;" colspan="7">No record found</td>
                  </tr>
                  <?php
                }
              }
              ?>
              <tr class='no-records' style="display: none; text-align: center;padding-top: 25px; font-size: 20px;">
                <td colspan='7'>No record found</td>
              </tr>
            </tbody>
          </table>
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
          <hr style="height:1px;border-width:0; color:white; background-color:white">
          <p class="copyright" style="margin-top: 0px;">BPRS WAKALUMI © 2024</p>
        </footer>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    $('.dng').on('click', function (e) {
      e.preventDefault();
      const href = $(this).attr('href');
      Swal.fire({
        title: 'Aktivasi Akun?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Aktivasi!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;

        }
      })
    })
    $('.dng1').on('click', function (e) {
      e.preventDefault();
      const href = $(this).attr('href');
      Swal.fire({
        title: 'Blokir Akun?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Blokir!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;

        }
      })
    })
    $('.danger').on('click', function (e) {
      e.preventDefault();
      const href = $(this).attr('href');
      Swal.fire({
        title: 'Hapus Akun?',
        text: "Akun yang Telah Dihapus Tidak Dapat Dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;

        }
      })
    })
  </script>
  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue, cn, acc, tle;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        cn = tr[i].getElementsByTagName("td")[1];
        acc = tr[i].getElementsByTagName("td")[3];
        tle = tr[i].getElementsByTagName("td")[2];
        if (td || cn || acc || tle) {
          txtValue = td.textContent || td.innerText;
          var txtValue1 = cn.textContent || cn.innerText;
          var txtValue2 = acc.textContent || acc.innerText;
          var txtValue3 = tle.textContent || acc.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } else {
          var trSel = $("#myTable tr:not('.no-records, .tb'):visible");
          if (trSel.length == 0) {

            $("#myTable").find('.no-records').show();
          }
          else {
            $("#myTable").find('.no-records').hide();
          }
        }
      }
    }
    function myfun() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("tp");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[5];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (filter == "ADMIN" || filter == "EMPLOYEE") {
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          } else if (filter == "ALL") {
            if (txtValue.toUpperCase().indexOf("ADMIN") > -1 || txtValue.toUpperCase().indexOf("EMPLOYEE") > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        } else {
          var trSel = $("#myTable tr:not('.no-records, .tb'):visible");
          if (trSel.length == 0) {

            $("#myTable").find('.no-records').show();
          }
          else {
            $("#myTable").find('.no-records').hide();
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
        timer: 3000
      });
    </script>
    <?php
    unset($_SESSION['status']);
  }
  ?>

</body>

</html>
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
        <?php if ($_GET['type'] == "Layanan") {
            ?>
            <div class="container-fluid">
                <div class="block-header">
                    <h2 style="font-size: 20px; color: black; font-weight: bold;"><?php echo $_GET['type']; ?></h2>
                </div>
                <p style="font-size: 17px;">Sifat dan variasi dari transaksi, tentu saja, tergantung pada aktivitas dan luasnya bisnis. Dalam latar belakang ini, korespondensi terkait perbankan menjadi penting.</p>
                <br>
                <p style="font-size: 17px;">
                    Secara umum, beberapa layanan umum yang disediakan oleh bank meliputi:
                </p>
                <ul>
                    <li style="font-size: 17px; font-weight: bold;">Fasilitas deposit</li>
                    <li style="font-size: 17px; font-weight: bold;">Fasilitas penarikan</li>
                    <li style="font-size: 17px; font-weight: bold;">Fasilitas transfer</li>
                    <li style="font-size: 17px; font-weight: bold;">Fasilitas pinjaman</li>
                </ul>
                <h4>Fasilitas deposit</h4>
                <p style="font-size: 17px;">Rekening giro dan tabungan akan melibatkan pembukaan rekening dan memungkinkan untuk menyetor jumlah ke dalam rekeningnya.</p>
                <h4>Fasilitas penarikan</h4>
                <p style="font-size: 17px;">Rekening giro dan tabungan akan melibatkan pembukaan rekening dan memungkinkan untuk menarik jumlah dari rekeningnya.</p>
                <h4>Fasilitas transfer</h4>
                <p style="font-size: 17px;">Rekening giro dan tabungan akan melibatkan pembukaan rekening dan memungkinkan untuk mentransfer jumlah dari rekeningnya ke rekening bank yang sama.</p>
                <h4>Fasilitas riwayat</h4>
                <p style="font-size: 17px;">Rekening giro dan tabungan akan melibatkan pembukaan rekening dan memungkinkan untuk mendapatkan riwayat rekeningnya dari waktu pembukaan hingga penutupan dengan tanggal dan waktu. Pemegang rekening akan melihat semua jumlah yang disetorkan, ditarik, ditransfer, atau diterima berdasarkan tanggal dan waktu.</p>
            </div>
        <?php }
        if ($_GET['type'] == "Privasi") {
            ?>
            <div class="container-fluid">
                <div class="block-header">
                    <h2 style="font-size: 20px; color: black; font-weight: bold;"><?php echo $_GET['type']; ?></h2>
                </div>
                <p style="font-size: 17px;">Kekhawatiran tentang privasi data sangat penting bagi perusahaan di sektor keuangan dan kesehatan. Bank dan lembaga keuangan lainnya mengelola sejumlah besar informasi sensitif tentang pelanggan mereka, dan kebocoran data semacam itu dapat memiliki konsekuensi yang mengerikan. Seiring dengan semakin bergantungnya kita pada cloud untuk menyimpan informasi dan melakukan transaksi keuangan secara online, kekhawatiran tentang privasi data terus meningkat.</p>
                <p style="font-size: 17px;">Seorang konsumen tidak dapat memilih untuk tidak membagikan semua informasi. Pertama, aturan privasi tidak mengatur pembagian informasi di antara pihak-pihak yang berafiliasi. Kedua, aturan ini berisi pengecualian yang memungkinkan transfer informasi pribadi nonpublik ke pihak yang tidak berafiliasi untuk memproses dan melayani transaksi konsumen, serta untuk memfasilitasi transaksi bisnis normal lainnya. Misalnya, konsumen tidak dapat memilih untuk tidak berbagi ketika informasi pribadi nonpublik dibagikan dengan pihak ketiga yang tidak berafiliasi untuk:</p>
                <ul>
                    <li style="font-size: 16px;">Memasarkan produk atau layanan keuangan milik bank</li>
                    <li style="font-size: 16px;">Memasarkan produk atau layanan keuangan yang ditawarkan oleh bank dan lembaga keuangan lainnya (pemasaran bersama)</li>
                    <li style="font-size: 16px;">Memproses dan melayani transaksi yang diminta atau diizinkan oleh konsumen</li>
                    <li style="font-size: 16px;">Melindungi terhadap potensi penipuan atau transaksi yang tidak sah</li>
                    <li style="font-size: 16px;">Mematuhi persyaratan hukum federal, negara bagian, atau lokal</li>
                </ul>
                <p style="font-size: 17px;">Aturan privasi melarang bank untuk mengungkapkan nomor akun atau kode akses untuk kartu kredit, deposito, atau akun transaksi kepada pihak ketiga yang tidak berafiliasi untuk digunakan dalam pemasaran. Aturan ini mengandung dua pengecualian sempit terhadap larangan umum ini. Bank dapat membagikan nomor akun sehubungan dengan pemasaran produknya sendiri selama penyedia layanan tidak diizinkan untuk langsung memulai biaya ke akun tersebut. Bank juga dapat mengungkapkan nomor akun kepada peserta dalam program kartu kredit label pribadi atau afinitas ketika peserta diidentifikasi kepada pelanggan. Nomor akun tidak termasuk nomor atau kode dalam bentuk terenkripsi selama bank juga tidak menyediakan cara untuk mendekode nomor tersebut.</p>
                <p style="font-size: 17px;">Ketentuan di bawah hukum negara bagian yang memberikan perlindungan konsumen yang lebih besar daripada yang disediakan di bawah ketentuan privasi GLBA akan menggantikan aturan privasi Federal. Bank akan diwajibkan untuk mematuhi ketentuan hukum negara bagian tersebut sejauh ketentuan tersebut memberikan perlindungan konsumen yang lebih besar daripada aturan privasi Federal. Komisi Perdagangan Federal menentukan apakah hukum negara bagian tertentu memberikan perlindungan yang lebih besar.</p>
            </div>
        <?php }
        if ($_GET['type'] == "Tentang Kami") {
            ?>
            <div class="container-fluid">
                <div class="block-header">
                    <h2 style="font-size: 20px; color: black; font-weight: bold;"><?php echo $_GET['type']; ?></h2>
                </div>
                <p style="font-size: 17px;">BPR Syariah Wakalumi adalah Bank Pembiayaan Rakyat Syariah 
                    yang telah lebih dari 30 tahun memberikan pelayanan jasa keuangan bagi berbagai lapisan masyarakat. 
                    Dengan konsep penghimpunan dan pembiayaan yang terencana dan terarah, BPR Syariah Wakalumi 
                    selama ini Alhamdulillah mampu mengembangkan dan mensejahterakan taraf ekonomi bagi para nasabahnya.</p>
                <br><br>
                <p style="font-size: 17px;">BPRS Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank). 
                    Tahun 1995 BPRS Wakalumi di konversi dari BPR konvensional menjadi BPR Syariah yang beroperasi berlandaskan Syariah Islam.</p>
                <br>
                <ul style="font-size: 16px;">

                    <li>Tabungan Syariah</li>
                    <li>Deposito Syariah</li>
                    <li>Pembiayaan Syariah</li>
                    <li>Transaksi Keuangan</li>
                    <li>Investasi Keuangan</li>
                </ul>
                <br><br><br>
            </div>
            <?php
        }
        ?>
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
<?php
include 'database.php';
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location = "login.php"</script>';
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoOnline</title>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">TokoOnline</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Kategori</a></li>
                <li><a href="data-produk.php">Produk</a></li>
                <li><a href="keluar.php">Logout</a></li>

            </ul>
        </div>
    </header>

    <!-- content -->

    <div class="section">
        <div class="container">
            <h3>Tambah Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>

                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = ucwords($_POST['nama']);
                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                        
                                                        null,
                                                        '" . $nama . "') ");
                    if ($insert) {
                        echo '<script>alert("Tambah Kategori Berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>

            </div>



        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - TokoOnline</small>
        </div>
    </footer>

</body>

</html>
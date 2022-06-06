<?php
session_start();
include 'database.php';
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
            <h3>Kategori</h3>
            <div class="box">
                <p><a href="tambah-kategori.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No.</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($row = mysqli_fetch_array($kategori)) {



                        ?>

                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['categroy_name'] ?></td>
                                <td>
                                    <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin menghapus')">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>\

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - TokoOnline</small>
        </div>
    </footer>

</body>

</html>
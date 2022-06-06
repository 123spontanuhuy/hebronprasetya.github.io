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
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" id="" class="input-control" required>
                        <option value="">--Pilih---</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {



                        ?>
                            <option value="<?php echo $r['category_id'] ?>"><?php echo $r['categroy_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi" id="" cols="30" rows="10"></textarea><br>
                    <select name="status" class="input-control" id="">
                        <option value="">--Pilih--</option>
                        <option value="1">--Aktif--</option>
                        <option value="0">--Tidak Aktif--</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // print_r($_FILES['gambar']);

                    $kategori  = $_POST['kategori'];
                    $nama      = $_POST['nama'];
                    $harga     = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status    = $_POST['status'];


                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'produk' . time() . '.' . $type2;
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    if (!in_array($type2, $tipe_diizinkan)) {
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                    } else {
                        move_uploaded_file($tmp_name, './produk/' . $newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                                        null,
                                                        '" . $kategori . "',
                                                        '" . $nama . "',
                                                        '" . $harga . "',
                                                        '" . $deskripsi . "',
                                                        '" . $newname . "',
                                                        '" . $status . "',
                                                        null

                                                        )");


                        if ($insert) {
                            echo '<script>alert("Tambah Produk Berhasil")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
                        }
                    }
                }
                ?>

            </div>



        </div>
    </div>

    <!-- footer -->
    <footer>

        <script>
            CKEDITOR.replace('deskripsi');
        </script>
        <div class="container">
            <small>Copyright &copy; 2022 - TokoOnline</small>
        </div>
    </footer>

</body>

</html>
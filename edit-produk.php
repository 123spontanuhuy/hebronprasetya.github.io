<?php
include 'database.php';
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location = "login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);




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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" id="" class="input-control" required>
                        <option value="">--Pilih---</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {



                        ?>
                            <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : ''; ?>><?php echo $r['categroy_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name  ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price  ?>" required>
                    <img src="produk/<?php echo $p->product_image  ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
                    <select name="status" class="input-control" id="">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>--Aktif--</option>
                        <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>--Tidak Aktif--</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $kategori  = $_POST['kategori'];
                    $nama      = $_POST['nama'];
                    $harga     = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status    = $_POST['status'];
                    $foto      = $_POST['foto'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];








                    if ($filename != ' ') {

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk' . time() . '.' . $type2;
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');


                        if (!in_array($type2, $tipe_diizinkan)) {
                            echo '<script>alert("Format file tidak diizinkan")</script>';
                        } else {
                            unlink('./produk/' . $foto);
                            move_uploaded_file($tmp_name, './produk/' . $newname);
                            $namagambar = $newname;
                        }
                    } else {
                        $namagambar = $foto;
                    }
                    $update = mysqli_query($conn, "UPDATE tb_product SET 
                                            category_id= '" . $kategori . "',
                                            product_name= '" . $nama . "',
                                            product_price= '" . $harga . "',
                                            product_description= '" . $deskripsi . "',
                                            product_image = '" . $namagambar . "',
                                            product_status= '" . $status . "'
                                            WHERE product_id = '" . $p->product_id . "' ");

                    if ($update) {
                        echo '<script>alert("Ubah Produk Berhasil")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
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

        <script>
            CKEDITOR.replace('deskripsi');
        </script>
        <div class="container">
            <small>Copyright &copy; 2022 - TokoOnline</small>
        </div>
    </footer>

</body>

</html>
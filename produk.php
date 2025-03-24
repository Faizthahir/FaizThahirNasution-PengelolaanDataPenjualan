<?php
// File: produk.php
$produk_file = 'produk.txt';

// Fungsi menampilkan daftar produk
function tampilkan_produk() {
    global $produk_file;
    if (file_exists($produk_file)) {
        $produk = file($produk_file, FILE_IGNORE_NEW_LINES);
        echo "<table>";
        echo "<tr><th>Nama Produk</th></tr>";
        foreach ($produk as $p) {
            echo "<tr><td>$p</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada produk.</p>";
    }
}

// Fungsi menambah produk
if (isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    file_put_contents($produk_file, $nama_produk . "\n", FILE_APPEND);
    header("Location: produk.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Manajemen Produk</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="pelanggan.php">Manajemen Pelanggan</a>
        <a href="transaksi.php">Transaksi Penjualan</a>
        <a href="laporan.php">Laporan</a>
    </nav>

    <h3>Tambah Produk</h3>
    <form method="post">
        <input type="text" name="nama_produk" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <?php tampilkan_produk(); ?>

</form>
</div>

</body>
</html>

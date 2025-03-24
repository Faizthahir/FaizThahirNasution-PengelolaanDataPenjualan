<?php
$pelanggan_file = 'pelanggan.txt';

function tampilkan_pelanggan() {
    global $pelanggan_file;
    if (file_exists($pelanggan_file)) {
        $pelanggan = file($pelanggan_file, FILE_IGNORE_NEW_LINES);
        echo "<table>";
        echo "<tr><th>No</th><th>Nama Pelanggan</th></tr>";
        $no = 1;
        foreach ($pelanggan as $p) {
            echo "<tr><td>$no</td><td>$p</td></tr>";
            $no++;
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada pelanggan.</p>";
    }
}

if (isset($_POST['tambah_pelanggan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    file_put_contents($pelanggan_file, $nama_pelanggan . "\n", FILE_APPEND);
    header("Location: pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Manajemen Pelanggan</h2>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="produk.php">Manajemen Produk</a>
        <a href="transaksi.php">Transaksi Penjualan</a>
        <a href="laporan.php">Laporan</a>
    </nav>

    <h3>Tambah Pelanggan</h3>
    <form method="post">
        <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
        <button type="submit" name="tambah_pelanggan">Tambah</button>
    </form>

    <?php tampilkan_pelanggan(); ?>
</div>

</body>
</html>

<?php
function tampilkan_transaksi() {
    $transaksi_file = 'transaksi.txt';
    if (file_exists($transaksi_file)) {
        $transaksi = file($transaksi_file, FILE_IGNORE_NEW_LINES);
        
        echo "<table border='1' width='100%'>";
        echo "<tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
              </tr>";
        $no = 1;
        
        foreach ($transaksi as $t) {
            $data = explode('|', $t);

            // Pastikan data memiliki setidaknya 5 elemen sebelum ditampilkan
            if (count($data) < 5) {
                continue;
            }

            $tanggal = $data[0];
            $nama_pelanggan = $data[1];
            $nama_produk = $data[2];
            $jumlah = $data[3];
            $harga = $data[4];
            $total_harga = $jumlah * $harga;

            echo "<tr>
                    <td>$no</td>
                    <td>$tanggal</td>
                    <td>$nama_pelanggan</td>
                    <td>$nama_produk</td>
                    <td>$jumlah</td>
                    <td>Rp " . number_format($harga, 0, ',', '.') . "</td>
                    <td>Rp " . number_format($total_harga, 0, ',', '.') . "</td>
                  </tr>";
            $no++;
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada transaksi.</p>";
    }
}
if (isset($_POST['tambah_transaksi'])) {
    $tanggal = $_POST['tanggal']; // Tanggal dari input form
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $nama_produk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga']; // Ambil harga dari input form

    // Pastikan semua data terisi
    if (!empty($tanggal) && !empty($nama_pelanggan) && !empty($nama_produk) && !empty($jumlah) && !empty($harga)) {
        // Format data yang benar
        $data_transaksi = "$tanggal|$nama_pelanggan|$nama_produk|$jumlah|$harga\n";
        file_put_contents('transaksi.txt', $data_transaksi, FILE_APPEND);
        header("Location: transaksi.php");
        exit;
    } else {
        echo "<p style='color:red;'>Semua kolom harus diisi!</p>";
    }
}


?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Transaksi Penjualan</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="produk.php">Manajemen Produk</a>
        <a href="pelanggan.php">Manajemen Pelanggan</a>
        <a href="laporan.php">Laporan</a>
    </nav>

    <h3>Tambah Transaksi</h3>
    <form action="transaksi.php" method="POST">
    <input type="date" name="tanggal" required placeholder="dd/mm/yyyy">
    <input type="text" name="nama_pelanggan" required placeholder="Nama Pelanggan">
    <input type="text" name="nama_produk" required placeholder="Nama Produk">
    <input type="number" name="jumlah" required placeholder="Jumlah">
    <input type="number" name="harga" required placeholder="Harga">
    <button type="submit" name="tambah_transaksi">Tambah</button>
    </form>


    <?php tampilkan_transaksi(); ?>
</div>

</body>
</html>

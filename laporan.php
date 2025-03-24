<?php
function tampilkan_laporan($filter = null) {
    global $transaksi_file;
    if (file_exists("transaksi.txt")) {
        $transaksi = file("transaksi.txt", FILE_IGNORE_NEW_LINES);
        echo "<table>";
        echo "<tr><th>No</th><th>Tanggal</th><th>Nama Pelanggan</th><th>Nama Produk</th><th>Jumlah</th></tr>";
        $no = 1;
        foreach ($transaksi as $t) {
            $data = explode('|', $t);

            // Pastikan data memiliki setidaknya 4 elemen sebelum ditampilkan
            if (count($data) < 4) {
                continue;
            }

            $tanggal = $data[0];
            $nama_pelanggan = $data[1];
            $nama_produk = $data[2];
            $jumlah = $data[3];

            if ($filter) {
                if (strpos($tanggal, $filter) !== 0) {
                    continue;
                }
            }

            echo "<tr>
                    <td>$no</td>
                    <td>$tanggal</td>
                    <td>$nama_pelanggan</td>
                    <td>$nama_produk</td>
                    <td>$jumlah</td>
                  </tr>";
            $no++;
        }
        echo "</table>";
    } else {
        echo "<p>Belum ada transaksi.</p>";
    }
}


$filter_tanggal = isset($_POST['filter_tanggal']) ? $_POST['filter_tanggal'] : '';
$filter_bulan = isset($_POST['filter_bulan']) ? $_POST['filter_bulan'] : '';
$filter_tahun = isset($_POST['filter_tahun']) ? $_POST['filter_tahun'] : '';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Laporan Penjualan</h2>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="produk.php">Manajemen Produk</a>
        <a href="pelanggan.php">Manajemen Pelanggan</a>
        <a href="transaksi.php">Transaksi Penjualan</a>
    </nav>

    <h3>Filter Laporan</h3>
    <form method="post">
        <label>Filter Harian:</label>
        <input type="date" name="filter_tanggal" value="<?= $filter_tanggal ?>">
        <button type="submit">Filter</button>
    </form>

    <form method="post">
        <label>Filter Bulanan:</label>
        <input type="month" name="filter_bulan" value="<?= $filter_bulan ?>">
        <button type="submit">Filter</button>
    </form>

    <form method="post">
        <label>Filter Tahunan:</label>
        <input type="number" name="filter_tahun" value="<?= $filter_tahun ?>" min="2000" max="<?= date('Y') ?>">
        <button type="submit">Filter</button>
    </form>

    <h3>Data Transaksi</h3>

    <?php
    if ($filter_tanggal) {
        tampilkan_laporan($filter_tanggal);
    } elseif ($filter_bulan) {
        tampilkan_laporan($filter_bulan);
    } elseif ($filter_tahun) {
        tampilkan_laporan($filter_tahun);
    } else {
        tampilkan_laporan();
    }
    ?>

</div>

</body>
</html>

<?php
// index.php
// Halaman utama untuk menampilkan daftar tabel dan link ke fitur CRUD

require_once 'koneksi_mysql.php';

$conn = koneksiDatabase();

// Ambil daftar tabel dari database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

echo "<!DOCTYPE html>";
echo "<html lang='id'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Daftar Tabel Database</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; }";
echo "table { border-collapse: collapse; width: 50%; }";
echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
echo "th { background-color: #f2f2f2; }";
echo "a { text-decoration: none; color: #007bff; }";
echo "a:hover { text-decoration: underline; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>Daftar Tabel Database</h1>";

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nama Tabel</th><th>Aksi</th></tr>";
    while ($row = $result->fetch_array()) {
        $table = $row[0];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($table) . "</td>";
        echo "<td>";
        echo "<a href='tampil_data.php?table=" . urlencode($table) . "'>Lihat Data</a> | ";
        echo "<a href='edit_data.php?table=" . urlencode($table) . "'>Tambah Data</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Tidak ada tabel ditemukan di database.</p>";
}

echo "</body>";
echo "</html>";

$conn->close();
?>

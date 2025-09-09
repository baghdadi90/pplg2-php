<?php
/**
 * Proses Tambah Data
 * File untuk memproses penambahan data ke database MySQL
 */

require_once 'koneksi_mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['table'])) {
        $table_name = $_POST['table'];

        // Buat koneksi
        $conn = koneksiDatabase();

        // Bangun query insert dinamis
        $fields = [];
        $placeholders = [];
        $types = "";
        $values = [];

        foreach ($_POST as $field => $value) {
            if ($field !== 'table') {
                $fields[] = $field;
                $placeholders[] = "?";
                $types .= "s"; // Asumsi semua string untuk keamanan
                $values[] = $value;
            }
        }

        $fields_str = implode(", ", $fields);
        $placeholders_str = implode(", ", $placeholders);

        $sql = "INSERT INTO $table_name ($fields_str) VALUES ($placeholders_str)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            header("Location: tampil_data.php?table=" . urlencode($table_name));
            exit;
        } else {
            echo "Gagal menambahkan data: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Parameter tabel tidak ditemukan.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>

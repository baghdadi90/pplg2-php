<?php
/**
 * Proses Edit Data
 * File untuk memproses update data ke database MySQL
 */

require_once 'edit_data.php'; // Menggunakan fungsi updateData dari edit_data.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['table'])) {
        $id = $_POST['id'];
        $table_name = $_POST['table'];

        // Ambil data dari POST, kecuali id dan table
        $data = $_POST;
        unset($data['id']);
        unset($data['table']);

        $success = updateData($table_name, $id, $data);

        if ($success) {
            header("Location: tampil_data.php?table=" . urlencode($table_name));
            exit;
        } else {
            echo "Gagal memperbarui data.";
        }
    } else {
        echo "Parameter tidak lengkap.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>

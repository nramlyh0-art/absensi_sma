<?php
include '../includes/db.php';
$user_id = $_SESSION['user_id'];
$tgl = date('Y-m-d');
$jam = date('H:i:s');

// Contoh simpan ke tabel absensi (pastikan tabelnya ada)
$simpan = mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, jam_masuk) VALUES ('$user_id', '$tgl', '$jam')");

if($simpan){
    echo "<script>alert('Absen Berhasil!'); window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal Absen!'); window.location='dashboard.php';</script>";
}
?>
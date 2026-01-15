<?php
include '../includes/db.php';

if(isset($_GET['id']) && isset($_GET['aksi'])){
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if($aksi == 'setuju'){
        $status = 'Disetujui';
    } else {
        $status = 'Ditolak';
    }

    $query = "UPDATE absensi SET status_validasi = '$status' WHERE id = '$id'";
    
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Berhasil divalidasi!'); window.location='laporan_riwayat.php';</script>";
    }
}
?>
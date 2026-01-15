<?php
include '../includes/db.php';
header('Content-Type: application/json');

if(isset($_GET['id_siswa'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['id_siswa']);
    $tanggal = date('Y-m-d');

    // Cek apakah siswa sudah absen hari ini
    $cek = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' AND tanggal='$tanggal'");
    
    if(mysqli_num_rows($cek) > 0){
        echo json_encode(['status' => 'error', 'message' => 'Siswa sudah absen hari ini!']);
    } else {
        // Ambil nama siswa
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_lengkap FROM users WHERE id='$user_id'"));
        
        // Simpan data absen (Status otomatis Disetujui karena discan Admin)
        $insert = mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, keterangan, status_validasi) 
                                      VALUES ('$user_id', '$tanggal', 'Hadir', 'Disetujui')");
        
        if($insert){
            echo json_encode(['status' => 'success', 'nama' => $user['nama_lengkap']]);
        }
    }
}
?>
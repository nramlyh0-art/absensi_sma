<?php
include '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Cek Login
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php"); exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$data = mysqli_fetch_assoc($query);

// Proses Update Profil
if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $foto_lama = $data['foto'];
    $nama_foto_simpan = $foto_lama;

    // Logika Ganti Foto
    if($_FILES['foto_baru']['name'] != ""){
        $ekstensi = pathinfo($_FILES['foto_baru']['name'], PATHINFO_EXTENSION);
        $nama_file_baru = strtolower(str_replace(' ', '_', $nama)) . "_" . time();
        $target_file = "../assets/img/" . $nama_file_baru . "." . $ekstensi;

        if(move_uploaded_file($_FILES['foto_baru']['tmp_name'], $target_file)){
            $nama_foto_simpan = $nama_file_baru; 
        }
    }

    $update = mysqli_query($conn, "UPDATE users SET nama_lengkap='$nama', kelas='$kelas', foto='$nama_foto_simpan' WHERE id='$user_id'");

    if($update){
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='dashboard.php';</script>";
    }
}

// Logika Tampilan Foto (Sama dengan Dashboard kamu)
$path_foto = "../assets/img/" . $data['foto'] . ".jpg";
if (!file_exists($path_foto)) { $path_foto = "../assets/img/" . $data['foto'] . ".png"; }
if (empty($data['foto']) || !file_exists($path_foto)) {
    $path_foto = "https://ui-avatars.com/api/?name=" . urlencode($data['nama_lengkap']) . "&background=2D94FF&color=fff";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #FFDAE9; font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card-edit { background: white; border-radius: 40px; padding: 40px; width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .current-profile { width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 4px solid #2D94FF; margin-bottom: 20px; }
        .form-control { border-radius: 15px; padding: 12px; background: #f8fbff; border: 1px solid #e1e8f0; }
        .btn-save { background: #2D94FF; color: white; border: none; padding: 15px; border-radius: 20px; width: 100%; font-weight: bold; transition: 0.3s; }
        .btn-save:hover { background: #1a73e8; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="card-edit">
    <div class="text-center">
        <h3 class="fw-bold text-primary mb-4">Edit Profil</h3>
        <img src="<?= $path_foto ?>" class="current-profile shadow" id="preview">
    </div>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="small fw-bold text-muted">NAMA LENGKAP</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="small fw-bold text-muted">KELAS</label>
            <input type="text" name="kelas" class="form-control" value="<?= $data['kelas'] ?>" required>
        </div>

        <div class="mb-4">
            <label class="small fw-bold text-muted">GANTI FOTO PROFIL</label>
            <input type="file" name="foto_baru" class="form-control" accept="image/*" onchange="previewImage(event)">
            <small class="text-muted" style="font-size: 0.7rem;">*Biarkan kosong jika tidak ingin mengubah foto</small>
        </div>

        <button type="submit" name="update" class="btn btn-save shadow">
            <i class="fas fa-check-circle me-2"></i> SIMPAN PERUBAHAN
        </button>
        
        <div class="text-center mt-3">
            <a href="dashboard.php" class="text-muted text-decoration-none small">Batal dan Kembali</a>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk melihat foto sebelum diupload
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>
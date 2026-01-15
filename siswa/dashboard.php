<?php 
include '../includes/db.php'; 
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// 1. Proteksi Halaman
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php"); exit;
}

$user_id = $_SESSION['user_id'];
$tanggal_hari_ini = date('Y-m-d');

// 2. Ambil Data User
$query_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$data = mysqli_fetch_assoc($query_user);

// 3. Cek Apakah Siswa Sudah Absen Hari Ini
$query_absen = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id = '$user_id' AND tanggal = '$tanggal_hari_ini'");
$sudah_absen = mysqli_num_rows($query_absen) > 0;
$data_absen = mysqli_fetch_assoc($query_absen);

// 4. Logika Foto Profil
$nama_file_db = $data['foto']; 
$path_foto = "../assets/img/" . $nama_file_db . ".jpg"; 
if (!file_exists($path_foto)) { $path_foto = "../assets/img/" . $nama_file_db . ".png"; }
if (empty($nama_file_db) || !file_exists($path_foto)) {
    $path_foto = "https://ui-avatars.com/api/?name=" . urlencode($data['nama_lengkap']) . "&background=2D94FF&color=fff&size=128";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap');
        body { background: #FFDAE9; font-family: 'Poppins', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .card-siswa { background: white; border-radius: 40px; padding: 40px; width: 400px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .profile-img { width: 130px; height: 130px; border-radius: 50%; border: 5px solid #2D94FF; padding: 5px; margin-bottom: 15px; object-fit: cover; }
        .clock { font-size: 3.5rem; font-weight: 800; color: #333; margin: 5px 0; }
        .status-hadir { background: #d4edda; color: #155724; padding: 15px; border-radius: 20px; border: 2px dashed #c3e6cb; margin-top: 10px; }
        .status-hadir i { font-size: 2rem; display: block; margin-bottom: 5px; }
        .btn-absen { background: #2D94FF; color: white; border-radius: 20px; padding: 15px; width: 100%; font-weight: bold; text-decoration: none; display: block; transition: 0.3s; }
        .btn-qr { background: #f8f9fa; color: #333; border: 1px solid #ddd; border-radius: 15px; padding: 10px; width: 100%; font-weight: 600; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="card-siswa">
    <img src="<?= $path_foto ?>" class="profile-img shadow-sm">
    
    <h2 class="fw-bold text-primary mb-0"><?= htmlspecialchars($data['nama_lengkap']) ?></h2>
    <p class="text-muted mb-3">Kelas: <?= htmlspecialchars($data['kelas']) ?></p>

    <div class="clock" id="clock">00.00.00</div>
    <p class="text-secondary small mb-4 fw-bold"><?= date('l, d F Y') ?></p>

    <?php if ($sudah_absen): ?>
        <div class="status-hadir animate__animated animate__bounceIn">
            <i class="fas fa-camera-retro"></i>
            <span class="fw-bold">Selesai!</span><br>
            <small>Anda sudah tercatat <b><?= $data_absen['keterangan'] ?></b> hari ini.</small>
        </div>
        <a href="../logout.php" class="d-block mt-4 text-danger text-decoration-none fw-bold small">Logout</a>
    <?php else: ?>
        <button type="button" class="btn btn-qr mb-2" data-bs-toggle="modal" data-bs-target="#qrModal">
            <i class="fas fa-qrcode me-2"></i> Tampilkan QR Code
        </button>

        <a href="form_absen.php" class="btn btn-absen shadow">
            <i class="fas fa-camera me-2"></i> ABSEN SEKARANG
        </a>
        
        <a href="../logout.php" class="d-block mt-4 text-muted text-decoration-none small">Keluar Aplikasi</a>
    <?php endif; ?>
</div>

<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 30px;">
      <div class="modal-body text-center p-5">
        <h4 class="fw-bold mb-3">QR Code Presensi</h4>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= $user_id ?>" class="img-fluid mb-4 rounded-3 border p-2">
        <h5 class="fw-bold text-primary mb-0"><?= $data['nama_lengkap'] ?></h5>
        <button type="button" class="btn btn-secondary rounded-pill w-100 mt-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = 
            now.getHours().toString().padStart(2, '0') + "." + 
            now.getMinutes().toString().padStart(2, '0') + "." + 
            now.getSeconds().toString().padStart(2, '0');
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
</body>
</html>
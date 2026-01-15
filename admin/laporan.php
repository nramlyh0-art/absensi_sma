<?php
include '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Proteksi Admin: Pastikan hanya admin yang bisa akses
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index.php"); exit;
}

// Proses Validasi (Setuju/Tolak) untuk Izin dan Sakit
if(isset($_GET['aksi']) && isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = ($_GET['aksi'] == 'setuju') ? 'Disetujui' : 'Ditolak';
    
    $update = mysqli_query($conn, "UPDATE absensi SET status_validasi='$status' WHERE id='$id'");
    if($update){
        echo "<script>alert('Status berhasil diperbarui menjadi $status'); window.location='laporan.php';</script>";
    }
}

// Ambil data absensi gabung dengan data user
$query = mysqli_query($conn, "SELECT absensi.*, users.nama_lengkap, users.kelas 
                              FROM absensi 
                              JOIN users ON absensi.user_id = users.id 
                              ORDER BY absensi.tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi | Admin SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { background: #f4f7f6; font-family: 'Poppins', sans-serif; }
        .container-admin { padding: 40px; }
        .card-laporan { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; }
        .table thead { background: #2D94FF; color: white; border: none; }
        .badge-status { font-size: 0.75rem; padding: 6px 15px; border-radius: 50px; font-weight: 600; }
        .img-bukti { width: 60px; height: 60px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 1px solid #ddd; }
        .btn-action { transition: 0.3s; }
        .btn-action:hover { transform: scale(1.05); }
    </style>
</head>
<body>

<div class="container-admin">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-0">Laporan Absensi</h2>
            <p class="text-muted">Kelola kehadiran dan validasi izin siswa</p>
        </div>
        <a href="dashboard.php" class="btn btn-secondary rounded-pill px-4 shadow-sm">
            <i class="fas fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    <div class="card-laporan">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-3">Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                        <th>Status Validasi</th>
                        <th class="text-center">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td class="ps-3"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                        <td>
                            <div class="fw-bold"><?= htmlspecialchars($row['nama_lengkap']) ?></div>
                        </td>
                        <td><?= htmlspecialchars($row['kelas']) ?></td>
                        <td>
                            <?php 
                            $ket = $row['keterangan'];
                            $color = ($ket == 'Hadir') ? 'success' : (($ket == 'Izin') ? 'warning' : 'danger');
                            echo "<span class='badge bg-$color'>$ket</span>";
                            ?>
                        </td>
                        <td>
                            <?php if(!empty($row['bukti_foto'])): ?>
                                <a href="../assets/img/bukti/<?= $row['bukti_foto'] ?>" target="_blank">
                                    <img src="../assets/img/bukti/<?= $row['bukti_foto'] ?>" class="img-bukti shadow-sm">
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                            // Logika agar Hadir otomatis terlihat Disetujui
                            if($row['keterangan'] == 'Hadir') {
                                echo "<span class='badge-status bg-success text-white'><i class='fas fa-check-circle me-1'></i> Disetujui</span>";
                            } else {
                                $st = $row['status_validasi'];
                                $st_color = ($st == 'Disetujui') ? 'success' : (($st == 'Ditolak') ? 'danger' : 'warning');
                                echo "<span class='badge-status bg-$st_color text-white'>$st</span>";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if(($row['keterangan'] == 'Izin' || $row['keterangan'] == 'Sakit') && $row['status_validasi'] == 'Pending'): ?>
                                <a href="laporan.php?aksi=setuju&id=<?= $row['id'] ?>" class="btn btn-sm btn-success rounded-pill px-3 btn-action" onclick="return confirm('Setujui izin ini?')">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="laporan.php?aksi=tolak&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger rounded-pill px-3 btn-action" onclick="return confirm('Tolak izin ini?')">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php elseif($row['keterangan'] == 'Hadir'): ?>
                                <span class="text-muted small italic">Sistem Otomatis</span>
                            <?php else: ?>
                                <span class="badge bg-light text-dark border">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
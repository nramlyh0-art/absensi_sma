<?php
include '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Proteksi Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index.php"); exit;
}

// Proses Validasi (Setuju/Tolak)
if(isset($_GET['aksi']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $status = ($_GET['aksi'] == 'setuju') ? 'Disetujui' : 'Ditolak';
    
    mysqli_query($conn, "UPDATE absensi SET status_validasi='$status' WHERE id='$id'");
    echo "<script>alert('Status berhasil diupdate!'); window.location='laporan.php';</script>";
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
    <title>Laporan Absensi | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; font-family: 'Poppins', sans-serif; }
        .container-admin { padding: 40px; }
        .card-laporan { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .table thead { background: #2D94FF; color: white; }
        .badge-status { font-size: 0.8rem; padding: 5px 12px; border-radius: 50px; }
        .img-bukti { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container-admin">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-file-invoice me-2 text-primary"></i> Laporan Absensi Siswa</h2>
        <a href="dashboard.php" class="btn btn-secondary rounded-pill px-4"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
    </div>

    <div class="card-laporan">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                        <td class="fw-bold"><?= $row['nama_lengkap'] ?></td>
                        <td><?= $row['kelas'] ?></td>
                        <td>
                            <?php 
                            $color = ($row['keterangan'] == 'Hadir') ? 'success' : (($row['keterangan'] == 'Izin') ? 'warning' : 'danger');
                            echo "<span class='badge bg-$color'>".$row['keterangan']."</span>";
                            ?>
                        </td>
                        <td>
                            <a href="../assets/img/bukti/<?= $row['bukti_foto'] ?>" target="_blank">
                                <img src="../assets/img/bukti/<?= $row['bukti_foto'] ?>" class="img-bukti shadow-sm">
                            </a>
                        </td>
                        <td>
                            <?php 
                            $st_color = ($row['status_validasi'] == 'Disetujui') ? 'success' : (($row['status_validasi'] == 'Ditolak') ? 'danger' : 'secondary');
                            echo "<span class='badge-status bg-$st_color text-white'>".$row['status_validasi']."</span>";
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if(($row['keterangan'] == 'Izin' || $row['keterangan'] == 'Sakit') && $row['status_validasi'] == 'Pending'): ?>
                                <a href="laporan.php?aksi=setuju&id=<?= $row['id'] ?>" class="btn btn-sm btn-success rounded-pill px-3 mb-1" onclick="return confirm('Setujui izin ini?')">
                                    <i class="fas fa-check me-1"></i> Setuju
                                </a>
                                <a href="laporan.php?aksi=tolak&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger rounded-pill px-3 mb-1" onclick="return confirm('Tolak izin ini?')">
                                    <i class="fas fa-times me-1"></i> Tolak
                                </a>
                            <?php elseif($row['keterangan'] == 'Hadir'): ?>
                                <span class="text-muted small">Otomatis Terabsen</span>
                            <?php else: ?>
                                <i class="fas fa-minus-circle text-muted"></i>
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
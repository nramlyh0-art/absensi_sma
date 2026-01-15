<?php 
include '../includes/db.php'; 

// Query JOIN agar data nama dan kelas dari tabel users ikut terbaca
$tgl_hari_ini = date('Y-m-d');
$query = mysqli_query($conn, "SELECT absensi.*, users.nama_lengkap, users.kelas 
                              FROM absensi 
                              JOIN users ON absensi.user_id = users.id 
                              WHERE absensi.tanggal = '$tgl_hari_ini' 
                              ORDER BY absensi.jam_masuk DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #FFDAE9; font-family: 'Poppins', sans-serif; padding: 40px 20px; }
        .card-rekap { 
            background: white; border-radius: 30px; border: none; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); padding: 35px; 
            max-width: 1000px; margin: auto;
        }
        .text-blue { color: #0056b3; font-weight: 700; }
        .table thead { background: #f8f9fa; color: #666; font-size: 0.85rem; }
        .badge-hadir { background: #d1e7dd; color: #0f5132; font-weight: 600; border-radius: 8px; padding: 8px 15px; }
        .btn-kembali { background: #333; color: white; border-radius: 12px; padding: 10px 25px; text-decoration: none; transition: 0.3s; }
        .btn-kembali:hover { background: #000; color: white; }
    </style>
</head>
<body>

<div class="card-rekap">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-blue m-0">Rekap Kehadiran</h2>
            <p class="text-muted small m-0">Tanggal: <?= date('d F Y', strtotime($tgl_hari_ini)); ?></p>
        </div>
        <a href="dashboard.php" class="btn-kembali shadow-sm">Kembali</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="ps-3">JAM</th>
                    <th>NAMA SISWA</th>
                    <th>KELAS / JURUSAN</th>
                    <th class="text-center">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td class="ps-3 fw-bold text-muted"><?= $row['jam_masuk']; ?></td>
                        <td>
                            <div class="text-blue"><?= $row['nama_lengkap']; ?></div>
                        </td>
                        <td><span class="badge bg-light text-dark border"><?= !empty($row['kelas']) ? $row['kelas'] : '-'; ?></span></td>
                        <td class="text-center">
                            <span class="badge-hadir">Hadir</span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada data hari ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
<?php 
include '../includes/db.php'; 
$tgl = date('Y-m-d');
// Hitung data
$h = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM absensi WHERE tanggal='$tgl' AND keterangan='Hadir'"))['t'];
$s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM absensi WHERE tanggal='$tgl' AND keterangan='Sakit'"))['t'];
$i = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM absensi WHERE tanggal='$tgl' AND keterangan='Izin'"))['t'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary: #2D94FF; --bg: #f4f7fe; }
        body { background: var(--bg); font-family: 'Poppins', sans-serif; }
        
        .sidebar { 
            width: 260px; height: 100vh; background: var(--primary); 
            position: fixed; color: white; padding: 30px 20px;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            z-index: 100;
        }
        .sidebar a { 
            color: white; text-decoration: none; display: block; 
            padding: 12px 20px; border-radius: 15px; margin-bottom: 10px;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); font-weight: 600; }
        
        .main-content { margin-left: 260px; padding: 50px; }
        
        .stat-card { 
            background: white; border: none; border-radius: 25px; 
            padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s; position: relative; overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-10px); }
        .stat-card h2 { font-size: 3rem; font-weight: 800; margin: 10px 0; }
        .stat-card .icon { 
            position: absolute; right: -10px; bottom: -10px; 
            font-size: 5rem; opacity: 0.1; transform: rotate(-15deg); 
        }
        
        .btn-logout { background: #ff4d4d; border: none; border-radius: 12px; width: 100%; margin-top: 50px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h3 class="fw-bold mb-5"><i class="fas fa-school me-2"></i> THENTIC</h3>
    <a href="dashboard.php" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="laporan_riwayat.php"><i class="fas fa-calendar-check me-2"></i> Riwayat Absen</a>
    <a href="data_siswa.php"><i class="fas fa-users me-2"></i> Data Siswa</a>
    <a href="../logout.php" class="btn btn-logout py-2"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="main-content">
    <h2 class="fw-bold mb-5">Ringkasan Hari Ini</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="stat-card" style="border-top: 8px solid #2ecc71;">
                <h6 class="text-muted fw-bold">HADIR</h6>
                <h2 class="text-success"><?= $h ?></h2>
                <i class="fas fa-user-check icon"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-top: 8px solid #f1c40f;">
                <h6 class="text-muted fw-bold">SAKIT</h6>
                <h2 class="text-warning"><?= $s ?></h2>
                <i class="fas fa-briefcase-medical icon"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-top: 8px solid #3498db;">
                <h6 class="text-muted fw-bold">IZIN</h6>
                <h2 class="text-info"><?= $i ?></h2>
                <i class="fas fa-envelope icon"></i>
            </div>
        </div>
    </div>
</div>

</body>
</html>
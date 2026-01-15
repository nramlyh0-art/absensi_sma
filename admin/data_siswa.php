<?php
include '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Proteksi Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index.php"); exit;
}

// Ambil data seluruh siswa
$query = mysqli_query($conn, "SELECT * FROM users WHERE role = 'siswa' ORDER BY nama_lengkap ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa | Admin SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; font-family: 'Poppins', sans-serif; }
        .sidebar { width: 250px; background: #2D94FF; color: white; min-height: 100vh; position: fixed; }
        .main-content { margin-left: 250px; padding: 40px; }
        .table-container { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .img-siswa { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #2D94FF; }
        .na-initials { 
            width: 50px; height: 50px; border-radius: 50%; background: #e0e0e0; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 14px; color: #777; font-weight: bold;
        }
    </style>
</head>
<body>

<div class="sidebar p-4">
    <h3 class="fw-bold">SMA THENTIC</h3>
    <p class="small opacity-75">Admin Panel</p>
    <hr>
    <nav class="nav flex-column mt-4">
        <a class="nav-link text-white mb-2" href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a class="nav-link text-white fw-bold mb-2 active" href="data_siswa.php"><i class="fas fa-users me-2"></i> Data Siswa</a>
        <a class="nav-link text-white mb-2" href="laporan.php"><i class="fas fa-file-alt me-2"></i> Laporan</a>
        <a class="nav-link text-warning mt-5" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Seluruh Siswa</h2>
        <span class="badge bg-primary rounded-pill px-3 py-2"><?= mysqli_num_rows($query) ?> Siswa</span>
    </div>

    <div class="table-container">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Di sinilah variabel $row didefinisikan
                while($row = mysqli_fetch_assoc($query)): 
                    
                    // --- LOGIKA PEMANGGILAN FOTO SISWA ---
                    $nama_foto = $row['foto'];
                    $path = "../assets/img/" . $nama_foto;
                    
                    // Cek jika file ada, coba cari dengan ekstensi .jpg atau .png
                    if (!file_exists($path) || empty($nama_foto)) {
                        $path = "../assets/img/" . $nama_foto . ".jpg";
                    }
                    if (!file_exists($path)) {
                        $path = "../assets/img/" . $nama_foto . ".png";
                    }

                    $foto_final = (file_exists($path) && !empty($nama_foto)) ? $path : null;
                ?>
                <tr>
                    <td>
                        <?php if($foto_final): ?>
                            <img src="<?= $foto_final ?>" class="img-siswa">
                        <?php else: ?>
                            <div class="na-initials"><?= strtoupper(substr($row['nama_lengkap'], 0, 2)) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="fw-bold"><?= $row['nama_lengkap'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><span class="badge bg-info text-dark"><?= $row['kelas'] ?></span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-light border"><i class="fas fa-edit text-primary"></i></button>
                        <button class="btn btn-sm btn-light border"><i class="fas fa-trash text-danger"></i></button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
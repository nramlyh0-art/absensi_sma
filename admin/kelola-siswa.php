<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f0f7ff; font-family: 'Poppins', sans-serif; padding: 30px; }
        .card-main { border-radius: 30px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.05); background: white; padding: 30px; }
        .img-siswa { 
            width: 60px; height: 60px; object-fit: cover; 
            border-radius: 50%; border: 3px solid #FFC8DD; 
        }
        .text-blue { color: #0056b3; font-weight: 700; }
        .badge-kelas { background: #e0f0ff; color: #007bff; padding: 5px 12px; border-radius: 10px; font-weight: 600; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="card-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-blue m-0">Daftar Akun Siswa</h2>
                <p class="text-muted small">Manajemen data profil dan akun akses siswa</p>
            </div>
            <a href="dashboard.php" class="btn btn-dark rounded-pill px-4 shadow-sm"> Kembali </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small">
                        <th>FOTO</th>
                        <th>NAMA LENGKAP</th>
                        <th>USERNAME</th>
                        <th>KELAS</th>
                        <th>PASSWORD</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE role = 'siswa' ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($query)) :
                        
                        $foto_db = $row['foto'];
                        
                        // LOGIKA PENGECEKAN FOTO (Berdasarkan struktur folder VS Code kamu)
                        $path1 = "../assets/img/img/" . $foto_db; // Folder ganda
                        $path2 = "../assets/img/" . $foto_db;     // Folder tunggal

                        if (!empty($foto_db) && file_exists($path1)) {
                            $gambar_final = $path1;
                        } elseif (!empty($foto_db) && file_exists($path2)) {
                            $gambar_final = $path2;
                        } else {
                            // Cek apakah logo sekolah ada di folder img/img/
                            $logo = "../assets/img/img/logo.png.jpg";
                            $gambar_final = (file_exists($logo)) ? $logo : "https://ui-avatars.com/api/?name=" . urlencode($row['username']) . "&background=A2D2FF&color=fff";
                        }
                    ?>
                    <tr>
                        <td>
                            <img src="<?= $gambar_final ?>" class="img-siswa" alt="Profile">
                        </td>
                        <td>
                            <div class="text-blue"><?= !empty($row['nama_lengkap']) ? $row['nama_lengkap'] : $row['username'] ?></div>
                            <small class="text-muted">ID: #<?= $row['id'] ?></small>
                        </td>
                        <td class="text-muted">@<?= $row['username'] ?></td>
                        <td><span class="badge-kelas"><?= !empty($row['kelas']) ? $row['kelas'] : '12 IPA' ?></span></td>
                        <td><span class="badge bg-light text-danger fw-bold"><?= $row['password'] ?></span></td>
                        <td class="text-center">
                            <a href="edit-siswa.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-light text-primary rounded-circle p-2 shadow-sm"><i class="fas fa-edit"></i></a>
                            <a href="hapus-siswa.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus siswa ini?')" class="btn btn-sm btn-light text-danger rounded-circle p-2 shadow-sm ms-1"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
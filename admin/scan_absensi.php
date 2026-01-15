<?php
include '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Proteksi Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index.php"); exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scan Absensi | SMA THENTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        body { background: #f4f7f6; font-family: 'Poppins', sans-serif; }
        .main-content { padding: 40px; text-align: center; }
        #reader { 
            width: 100%; max-width: 500px; margin: 0 auto; 
            border: 10px solid white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .result-card { 
            background: white; border-radius: 20px; padding: 20px; 
            margin-top: 20px; display: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="main-content">
    <h2 class="fw-bold mb-4"><i class="fas fa-qrcode text-primary me-2"></i> Scan QR Code Siswa</h2>
    <p class="text-muted">Arahkan kamera ke QR Code milik siswa untuk melakukan absensi otomatis.</p>
    
    <div id="reader"></div>

    <div id="result" class="result-card mx-auto" style="max-width: 500px;">
        <h4 id="nama-siswa" class="fw-bold text-primary"></h4>
        <p id="pesan-absen" class="mb-0"></p>
    </div>

    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-secondary rounded-pill px-4">Kembali</a>
    </div>
</div>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Hentikan scan sementara setelah berhasil scan satu QR
        html5QrcodeScanner.clear();

        // Kirim data ke file proses menggunakan AJAX
        fetch('proses_scan.php?id_siswa=' + decodedText)
            .then(response => response.json())
            .then(data => {
                const resDiv = document.getElementById('result');
                resDiv.style.display = 'block';
                
                if(data.status === 'success') {
                    document.getElementById('nama-siswa').innerText = data.nama;
                    document.getElementById('pesan-absen').innerText = "✅ Absen Berhasil Dicatat!";
                    resDiv.className = "result-card mx-auto border-start border-5 border-success";
                } else {
                    document.getElementById('nama-siswa').innerText = "Gagal";
                    document.getElementById('pesan-absen').innerText = data.message;
                    resDiv.className = "result-card mx-auto border-start border-5 border-danger";
                }

                // Mulai scan lagi setelah 3 detik
                setTimeout(() => {
                    location.reload();
                }, 3000);
            });
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
</body>
</html>
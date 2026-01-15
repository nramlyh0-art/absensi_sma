<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SMA THENTIC JAKARTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --blue: #A2D2FF;
            --pink: #FFAFCC;
            --dark-blue: #2D94FF;
        }

        body {
            background: linear-gradient(135deg, var(--blue) 0%, var(--pink) 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Navbar Transparan */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 15px 50px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Hero Section */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
        }

        .glass-hero {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(25px);
            border-radius: 50px;
            padding: 60px;
            max-width: 900px;
            width: 100%;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        }

        .school-logo {
            width: 150px;
            height: 150px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
            transition: 0.5s;
        }

        .school-logo:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .welcome-text {
            font-weight: 700;
            font-size: 3.5rem;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .sub-text {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 40px;
        }

        /* Tombol Akses */
        .btn-access {
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            display: inline-block;
            text-decoration: none;
        }

        .btn-login {
            background: linear-gradient(45deg, var(--dark-blue), #FF8FAB);
            color: white;
            box-shadow: 0 10px 20px rgba(45, 148, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 143, 171, 0.4);
            color: white;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: rgba(0,0,0,0.5);
        }

        @media (max-width: 768px) {
            .welcome-text { font-size: 2.2rem; }
            .glass-hero { padding: 40px 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar-custom d-flex justify-content-between align-items-center">
    <div class="fw-bold text-dark fs-5">
        <i class="fas fa-graduation-cap me-2"></i> SMA THENTIC
    </div>
    <div class="small text-muted d-none d-md-block">
        <i class="fas fa-map-marker-alt me-1"></i> Jakarta, Indonesia
    </div>
</nav>

<div class="hero-section">
    <div class="glass-hero">
        <img src="assets/img/logo.png" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2991/2991148.png'" alt="Logo SMA THENTIC" class="school-logo">
        
        <h1 class="welcome-text">SMA THENTIC JAKARTA</h1>
        <p class="sub-text">Sistem Presensi Digital & Informasi Akademik Terpadu.</p>
        
        <div class="mt-2">
            <a href="index.php" class="btn-access btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk Ke Sistem
            </a>
        </div>

        <div class="row mt-5 pt-4 border-top border-white border-opacity-50">
            <div class="col-4">
                <h5 class="fw-bold mb-0">1.2k+</h5>
                <p class="small text-muted">Siswa</p>
            </div>
            <div class="col-4">
                <h5 class="fw-bold mb-0">80+</h5>
                <p class="small text-muted">Guru</p>
            </div>
            <div class="col-4">
                <h5 class="fw-bold mb-0">A</h5>
                <p class="small text-muted">Akreditasi</p>
            </div>
        </div>
    </div>
</div>

<footer>
    &copy; 2024 SMA THENTIC JAKARTA. All Rights Reserved.
</footer>

</body>
</html>
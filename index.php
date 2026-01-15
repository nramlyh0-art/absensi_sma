<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SMA THENTIC JAKARTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #FFDAE9; font-family: 'Poppins', sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .login-container { background: white; border-radius: 50px; display: flex; overflow: hidden; width: 1000px; max-width: 95%; box-shadow: 0 25px 50px rgba(0,0,0,0.1); min-height: 550px; }
        .login-left { background: #FDF4F7; width: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; text-align: center; }
        .login-right { width: 50%; padding: 60px; display: flex; flex-direction: column; justify-content: center; }
        
        /* Logo Diperbesar & Background Putih Disamarkan */
        .logo-img { 
            width: 280px; 
            margin-bottom: 20px; 
            mix-blend-mode: multiply; /* Menghapus background putih secara visual */
        }
        
        .btn-primary { background: #2D94FF; border: none; border-radius: 15px; padding: 15px; font-weight: bold; font-size: 1.1rem; }
        .form-control { border-radius: 15px; padding: 15px; background: #E9F2FF; border: none; }
        .link-daftar { color: #2D94FF; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-left">
        <img src="assets/img/logo.png" class="logo-img" alt="Logo SMA Thentic">
        <h1 class="fw-bold text-primary" style="font-size: 2.5rem;">SMA THENTIC</h1>
        <p class="text-muted px-4">"Masa depan adalah milik mereka yang percaya pada keindahan mimpi mereka."</p>
    </div>

    <div class="login-right">
        <h2 class="fw-bold mb-4">Selamat Datang</h2>
        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label class="small fw-bold text-muted mb-2">USERNAME / NISN</label>
                <input type="text" name="username" class="form-control" placeholder="admin / nisn" required>
            </div>
            <div class="mb-4">
                <label class="small fw-bold text-muted mb-2">PASSWORD</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 mb-4 shadow">MASUK KE SISTEM</button>
            <p class="text-center small text-muted">Belum punya akun? <a href="daftar.php" class="link-daftar">Daftar Sekarang</a></p>
        </form>
    </div>
</div>

</body>
</html>
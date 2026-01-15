<?php
include 'includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Jika password di database di-encrypt, gunakan md5() atau password_verify()

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['nama'] = $data['nama_lengkap'];

        if ($data['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: siswa/dashboard.php");
        }
    } else {
        echo "<script>alert('Login Gagal! Username atau Password salah.'); window.location='index.php';</script>";
    }
}
?>
<?php
session_start();
// Menghapus semua data session
session_unset();
session_destroy();

// Mengalihkan kembali ke halaman login
header("Location: index.php");
exit();
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function restrictToAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../index.php");
        exit();
    }
}

function restrictToSiswa() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
        header("Location: ../index.php");
        exit();
    }
}
?>
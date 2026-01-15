<?php
include '../includes/db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
}
header("Location: kelola-siswa.php");
?>
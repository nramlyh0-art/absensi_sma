<?php
include '../includes/db.php';

// Memberitahu browser untuk mengunduh file excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Absensi_Siswa.xls");
?>

<h2>LAPORAN ABSENSI SISWA - SMA THENTIC</h2>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        // Query JOIN untuk mengambil nama dari tabel users
        $sql = mysqli_query($conn, "SELECT absensi.*, users.nama_lengkap, users.kelas 
                                    FROM absensi 
                                    JOIN users ON absensi.user_id = users.id 
                                    ORDER BY absensi.tanggal DESC, absensi.jam_masuk DESC");
        while($data = mysqli_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['jam_masuk']; ?></td>
            <td><?= $data['nama_lengkap']; ?></td>
            <td><?= $data['kelas']; ?></td>
            <td>Hadir</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
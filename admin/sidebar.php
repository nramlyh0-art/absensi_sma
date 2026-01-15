<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-primary" style="width: 280px; height: 100vh; position: fixed;">
    <div class="sidebar-header text-center mb-4">
        <h4 class="fw-bold mb-0">SMA THENTIC</h4>
        <small class="text-white-50">Admin Panel</small>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white <?= $current_page == 'dashboard.php' ? 'active bg-dark' : '' ?> mb-2">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="scan.php" class="nav-link text-white <?= $current_page == 'scan.php' ? 'active bg-dark' : '' ?> mb-2">
                <i class="fas fa-qrcode me-2"></i> Scan Absensi
            </a>
        </li>
        <li>
            <a href="laporan_riwayat.php" class="nav-link text-white <?= $current_page == 'laporan_riwayat.php' ? 'active bg-dark' : '' ?> mb-2">
                <i class="fas fa-history me-2"></i> Riwayat Absen
            </a>
        </li>
        <li>
            <a href="laporan_excel.php" class="nav-link text-white mb-2">
                <i class="fas fa-file-excel me-2"></i> Export Excel
            </a>
        </li>
    </ul>
    <hr>
    <div class="logout-section">
        <a href="../logout.php" class="nav-link text-warning fw-bold">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>
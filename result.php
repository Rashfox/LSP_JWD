<!-- 
    Author  : Rizki Fajar Purnomo
    Version : 1.0 
-->
<?php
// lihat.php
require_once 'connect.php'; // Panggil file koneksi database
require_once 'functions.php'; // Panggil file fungsi

$pendaftaran = null; // Inisialisasi variabel untuk data pendaftaran
$message = '';

if (isset($_GET['id'])) {
    $id_pendaftaran = $_GET['id'];
    
    // Panggil fungsi getDataPendaftaran untuk mengambil satu data detail
    $result = getDataPendaftaran($conn, $id_pendaftaran);
    
    if (!empty($result['list'])) {
        $pendaftaran = $result['list'][0]; // Ambil elemen pertama dari list
    } else {
        $message = $result['message'];
    }
} else {
    $message = '<div class="alert alert-info mt-3" role="alert">Tidak ada ID pendaftaran yang diberikan. Silakan daftar beasiswa terlebih dahulu.</div>';
}
?>
<html>
    <head>
        <title>Hasil Pendaftaran Beasiswa - LSP JWD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <style>
            body { display: flex; flex-direction: column; min-height: 100vh; }
            main { flex: 1; }
            .fixed-bottom { position: fixed; bottom: 0; width: 100%; }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">BEASISWA</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="daftar.php">Daftar</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="lihat.php">Lihat</a></li>
                    </ul>
                </div>
                </div>
            </nav>
        </header>
        <main class="container mt-3">
            <h2 style="text-align: center;">Hasil Pendaftaran Beasiswa</h2>
            <?php if ($pendaftaran) { ?>
                <div class="card p-4" style="width: 70%; margin: 0 auto;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td><?php echo htmlspecialchars($pendaftaran['nama']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?php echo htmlspecialchars($pendaftaran['email']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor HP</th>
                                <td><?php echo htmlspecialchars($pendaftaran['nohp']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Semester Saat Ini</th>
                                <td><?php echo htmlspecialchars($pendaftaran['semester']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">IPK Terakhir</th>
                                <td><?php echo htmlspecialchars($pendaftaran['ipk']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Beasiswa</th>
                                <td><?php echo htmlspecialchars($pendaftaran['jenis_beasiswa']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Berkas</th>
                                <td>
                                    <?php
                                    if ($pendaftaran['berkas']) {
                                        echo htmlspecialchars($pendaftaran['berkas']);
                                        echo ' (<a href="' . htmlspecialchars($pendaftaran['path_berkas']) . '" target="_blank">Lihat Berkas</a>)';
                                    } else {
                                        echo 'Tidak ada berkas diunggah';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status Ajuan</th>
                                <td><span class="badge bg-warning text-dark"><?php echo htmlspecialchars($pendaftaran['status_ajuan']); ?></span></td> </tr>
                            <tr>
                                <th scope="row">Tanggal Daftar</th>
                                <td><?php echo htmlspecialchars($pendaftaran['tanggal_daftar']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                        <a href="daftar.php" class="btn btn-secondary">Daftar Lagi</a>
                        <a href="lihat.php" class="btn btn-primary">Lihat Semua Pendaftar</a>
                    </div>
                </div>
            <?php } else {
                echo $message;
            } ?>
        </main>
        <footer class="bg-dark text-white py-2 text-center fixed-bottom">
            <p>&copy; 2025 Beasiswa JWD. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>
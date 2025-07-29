<!-- 
    Author  : Rizki Fajar Purnomo
    Version : 1.0 
-->
<?php
// lihat.php
require_once 'connect.php'; // Koneksi ke database
require_once 'functions.php'; // Panggil file fungsi

$pendaftaran_list = []; // Inisialisasi array untuk menyimpan semua data pendaftaran
$search_query = ''; // Variabel untuk menyimpan kata kunci pencarian

// Ambil kata kunci pencarian jika ada
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);
}

// Panggil fungsi getDataPendaftaran
$result = getDataPendaftaran($conn, null, $search_query); // Memanggil tanpa ID, tapi dengan search_query
$pendaftaran_list = $result['list'];
$message = $result['message'];

// Jika ada ID di URL, ambil detail pendaftaran berdasarkan ID
// Logika ini dipisah agar bisa menampilkan tabel semua data atau detail satu data.
if (isset($_GET['id']) && !isset($_GET['search'])) {
    $detail_result = getDataPendaftaran($conn, $_GET['id']);
    if (!empty($detail_result['list'])) {
        // Redirect ke result.php jika user klik detail dari tabel
        header("Location: result.php?id=" . htmlspecialchars($_GET['id']));
        exit();
    } else {
        $message = $detail_result['message']; // Pesan error jika ID detail tidak ditemukan
    }
}
?>
<html>
    <head>
        <title>Daftar Beasiswa - LSP JWD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <style>
            body { display: flex; flex-direction: column; min-height: 100vh; }
            main { flex: 1; }
            .fixed-bottom { position: fixed; bottom: 0; width: 100%; }
            .table-responsive-sm { /* untuk responsif di layar kecil */
                overflow-x: auto;
            }
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
            <h2 style="text-align: center;">Daftar Pendaftar Beasiswa</h2>

            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <form action="lihat.php" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Nama, Email, atau Jenis Beasiswa..." name="search" value="<?php echo htmlspecialchars($search_query); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            <?php if (!empty($search_query)) { ?>
                                <a href="lihat.php" class="btn btn-outline-danger">Reset</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!empty($message)) { // Tampilkan pesan jika ada ?>
                <?php echo $message; ?>
            <?php } ?>

            <?php if (!empty($pendaftaran_list)) { ?>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Jenis Beasiswa</th>
                                <th>Berkas</th>
                                <th>Status Ajuan</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendaftaran_list as $data) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['id']); ?></td>
                                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($data['email']); ?></td>
                                    <td><?php echo htmlspecialchars($data['nohp']); ?></td>
                                    <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                    <td><?php echo htmlspecialchars($data['ipk']); ?></td>
                                    <td><?php echo htmlspecialchars($data['jenis_beasiswa']); ?></td>
                                    <td>
                                        <?php if ($data['berkas']) { ?>

                                            <a href="<?php echo htmlspecialchars($data['path_berkas']); ?>" target="_blank" class="btn btn-sm btn-info">Lihat Berkas</a> 
                                        <?php } else { ?>
                                            Tidak Ada
                                        <?php } ?>
                                    </td>
                                    <td><span class="badge bg-warning text-dark"><?php echo htmlspecialchars($data['status_ajuan']); ?></span></td>
                                    <td><?php echo htmlspecialchars($data['tanggal_daftar']); ?></td>
                                    <td>
                                        <a href="lihat.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </main>
        <footer class="bg-dark text-white py-2 text-center fixed-bottom">
            <p>&copy; 2025 Beasiswa JWD. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>
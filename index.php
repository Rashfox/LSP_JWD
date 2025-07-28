<!-- index.php -->
<html>
    <head>
        <title>LSP JWD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
        <main class="container mt-3" style="text-align: center;" >
            <h2>Selamat Datang di Website Beasiswa</h2>
            <p>Silakan pilih jenis beasiswa untuk melanjutkan.</p>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card" style="margin:auto;">
                        <div class="card-body">
                            <h5 class="card-title">Beasiswa Akademik</h5>
                        <p class="card-text">persyaratan:
                            <ul class="list-unstyled">
                                <li>IPK minimal 3</li>
                                <li>Aktif dalam organisasi kampus</li>
                                <li>Rekomendasi dari dosen</li>
                            </ul>
                        </p>
                        <a href="daftar.php" class="btn btn-primary">Daftar Beasiswa</a></form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card" style="margin:auto;">
                        <div class="card-body">
                            <h5 class="card-title">Beasiswa Non-Akademik</h5>
                            <p class="card-text">persyaratan:
                                <ul class="list-unstyled">
                                    <li>Pengalaman dalam kegiatan sosial</li>
                                    <li>Portofolio kegiatan non-akademik</li>
                                    <li>Rekomendasi dari komunitas</li>
                                </ul>
                            </p>
                            <a href="daftar.php" class="btn btn-primary">Daftar Beasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="bg-dark text-white py-2 text-center fixed-bottom">
            <p>&copy; 2025 Beasiswa JWD. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>
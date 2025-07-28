<?php
// daftar.php
// File ini digunakan untuk mendaftar beasiswa
require 'connect.php'; // Koneksi ke database 
require 'functions.php'; // Panggil file fungsi 

const IPK_MAHASISWA = 3.4;// Contoh IPK mahasiswa, bisa diambil dari database atau inputan lain 

$ipk = IPK_MAHASISWA;
$disabled = ($ipk < 3) ? 'disabled' : '';// Jika IPK kurang dari 3, disable inputan jenis beasiswa dan upload berkas 

// Penanganan upload file
$upload_dir = 'uploads/'; // Direktori untuk menyimpan file yang diupload 
if (!is_dir($upload_dir)) { // 
    mkdir($upload_dir); // Buat direktori jika belum ada 
}

$message = ''; // Menggunakan satu variabel pesan saja 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Jika form disubmit 
    if ($ipk >= 3) { // 
        $nama = htmlspecialchars($_POST['nama']);
        $email = htmlspecialchars($_POST['email']);
        $nohp = htmlspecialchars($_POST['nohp']); // Pastikan ini tidak dihardcode 
        $semester = htmlspecialchars($_POST['semester']);
        $jenis_beasiswa = isset($_POST['jenis_beasiswa']) ? htmlspecialchars($_POST['jenis_beasiswa']) : '';

        // Panggil fungsi handleFileUpload 
        $file_upload_result = handleFileUpload($_FILES['upload'], $upload_dir);
        $berkas = $file_upload_result['berkas'];
        $path_berkas = $file_upload_result['path_berkas'];
        $message = $file_upload_result['message']; // Ambil pesan dari fungsi upload 

        // HANYA LANJUTKAN JIKA TIDAK ADA PESAN ERROR DARI UPLOAD FILE
        // Periksa apakah pesan dari upload adalah pesan error (bukan sukses, atau kosong)
        if (strpos($message, 'alert-danger') === false) { // Cek apakah pesan berisi 'alert-danger'
            try {
                // Siapkan data untuk fungsi simpanPendaftaran 
                $pendaftaran_data = [ // 
                    'nama' => $nama,
                    'email' => $email,
                    'nohp' => $nohp,
                    'semester' => $semester,
                    'ipk' => $ipk,
                    'jenis_beasiswa' => $jenis_beasiswa
                ];
                $file_data = [ // 
                    'berkas' => $berkas,
                    'path_berkas' => $path_berkas
                ];

                // Panggil fungsi simpanPendaftaran 
                $last_id = simpanPendaftaran($conn, $pendaftaran_data, $file_data);

                // Setelah berhasil menyimpan, redirect ke halaman result.php 
                header("Location: result.php?id=" . $last_id);
                exit();
            } catch (Exception $e) { // Tangkap exception dari fungsi simpanPendaftaran 
                $message = '<div class="alert alert-danger mt-3" role="alert">' . $e->getMessage() . '</div>';
            }
        }
    } else {
        $message = '<div class="alert alert-warning mt-3" role="alert">Maaf, IPK Anda di bawah 3.0. Anda tidak dapat mendaftar beasiswa.</div>';
    }
}
?>
<html>
    <head>
        <title>LSP JWD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <style>
            /* Untuk memastikan footer tetap di bawah */
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            main {
                flex: 1;
            }
            .fixed-bottom {
                position: fixed;
                bottom: 0;
                width: 100%;
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
            <legend style="text-align: center;">Daftar Beasiswa</legend>
            <fieldset style="width: 70%; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">
                <form action="daftar.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="100%" border="0">
                        <tr>
                            <td valign="middle" class="pb-2">Masukan Nama</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2"><input class="form-control" type="text" name="nama" required></td> </tr>
                        <tr>
                            <td valign="middle" class="pb-2">Masukan Email</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2"><input class="form-control" type="email" name="email" required></td> </tr>
                        <tr>
                            <td valign="middle" class="pb-2">Nomor HP</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2"><input class="form-control" type="number" name="nohp" max="9999999999999" required></td> </tr>
                        <tr>
                            <td valign="middle" class="pb-2">Semester saat ini</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2">
                                <select class="form-select" name="semester" style="width: 150px;" required>
                                    <?php for ($s = 1; $s <= 8; $s++) {?>
                                        <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" class="pb-2">IPK terakhir</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2"><input class="form-control" type="number" name="ipk" value="<?php echo $ipk; ?>" readonly></td> </tr>
                        <tr>
                            <td valign="middle" class="pb-2">Pilih Beasiswa</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2">
                                <select class="form-select" name="jenis_beasiswa" style="width: 150px;" <?php echo $disabled; ?> required> <option value="akademik">Akademik</option>
                                    <option value="non-akademik">Non-Akademik</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" class="pb-2">Upload Berkas Syarat</td>
                            <td valign="middle" class="pb-2">:</td>
                            <td class="pb-2"><input class="form-control" id="form-file" type="file" name="upload" <?php echo $disabled; ?> required></td> </tr>
                    </table>
                    <div class="text-center mt-3">
                        <input class="btn btn-lg btn-primary" style="margin-right: 50px;" type="submit" name="Submit" value="Daftar" <?php echo $disabled; ?>>
                        <input class="btn btn-lg btn-secondary" type="button" name="batal" onclick="window.location.href='index.php';" value="Batal"></div>
                </form>
            </fieldset>
            <?php echo $message; ?>
        </main>
        <footer class="bg-dark text-white py-2 text-center fixed-bottom">
            <p>&copy; 2025 Beasiswa JWD. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script>
            // Logika untuk memindahkan kursor jika IPK > 3
            document.addEventListener('DOMContentLoaded', function() {
                const ipkInput = document.querySelector('input[name="ipk"]');
                const jenisBeasiswaSelect = document.querySelector('select[name="jenis_beasiswa"]');

                if (parseFloat(ipkInput.value) >= 3) { //
                    jenisBeasiswaSelect.focus();
                }
            });
        </script>
    </body>
</html>
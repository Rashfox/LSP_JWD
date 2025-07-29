<!-- 
    Author  : Rizki Fajar Purnomo
    Version : 1.0 
-->
<?php
// functions.php

// Fungsi untuk menyimpan data pendaftaran ke database
function simpanPendaftaran($conn, $data, $file_info) {// $conn adalah koneksi PDO, $data adalah array berisi data pendaftaran, dan $file_info adalah informasi file yang diupload
    $nama = $data['nama'];
    $email = $data['email'];
    $nohp = $data['nohp'];
    $semester = $data['semester'];
    $ipk = $data['ipk'];
    $jenis_beasiswa = $data['jenis_beasiswa'];
    $nama_berkas = $file_info['berkas']; // Nama berkas yang diupload
    $path_berkas = $file_info['path_berkas'];
    $status_ajuan = 'Belum diverifikasi'; // Default status

    try {
        // Siapkan query untuk menyimpan data pendaftaran
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("INSERT INTO pendaftaran (nama, email, nohp, semester, ipk, jenis_beasiswa, berkas, path_berkas, status_ajuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nama, $email, $nohp, $semester, $ipk, $jenis_beasiswa, $nama_berkas, $path_berkas, $status_ajuan]); // Eksekusi query dengan data yang sudah disiapkan
        return $conn->lastInsertId(); // Mengembalikan ID pendaftaran yang baru
    } catch (PDOException $e) {
        throw new Exception("Gagal menyimpan data ke database: " . $e->getMessage());
    }
}

// Fungsi untuk mengelola upload file
function handleFileUpload($file, $upload_dir) {
    $nama_berkas = null; // Inisialisasi variabel untuk menyimpan nama berkas
    $path_berkas = null; // Inisialisasi variabel untuk menyimpan path berkas
    $message = '';

    if (isset($file) && $file['error'] == UPLOAD_ERR_OK) { // Cek apakah file berhasil diupload
        $file_tmp_name = $file['tmp_name']; // Ambil nama file sementara
        // Validasi ekstensi file
        $allowed_extensions = ['pdf', 'docx', 'jpg', 'png']; // Daftar ekstensi yang diizinkan
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION); // Ambil ekstensi file
        if (!in_array($file_extension, $allowed_extensions)) { // Cek apakah ekstensi file diizinkan
            // Jika tidak diizinkan, kembalikan pesan error
            return ['berkas' => null, 'path_berkas' => null, 'message' => '<div class="alert alert-danger mt-3" role="alert">Ekstensi file tidak diizinkan. Hanya file dengan ekstensi ' . 
            implode(', ', $allowed_extensions) . ' yang diperbolehkan.</div>'];
        }
        $file_name = basename($file['name']); // Ambil nama file asli
        $file_path = $upload_dir . $file_name; // Tentukan path lengkap untuk menyimpan file

        if (move_uploaded_file($file_tmp_name, $file_path)) { // Pindahkan file dari direktori sementara ke direktori upload
            $nama_berkas = $file_name; // Simpan nama berkas
            $path_berkas = $file_path; // Simpan path berkas
            // Kembalikan pesan sukses
            $message = '<div class="alert alert-success mt-3" role="alert">Berkas berhasil diupload: ' . htmlspecialchars($file_name) . '</div>';
        } else {
            $message = '<div class="alert alert-danger mt-3" role="alert">Gagal mengupload berkas.</div>';
        }
    } else if (isset($file) && $file['error'] != UPLOAD_ERR_NO_FILE) { // Jika ada error saat upload
        // Kembalikan pesan error sesuai dengan kode error upload
        $message = '<div class="alert alert-danger mt-3" role="alert">Error upload berkas: ' . $file['error'] . '</div>';
    }
    return ['berkas' => $nama_berkas, 'path_berkas' => $path_berkas, 'message' => $message];
}

// Fungsi untuk mendapatkan data pendaftaran berdasarkan ID atau semua data dengan search
function getDataPendaftaran($conn, $id = null, $search_query = null) {
    $pendaftaran_list = [];
    $message = '';

    if ($id && !$search_query) { // Jika ada ID tapi tidak ada pencarian
        try {
            $stmt = $conn->prepare("SELECT * FROM pendaftaran WHERE id = ?");
            $stmt->execute([$id]); // Menggunakan parameter untuk menghindari SQL Injection
            // Ambil satu hasil karena ID unik
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil data pendaftaran berdasarkan ID
            if ($result) { // Jika data ditemukan
                $pendaftaran_list[] = $result; // Masukkan hasil ke dalam array
            } else { // Jika tidak ditemukan, kosongkan array
                $message = '<div class="alert alert-warning mt-3" role="alert">Data pendaftaran tidak ditemukan.</div>';
            }
        } catch (PDOException $e) { // Jika terjadi error saat mengambil data
            $message = '<div class="alert alert-danger mt-3" role="alert">Gagal mengambil data dari database: ' . $e->getMessage() . '</div>';
        }
    } else { // Jika tidak ada ID atau ada pencarian
        $sql = "SELECT * FROM pendaftaran";
        $params = []; // Inisialisasi parameter untuk query

        if ($search_query) {
            $sql .= " WHERE nama LIKE ? OR email LIKE ? OR jenis_beasiswa LIKE ?";
            $params = ["%$search_query%", "%$search_query%", "%$search_query%"]; // Mencari di kolom nama, email, dan jenis_beasiswa
        }
        $sql .= " ORDER BY tanggal_daftar DESC"; // Urutkan dari terbaru

        try {
            $stmt = $conn->prepare($sql); // Siapkan query
            // Eksekusi query dengan parameter pencarian jika ada
            $stmt->execute($params);
            $pendaftaran_list = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil
            if (empty($pendaftaran_list) && !empty($search_query)) { // Jika tidak ada hasil pencarian
                $message = '<div class="alert alert-info mt-3" role="alert">Tidak ditemukan data pendaftaran dengan kata kunci "' . htmlspecialchars($search_query) . '".</div>';
            } else if (empty($pendaftaran_list)) { // Jika tidak ada data sama sekali
                $message = '<div class="alert alert-info mt-3" role="alert">Belum ada data pendaftaran.</div>';
            }
        } catch (PDOException $e) { // Jika terjadi error saat mengambil data
            $message = '<div class="alert alert-danger mt-3" role="alert">Gagal mengambil data dari database: ' . $e->getMessage() . '</div>';
        }
    }
    return ['list' => $pendaftaran_list, 'message' => $message]; // Kembalikan array berisi daftar pendaftaran dan pesan
}
?>
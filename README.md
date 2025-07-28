<div align="left" style="position: relative;">
<img src="https://raw.githubusercontent.com/PKief/vscode-material-icon-theme/ec559a9f6bfd399b82bb44393651661b08aaf7ba/icons/folder-markdown-open.svg" align="right" width="30%" style="margin: -20px 0 0 20px;">
<h1>LSP_JWD.GIT</h1>
<p align="left">
    <em><code>❯ Sistem Pendaftaran dan Pengelolaan Data Peserta Beasiswa Berbasis Web</code></em>
</p>
<p align="left">
    <img src="https://img.shields.io/github/license/Rashfox/LSP_JWD.git?style=flat&logo=opensourceinitiative&logoColor=white&color=0080ff" alt="license">
    <img src="https://img.shields.io/github/last-commit/Rashfox/LSP_JWD.git?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
    <img src="https://img.shields.io/github/languages/top/Rashfox/LSP_JWD.git?style=flat&color=0080ff" alt="repo-top-language">
    <img src="https://img.shields.io/github/languages/count/Rashfox/LSP_JWD.git?style=flat&color=0080ff" alt="repo-language-count">
</p>
<p align="left">Built with the tools and technologies:</p>
<p align="left">
    <img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">
</p>
</div>
<br clear="right">

<details><summary>Table of Contents</summary>

- [📍 Overview](#-overview)
- [👾 Features](#-features)
- [📁 Project Structure](#-project-structure)
  - [📂 Project Index](#-project-index)
  - [🗄️ Database Schema](#-database-schema)
- [🚀 Getting Started](#-getting-started)
  - [☑️ Prerequisites](#-prerequisites)
  - [⚙️ Installation](#-installation)
  - [🤖 Usage](#🤖-usage)
  - [🧪 Testing](#🧪-testing)
- [📌 Project Roadmap](#-project-roadmap)
- [🔰 Contributing](#-contributing)
- [🎗 License](#-license)
- [🙌 Acknowledgments](#-acknowledgments)

</details>
<hr>

## 📍 Overview

LSP_JWD.GIT adalah aplikasi berbasis web untuk pendaftaran dan pengelolaan data peserta beasiswa. Sistem ini memudahkan proses registrasi, pengelolaan data, serta pelaporan hasil pendaftaran beasiswa secara efisien dan terstruktur. Dengan aplikasi ini, peserta dapat mendaftar beasiswa secara online, mengunggah dokumen persyaratan, dan memantau status pendaftaran mereka.

---

## 👾 Features

- Registrasi peserta beasiswa secara online.
- Upload dokumen pendukung (misal: bukti legalitas, dokumen persyaratan beasiswa).
- Manajemen data peserta (tambah, lihat, edit).
- Rekapitulasi dan tampilan hasil seleksi beasiswa.
- Otentikasi sederhana untuk akses data.
- Struktur kode modular dan mudah dikembangkan.

---

## 📁 Project Structure

```sh
└── LSP_JWD.git/
    ├── README.md
    ├── connect.php
    ├── daftar.php
    ├── functions.php
    ├── index.php
    ├── lihat.php
    ├── result.php
    ├── uploads
    └── beasiswa.sql
```

### 📂 Project Index
<details open>
    <summary><b><code>LSP_JWD.GIT/</code></b></summary>
    <details>
        <summary><b>__root__</b></summary>
        <blockquote>
            <table>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/functions.php'>functions.php</a></b></td>
                <td>Berisi fungsi-fungsi utilitas untuk pengolahan data, validasi, dan operasi database.</td>
            </tr>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/index.php'>index.php</a></b></td>
                <td>Halaman utama aplikasi, menampilkan menu dan ringkasan data peserta beasiswa.</td>
            </tr>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/lihat.php'>lihat.php</a></b></td>
                <td>Menampilkan detail data peserta yang telah mendaftar beasiswa.</td>
            </tr>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/connect.php'>connect.php</a></b></td>
                <td>Konfigurasi koneksi ke database MySQL.</td>
            </tr>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/result.php'>result.php</a></b></td>
                <td>Menampilkan hasil seleksi peserta beasiswa secara terstruktur.</td>
            </tr>
            <tr>
                <td><b><a href='https://github.com/Rashfox/LSP_JWD.git/blob/master/daftar.php'>daftar.php</a></b></td>
                <td>Formulir pendaftaran peserta beasiswa.</td>
            </tr>
            <tr>
                <td><b>beasiswa.sql</b></td>
                <td>File SQL untuk membuat dan menginisialisasi database beasiswa.</td>
            </tr>
            </table>
        </blockquote>
    </details>
</details>

### 🗄️ Database Schema

File `beasiswa.sql` berisi query untuk membuat tabel utama yang dibutuhkan aplikasi. Berikut contoh isi file tersebut:

```sql
-- beasiswa.sql

CREATE DATABASE IF NOT EXISTS beasiswa_db;
USE beasiswa_db;

CREATE TABLE IF NOT EXISTS peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    dokumen VARCHAR(255),
    status ENUM('pending', 'diterima', 'ditolak') DEFAULT 'pending',
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan tabel lain jika diperlukan, misal tabel admin atau log aktivitas.
```

---

## 🚀 Getting Started

### ☑️ Prerequisites

Before getting started with LSP_JWD.git, ensure your runtime environment meets the following requirements:

- **Programming Language:** PHP >= 7.0
- **Web Server:** Apache/Nginx (rekomendasi: XAMPP/Laragon/LAMP)
- **Database:** MySQL/MariaDB

### ⚙️ Installation

Install LSP_JWD.git using one of the following methods:

**Build from source:**

1. Clone the LSP_JWD.git repository:
```sh
❯ git clone https://github.com/Rashfox/LSP_JWD.git
```

2. Navigate to the project directory:
```sh
❯ cd LSP_JWD.git
```

3. Install the project dependencies:

Tidak ada dependensi eksternal, pastikan PHP dan MySQL sudah terpasang.

4. Import database schema:

Import file `beasiswa.sql` ke MySQL Anda, misal menggunakan phpMyAdmin atau command line:

```sh
mysql -u root -p < beasiswa.sql
```

### 🤖 Usage
Jalankan aplikasi dengan menaruh folder `LSP_JWD.git` di dalam direktori web server (misal: `htdocs` pada XAMPP), lalu akses melalui browser:

```
http://localhost/LSP_JWD.git/
```

### 🧪 Testing
Untuk pengujian, lakukan registrasi peserta beasiswa dan cek data pada halaman utama serta hasil seleksi. Tidak ada test suite otomatis, pengujian dilakukan secara manual melalui browser.

---
## 📌 Project Roadmap

- [X] **`Task 1`**: <strike>Implementasi fitur pendaftaran beasiswa online.</strike>
- [ ] **`Task 2`**: Implementasi fitur seleksi dan pengumuman hasil beasiswa.
- [ ] **`Task 3`**: Penambahan fitur notifikasi email untuk peserta.

---

## 🔰 Contributing

- **💬 [Join the Discussions](https://github.com/Rashfox/LSP_JWD.git/discussions)**: Share your insights, provide feedback, or ask questions.
- **🐛 [Report Issues](https://github.com/Rashfox/LSP_JWD.git/issues)**: Submit bugs found or log feature requests for the `LSP_JWD.git` project.
- **💡 [Submit Pull Requests](https://github.com/Rashfox/LSP_JWD.git/blob/main/CONTRIBUTING.md)**: Review open PRs, and submit your own PRs.

<details closed>
<summary>Contributing Guidelines</summary>

1. **Fork the Repository**: Start by forking the project repository to your github account.
2. **Clone Locally**: Clone the forked repository to your local machine using a git client.
   ```sh
   git clone https://github.com/Rashfox/LSP_JWD.git
   ```
3. **Create a New Branch**: Always work on a new branch, giving it a descriptive name.
   ```sh
   git checkout -b new-feature-x
   ```
4. **Make Your Changes**: Develop and test your changes locally.
5. **Commit Your Changes**: Commit with a clear message describing your updates.
   ```sh
   git commit -m 'Implemented new feature x.'
   ```
6. **Push to github**: Push the changes to your forked repository.
   ```sh
   git push origin new-feature-x
   ```
7. **Submit a Pull Request**: Create a PR against the original project repository. Clearly describe the changes and their motivations.
8. **Review**: Once your PR is reviewed and approved, it will be merged into the main branch. Congratulations on your contribution!
</details>

<details closed>
<summary>Contributor Graph</summary>
<br>
<p align="left">
   <a href="https://github.com{/Rashfox/LSP_JWD.git/}graphs/contributors">
      <img src="https://contrib.rocks/image?repo=Rashfox/LSP_JWD.git">
   </a>
</p>
</details>

---

## 🎗 License

This project is protected under the [MIT](https://choosealicense.com/licenses/mit/) License. For more details, refer to the [LICENSE](https://choosealicense.com/licenses/mit/) file.

---

## 🙌 Acknowledgments

- Terima kasih kepada seluruh kontributor, penguji, dan pihak yang telah memberikan masukan dalam pengembangan aplikasi ini.
- Inspirasi dari berbagai sumber open source dan komunitas pengembang PHP.

---
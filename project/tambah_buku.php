<?php
session_start();

if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="tambah_buku.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600&display=swap" rel="stylesheet">
    <title>Upload Buku ke Database</title>
</head>

<body>
    <nav>
        <h1 class="logo"><a href="?page=home" style="color: black;">Perpustakaan</a></h1>
        <input type="text" class="search" placeholder="Search" maxlength="50">
        <img src=" asset/image/menu-icon.svg" alt="Menu" class="card-profile">
    </nav>
    <div class="list-buku">
        <div class="hidden sidebar">
            <div class="identitas">
                <div class="profile">
                    <img src="asset\image\profile.webp" alt="foto profile">
                </div>
                <div class="nama">
                    <p><?= $id_user ?></p>
                    <p><?= $nama_user ?></p><br>
                </div>
            </div>
            <div class="link">
                <a href="dashboard.php">Home</a>
                <a href="daftarbuku.php">daftar buku</a>
                <?php
                if ($level == '1') : ?>
                    <a href="tambah_buku.php">tambah buku</a>
                    <a href="pinjam.php">List Pinjam</a>
                <?php endif; ?>
                <?php
                if ($level == '2') : ?>
                    <a href="">Pinjam</a> <br>
                <?php endif; ?>
                <a class="logout" href="logout.php">logout</a>
            </div>
        </div>
        <h2 class="judul-upload">Upload Gambar ke Database</h2>
        <form action="upload_buku.php" method="post" enctype="multipart/form-data">
            <div class="label">
                <label>Judul Buku:</label>
                <input type="text" name="judul_buku"><br>
            </div>

            <div class="label">
                <label>Pengarang:</label>
                <input type="text" name="pengarang"><br>
            </div>

            <div class="label">
                <label>Penerbit:</label>
                <input type="text" name="penerbit"><br>
            </div>

            <div class="label">
                <label>Tahun Terbit:</label>
                <input type="number" name="tahun_terbit"><br>
            </div>

            <div class="label">
                <label>Gambar:</label>
                <input type="file" name="gambar"><br>
            </div>

            <div class="label">
                <label>halaman:</label>
                <input type="number" name="halaman"><br>
            </div>

            <div class="label">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="label">
                <label>Stok:</label>
                <input type="number" name="stok_buku"><br>
            </div>

            <div class="btn">
                <input type="submit" name="submit" value="Upload">
            </div>

        </form>
        <script>
            const cardProfile = document.querySelector(".card-profile");
            const sidebar = document.querySelector(".sidebar");

            cardProfile.addEventListener("click", () => {
                // Cek apakah elemen sidebar ditampilkan atau disembunyikan
                if (sidebar.classList.contains("hidden")) {
                    // Menghapus kelas 'hidden' dari elemen sidebar
                    sidebar.classList.remove("hidden");
                } else {
                    // Menambahkan kelas 'hidden' kembali ke elemen sidebar jika sudah ditampilkan sebelumnya
                    sidebar.classList.add("hidden");
                }
            });
        </script>
</body>

</html>
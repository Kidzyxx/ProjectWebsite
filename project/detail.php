<?php
include "koneksi.php"; // file koneksi ke database
session_start();

if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_buku WHERE id_buku = $id";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$deskripsi = $row['deskripsi'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600&display=swap" rel="stylesheet">
    <title>Detail Buku</title>
</head>

<body>
    <nav>
        <h1 class="logo"><a href="?page=home" style="color: black;">Perpustakaan</a></h1>
        <input type="text" class="search" placeholder="Search" maxlength="50">
        <img src=" asset/image/menu-icon.svg" alt="Menu" class="card-profile">
    </nav>
    <div class="container-detail-buku">
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
                    <a href="#">List Pinjam</a>
                <?php endif; ?>
                <?php
                if ($level == '2') : ?>
                    <a href="">Pinjam</a> <br>
                <?php endif; ?>
                    <a href="logout.php">logout</a>
            </div>
        </div>
        <div class="content-detail-buku">
            <div class="detail-foto-buku">
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" />' . "<br>"; ?>
                <a href="pinjambuku.php?id_buku=<?php echo $row['id_buku'];?>">Pinjam</a>
            </div>
            <div class="detail-keterangan">
                <p class="label">Judul</p>
                <h1 class="judul-buku"><?php echo $row['judul_buku']; ?></h1>
                <p class="label">Sinopsis Buku</p>
                <p class="deskripsi"><?php echo nl2br($deskripsi) ?></p>
                <div class="detail">
                    <div>
                        <p class="label">Tahun Terbit</p>
                        <p class="tahun-terbit"><?php echo $row['tahun_terbit']; ?></p>
                    </div>
                    <div>
                        <p class="label">Pengarang</p>
                        <p class="pengarang"><?php echo $row['pengarang']; ?></p>
                    </div>
                    <div>
                        <p class="label">Jumlah Halaman</p>
                        <p class="halaman"><?php echo $row['halaman']; ?></p>
                    </div>
                    <div>
                        <p class="label">Penerbit</p>
                        <p class="penerbit"><?php echo $row['penerbit']; ?></p>
                    </div>
                </div>
            </div>
            <?php
            if ($level == '2') : ?>
                <a href="">Pinjam Buku</a>
            <?php endif;
            ?>
            <a href="dashboard.php">Kembali</a>
        </div>
    </div>
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
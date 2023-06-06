<?php
session_start();

if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}

// Include file koneksi ke database
include "koneksi.php";

// Proses pencarian
$kata_kunci = "";
if (isset($_GET['kata_kunci'])) {
    $kata_kunci = $_GET['kata_kunci'];
    // Query pencarian buku berdasarkan judul
    $query = "SELECT * FROM tbl_buku WHERE judul_buku LIKE '%$kata_kunci%'";
    $result = mysqli_query($koneksi, $query);
} else {
    // Query semua buku
    $query = "SELECT * FROM tbl_buku";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Perpustakaan</title>
</head>

<body>
    <nav class="navbar">
        <h1 class="logo"><a href="?page=home" style="color: black;">Perpustakaan</a></h1>
        <form action="searching.php" method="GET" style="width: 500px; display: flex;">
            <input class="search" type="text" name="kata_kunci" placeholder="Search" maxlength="50">
            <button type="submit">Search</button>
        </form>
        <img src="asset/image/menu-icon.svg" alt="Menu" class="card-profile">
    </nav>
    <div id="wrapper">
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
                    <a href="pinjam.php">Pinjam</a> <br>
                <?php endif; ?>
                <a class="logout" href="logout.php">logout</a>
            </div>
        </div>
        <div id="content">
            <div class="tbl_buku">
                <h1 class="head">Popular Books</h1>
                <div class="body_content">
                    <div class="items">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <a href="detail.php?id=<?php echo $row['id_buku']; ?>">
                                    <div class="card">
                                        <?php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '"/>';
                                        ?>
                                        <div class="judul-buku"><?= $row['judul_buku'] ?></div>
                                    </div>
                                </a>
                        <?php
                            }
                        } else {
                            echo "<p>Buku tidak ada</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cardProfile = document.querySelector(".card-profile");
        const sidebar = document.querySelector(".sidebar");

        cardProfile.addEventListener("click", () => {
            if (sidebar.classList.contains("hidden")) {
                sidebar.classList.remove("hidden");
            } else {
                sidebar.classList.add("hidden");
            }
        });
    </script>
</body>

</html>
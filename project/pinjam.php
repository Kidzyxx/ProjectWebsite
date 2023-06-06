<?php
session_start();

if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="daftar_buku.css">
    <title>Daftar Pinjam</title>
</head>

<body>
    <nav class="navbar ">
        <h1 class="logo"><a href="?page=home" style="color: black;">Perpustakaan</a></h1>
        <form action="searching.php" method="GET" style="width: 500px; display: flex;">
            <input class="search" type="text" name="kata_kunci" placeholder="Search" maxlength="50">
            <button type="submit">Search</button>
        </form>
        <img src=" asset/image/menu-icon.svg" alt="Menu" class="card-profile">
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
                <h1 class="head">Daftar Pinjam</h1>
                <div class="content">
                    <?php
                    // Koneksi ke database
                    include_once "koneksi.php";

                    // Query untuk mengambil data buku dari tabel
                    $sql = "SELECT * FROM tbl_peminjaman INNER JOIN tbl_user ON tbl_peminjaman.id_user = tbl_user.id_user INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku";
                    $result = mysqli_query($koneksi, $sql);
                    ?>
                    <table class="tabel">
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Tanggal Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        foreach ($result as $data) :
                        ?>
                            <tr>
                                <td><?php echo $data['id_peminjaman'] ?></td>
                                <td><?php echo $data['nama_user'] ?></td>
                                <td><?php echo $data['judul_buku'] ?></td>
                                <td><?php echo $data['tgl_peminjaman'] ?></td>
                                <td><?php echo ($data['tgl_pengembalian'] == '') ? 'Belum dikembalikan' : $data['tgl_pengembalian'] ?></td>
                                <td><?php echo $data['tgl_deadline'] ?></td>
                                <td><?php echo $data['status'] ?></td>
                                <td>
                                    <a href="pengembalianbuku.php?id_peminjaman=<?= $data['id_peminjaman']; ?>">Mengembalikan Buku</a>
                                    <a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="hapus_pinjam.php?id_peminjaman=<?= $data['id_peminjaman']; ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        endforeach
                        ?>
                    </table>
                </div>
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
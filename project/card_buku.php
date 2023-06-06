<?php
// Koneksi ke database
include_once "koneksi.php";
// Query untuk mengambil data buku dari tabel
$sql = "SELECT * FROM tbl_buku";
$result = mysqli_query($koneksi, $sql);

// Looping untuk menampilkan data buku dalam bentuk card
while ($row = mysqli_fetch_assoc($result)) : ?>
    <a href="detail.php?id=<?php echo $row['id_buku']; ?>">
        <div class="card">
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '"/>';
            ?>
            <div class="judul-buku"><?= $row['judul_buku'] ?></div>
        </div>
    </a>
<?php endwhile; ?>
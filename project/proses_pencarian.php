<?php
require "./koneksi.php";

if (isset($_GET['kata_kunci'])) {
    $kata_kunci = $_GET['kata_kunci'];

    // Query untuk melakukan pencarian berdasarkan judul puisi
    $query = "SELECT * FROM tbl_buku WHERE judul_buku LIKE '%$judul_buku%'";
    $result = mysqli_query($koneksi, $sql);

    // Redirect ke halaman hasil pencarian dan mengirim hasil query sebagai parameter URL
    header("Location: hasil_pencarian.php?hasil=" . urlencode($puisi_query));
    exit();
}

<?php
// Koneksi ke database
include_once "koneksi.php";

// Proses upload gambar
if (isset($_POST["submit"])) {
    $judul_buku = $_POST["judul_buku"];
    $pengarang = $_POST["pengarang"];
    $penerbit = $_POST["penerbit"];
    $tahun_terbit = $_POST["tahun_terbit"];
    $halaman = $_POST["halaman"];
    $deskripsi = $_POST["deskripsi"];
    $stok_buku = $_POST["stok_buku"];

    $nama_file = $_FILES["gambar"]["name"];
    $tipe_file = $_FILES["gambar"]["type"];
    $ukuran_file = $_FILES["gambar"]["size"];
    $tmp_file = $_FILES["gambar"]["tmp_name"];

    // Baca file gambar
    $fp = fopen($tmp_file, 'r');
    $gambar = fread($fp, filesize($tmp_file));
    $gambar = mysqli_real_escape_string($koneksi, $gambar);
    fclose($fp);

    // Masukkan data buku ke dalam tabel
    $sql = "INSERT INTO tbl_buku (judul_buku, pengarang, penerbit, tahun_terbit, gambar, halaman, deskripsi,stok_buku)
            VALUES ('$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', '$gambar','$halaman','$deskripsi','$stok_buku')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
        alert('Berhasil manambah Buku')
        window.location.href='dashboard.php'
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

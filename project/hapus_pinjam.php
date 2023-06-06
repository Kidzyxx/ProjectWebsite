<?php
include 'koneksi.php';
$id_peminjaman = $_GET['id_peminjaman'];
$sql = "DELETE FROM tbl_peminjaman WHERE id_peminjaman = '$id_peminjaman'";
$delete = mysqli_query($koneksi, $sql);
if ($delete) {
    echo "<script>
        alert('data berhasil dihapus')
        window.location.href='dashboard.php'
    </script>";
}
<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}
$id_peminjaman = $_GET['id_peminjaman'];
$data_peminjaman = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku WHERE tbl_peminjaman.id_peminjaman = '$id_peminjaman'"));

if (isset($_POST['submit'])) {
    $judul_buku = $_POST['judul_buku'];
    $id_user = $_POST['id_user'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_deadline = $_POST['tgl_deadline'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $denda = $_POST['denda'];
    $status = 'Sudah Dikembalikan';

    $query = "UPDATE tbl_peminjaman SET tgl_pengembalian='$tgl_pengembalian', denda='$denda', status='$status' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Berhasil Mengembalikan Buku');
        window.location.href='dashboard.php';
        </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengembalian</title>
</head>

<body>
    <form method="POST">
        <label for="id_buku">Judul buku</label>
        <input type="text" name="judul_buku" value="<?= $data_peminjaman['judul_buku'] ?>" readonly><br>
        <label for="id_user">Id User</label>
        <input type="text" name="id_user" value="<?= $data_peminjaman['id_user'] ?>" readonly><br>
        <label for="tgl_peminjaman">Tanggal Peminjaman</label>
        <input type="date" name="tgl_peminjaman" value="<?= $data_peminjaman['tgl_peminjaman'] ?>" readonly><br>
        <label for="tgl_deadline">Tanggal Deadline</label>
        <input type="date" name="tgl_deadline" id="tgl_deadline" value="<?= $data_peminjaman['tgl_deadline'] ?>" readonly><br>
        <label for="tgl_peminjaman">Tanggal Pengembalian</label>
        <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>" readonly><br>
        <label for="denda">Denda</label>
        <input type="text" name="denda" id="denda" readonly><br>
        <button type="submit" name="submit">Kembalikan Buku</button>
    </form>


    <script>
        function calculateFine() {
            var deadlineDate = new Date(document.getElementById("tgl_deadline").value);
            var returnDate = new Date(document.getElementById("tgl_pengembalian").value);

            var fine = 0;

            if (returnDate > deadlineDate) {
                var timeDiff = returnDate.getTime() - deadlineDate.getTime();
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calculate the difference in days

                fine = diffDays * 1000; // Fine of 1000 for each day the return date exceeds the deadline
            }

            document.getElementById("denda").value = fine;
        }

        // Calculate fine when the page loads
        window.addEventListener("DOMContentLoaded", calculateFine);

        // Calculate fine when tgl_pengembalian field changes
        document.getElementById("tgl_pengembalian").addEventListener("change", calculateFine);
    </script>
</body>

</html>
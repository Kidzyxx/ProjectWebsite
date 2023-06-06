<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION["nama_user"])) {
    $nama_user =   $_SESSION["nama_user"];
    $id_user = $_SESSION["id_user"];
    $level = $_SESSION["level"];
}
$id_buku = $_GET['id_buku'];
$sql = "SELECT * FROM tbl_buku WHERE id_buku = '$id_buku'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
// insert data pinjam
// insert data pinjam
if (isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_POST['id_user'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_deadline = $_POST['tgl_deadline'];
    $status = 'sedang dipinjam';

    $query = "INSERT INTO tbl_peminjaman (id_user, id_buku, tgl_peminjaman, tgl_deadline, status) VALUES ('$id_user', '$id_buku', '$tgl_peminjaman', '$tgl_deadline', '$status')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Berhasil Meminjam Buku');
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
    <title>Halaman Pinjam</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="id_buku" value="<?= $id_buku ?>" hidden>
        <label for="id_buku">Judul buku</label>
        <input type="text" name="judul_buku" value="<?= $row['judul_buku'] ?>"><br>
        <label for="id_user">Id User</label>
        <input type="text" name="id_user" value="<?= $id_user ?>"><br>
        <label for="tgl_peminjaman">Tanggal Peminjaman</label>
        <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" onchange="setDeadline()"><br>
        <label for="tgl_deadline">Tanggal Deadline:</label>
        <span id="tgl_deadline_value"></span>
        <input type="hidden" name="tgl_deadline" id="tgl_deadline_hidden"><br>
        <button type="submit" name="submit">Pinjam</button>
    </form>

    <script>
        function setDeadline() {
            var borrowingDate = new Date(document.getElementById("tgl_peminjaman").value);
            var deadlineDate = new Date(borrowingDate.getTime() + (7 * 24 * 60 * 60 * 1000)); // Adding 7 days in milliseconds

            var formattedDeadline = formatDate(deadlineDate);

            var deadlineValue = document.getElementById("tgl_deadline_value");
            deadlineValue.textContent = formattedDeadline;

            var hiddenInput = document.getElementById("tgl_deadline_hidden");
            hiddenInput.value = deadlineDate.toISOString().split('T')[0];
        }

        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            // Add leading zeros if necessary
            day = day < 10 ? "0" + day : day;
            month = month < 10 ? "0" + month : month;

            return day + "/" + month + "/" + year;
        }
    </script>
</body>

</html>
<?php
session_start();
include_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mengambil data dari form login
    $nama_user = $_POST["nama_user"];
    $password = $_POST["password"];

    // mencari data pengguna pada tabel user
    $sql = "SELECT * FROM tbl_user WHERE nama_user = '$nama_user'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // memverifikasi password
        if (password_verify($password, $row["password"])) {
            // menyimpan informasi login ke session
            $_SESSION["id_user"] = $row["id_user"];
            $_SESSION["nama_user"] = $row["nama_user"];
            $_SESSION["level"] = $row["level"];

            // redirect ke halaman utama setelah login
            header("Location: dashboard.php");
            exit();
        } else {
            // jika password tidak cocok
            // header("Location: login.php");
            echo "<script>alert('password salah')</script>";
        }
    } else {
        // jika nama_user tidak ditemukan
        echo "<script>alert('nama atau password salah !!!')</script>";
        header("Location: login.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class='login'>
        <form method="post">
        <h2>Login</h2>
            <label>Nama:</label><br>
            <input type="text" name="nama_user"><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br>
            <input type="submit" value="Login" name="btnregistrasi"><br><br>
            <a href="registrasi.php">Daftar Sebagai Anggota</a>
        </form>
    </div>
    </div>
</body>
</html>

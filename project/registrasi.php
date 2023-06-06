<?php
require_once 'koneksi.php';
if (isset($_POST['btnregistrasi'])) {
    $nama_user = $_POST['nama_user'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $notelpon = $_POST['notelpon'];
    $checkemail = mysqli_query($koneksi, "select * from tbl_user where email='$email'");
    if (mysqli_num_rows($checkemail) > 0) {
        echo "<script>
        alert('email sudah digunakan')
        window.history.back()
        </script>";
    }

    if ($password !== $repassword) {
        echo "<script>
        alert('password tidak sama dengan repassword')
        window.history.back()
        </script>";
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = mysqli_query($koneksi, "insert into tbl_user values ('', '$nama_user','$email','$password','$email','$notelpon', '2') ");
    if ($query) {
        echo "<script>
        alert('Registrasi Berhasil')
        window.location.href='login.php'
        </script>";
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
        <div class='registrasi'>
            <form method="post">
                <h2>Registrasi</h2>
                <label>nama_user:</label><br>
                <input type="text" name="nama_user"><br>
                <label>Password:</label><br>
                <input type="password" name="password"><br>
                <label>Re-Password:</label><br>
                <input type="password" name="repassword"><br>
                <label>Alamat:</label><br>
                <input type="text" name="alamat"><br>
                <label>e-mail:</label><br>
                <input type="email" name="email"><br>
                <label>No-Telpon:</label><br>
                <input type="text" name="notelpon"><br>
                <br><br>

                <input type="submit" value="Daftar" name="btnregistrasi"><br><br>
                <a href="login.php">Login</a>
            </form>
</body>

</html>
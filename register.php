<?php
include "service/database.php";
session_start();

$register_message = "";

if (isset($_SESSION["is_Login"])) {
    header("location: dashboard.php");
}

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash("sha256", $password);

    try {
        if (isset($_POST["register"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "INSERT INTO users (username, password) VALUES ('$username','$hash_password')";

            if ($db->query($sql)) {
                $register_message = "Daftar Akun Berhasil, Silahkan Login";
            } else {
                $register_message = "Daftar Akun Gagal, Silahkan Coba Lagi";
            }
        }
    } catch (mysqli_sql_exception) {
        $register_message = "username sudah ada, silahkan ganti yang lain";
    }
    $db->close();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "layout/header.html" ?>
    <i>
        <h3>Daftar Akun</h3>
    </i>
    <?= $register_message ?>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    <?php include "layout/footer.html" ?>
</body>

</html>
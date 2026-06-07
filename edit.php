<?php
session_start();
include "koneksi.php";

if(
    !isset($_SESSION['nama']) ||
    $_SESSION['nama'] != "admin"
){
    header("Location: dashboard.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE id='$id'"
);

if(mysqli_num_rows($query)==0){
    header("Location: dashboard.php");
    exit;
}

$user = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,
        "UPDATE users
         SET
         nama='$nama',
         password='$password'
         WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>

<style>

body{
    font-family:Arial;
    font-size:12px;
}

input{
    width:200px;
}

</style>

</head>
<body>
 
<h3>Edit Data Pengguna</h3>

<form method="POST">

Nama Pengguna

<br>

<input
type="text"
name="nama"
value="<?= $user['nama']; ?>"
required>

<br><br>

Password Baru

<br>

<input
type="password"
name="password"
required>

<br><br>

<button
type="submit"
name="update">

Simpan Perubahan

</button>

</form>

</body>
</html>
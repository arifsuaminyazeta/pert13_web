<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['nama'])){
    header("Location: auth.php");
    exit;
}

if(isset($_GET['hapus'])){

    if($_SESSION['nama'] != "admin"){
        die("Akses ditolak");
    }

    $id = (int)$_GET['hapus'];

    mysqli_query(
        $conn,
        "DELETE FROM users WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>

<?php if($_SESSION['nama']=="admin"): ?>

<h3>Selamat Datang, admin!</h3>

<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<hr>

<b>Menu Admin: Kelola Pengguna</b>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php

$data = mysqli_query(
    $conn,
    "SELECT * FROM users"
);

while($row=mysqli_fetch_assoc($data)):
?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['nama']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id']; ?>">
Edit
</a>

<a href="dashboard.php?hapus=<?= $row['id']; ?>">
Hapus
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

<?php else: ?>

<h3>
Selamat Datang, <?= $_SESSION['nama']; ?>!
</h3>

<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<?php endif; ?>

</body>
</html>
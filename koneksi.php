<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pert13_web"
);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}
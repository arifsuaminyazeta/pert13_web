<?php
session_start();
include "koneksi.php";

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE nama='$nama'"
    );

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
                alert('Nama sudah digunakan');
              </script>";

    }else{

        mysqli_query(
            $conn,
            "INSERT INTO users(nama,password)
             VALUES('$nama','$password')"
        );

        echo "<script>
                alert('Registrasi berhasil');
              </script>";
    }
}

if(isset($_POST['login'])){

    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE nama='$nama'"
    );

    if(mysqli_num_rows($query) == 1){

        $user = mysqli_fetch_assoc($query);

        if(password_verify(
            $password,
            $user['password']
        )){

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
            exit;

        }else{

            echo "<script>
                    alert('Password salah');
                  </script>";
        }

    }else{

        echo "<script>
                alert('User tidak ditemukan');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>

    <style>

        body{
            font-family:Arial;
            margin:40px;
        }

        .container{
            display:flex;
            gap:50px;
        }

        .box{
            border:1px solid #ccc;
            padding:20px;
            width:300px;
        }

        input{
            width:100%;
            padding:8px;
            margin-bottom:10px;
        }

        button{
            width:100%;
            padding:8px;
        }

    </style>

</head>
<body>

<h2>Form Handling & Login</h2>

<div class="container">

    <div class="box">

        <h3>Register</h3>

        <form method="POST">

            <input
                type="text"
                name="nama"
                placeholder="Nama"
                required>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required>

            <button
                type="submit"
                name="register">

                Register

            </button>

        </form>

    </div>

    <div class="box">

        <h3>Login</h3>

        <form method="POST">

            <input
                type="text"
                name="nama"
                placeholder="Nama"
                required>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required>

            <button
                type="submit"
                name="login">

                Login

            </button>

        </form>

    </div>

</div>

</body>
</html>
<?php
session_start();
require_once("connection.php");
$sql= "SELECT * FROM admin";
$result=mysqli_query($conn, $sql);
if(isset($_SESSION["email"])){
  header("Location: crud.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <a href="home.php" class="tengah">Home</a>
    <div class="center">
      <h1>Login Admin</h1>
      <form method="POST" action="login.php">
        <div class="txt_field">
        <input type="" class="form-control" id="email" placeholder="name@example.com" name="email">
        <label for="email">Email address</label>
        </div>
        <div class="txt_field">
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        <label for="password">Password</label>
        </div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Belum buat akun? <a href="register.php">Daftar Sekarang!</a>
        </div>
        <?php

    if ($_POST){
        $user=$_POST["email"];
        $name=$_POST["namaAdmin"];
        $password=$_POST["password"];
        $query="SELECT * FROM admin WHERE email = '".$user."' AND password = '".$password."'LIMIT 1;";
        $result_query=mysqli_query($conn,$query);
        $jumlah_row=mysqli_num_rows($result_query);
        if($jumlah_row > 0){
          $row=mysqli_fetch_assoc($result_query);
          $_SESSION["email"]=$user;
          $_SESSION["namaAdmin"]=$name;
          $_SESSION["password"]=$password;
          header("Location: crud.php");
        }else if($jumlah_row == 0 && $user!=null && $password!=null){
          $message = "Username atau Password anda salah.\\ncoba lagi!";
          echo "<span class='wrong'>Password Salah</span>";
          echo "<script type='text/javascript'>window.alert('$message');</script>";
        }

      }
      
    ?>

    
      </form>
    </div>





    
  </body>
  </html>



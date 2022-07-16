<?php
session_start();
require_once("connection.php");
$sql= "SELECT * FROM admin WHERE email='{$_SESSION['email']}'";
$result=mysqli_query($conn, $sql);

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}elseif (isset($_POST["logout"])){
    session_destroy();
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="crud.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Francois+One&display=swap" rel="stylesheet">
</head>
<body>
    <script>
        AOS.init();
    </script>
    <header>
        <section class="header">
            <nav>
                <a href="home.php">GO WORKOUT!</a>
                <div data-aos="fade-up" class="nav-links">
                    <ul>
                    <li><a href="home.php" class="home">Home</a></li>
                        <li>
                            <form action="crud.php" method="POST">
                            <button type="submit" class="logout" value="logout" name="logout">LOGOUT</button>
                            </form>
                        </li>

                    </ul>
                </div>
            </nav>
        <div data-aos="fade-up"  class="box">
        <section class="kotak">
        <?php 
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<div><b>SELAMAT DATANG</b></div>";
            echo "<div>".$row['namaAdmin']. "</div>";
            echo "<br>";
            echo "Silahkan atur data aplikasi Workout sesuka hatimu!";
            echo "<br><br>";
            echo '<button type="button" class="button"><a href="crudVideo.php">CRUD Video</a></button>';
            echo '<button type="button" class="button"><a href="crudWorkout.php">CRUD Workout</a></button>';
            echo '<button type="button" class="button"><a href="crudInstruktur.php">CRUD Instruktur</a></button>';
            }              
        ?>
        </section>
            <br>
        </div>
        </section>
    </header>


</body>
</html>



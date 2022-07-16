<?php
session_start();
require_once("connection.php");
$sql= "SELECT * FROM instruktur";
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
                <a href="home.html">GO WORKOUT!</a>
                <div data-aos="fade-up" class="nav-links">
                    <ul>
                        <li>
                            <form action="crudInstruktkur.php" method="POST">
                            <button type="submit" class="logout" value="logout" name="logout">LOGOUT</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        <div data-aos="fade-up"  class="box">
            
            <br>
        </div>
        <div class="tableCRUDins" data-aos="fade-up">
            <table border=1>
                <tr>
                    <th>NO</th>
                    <th>Nama Instruktur</th>
                    
                    <th colspan="2">Action</th>
                </tr>
                <?php 
                    $nomor = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nomor++;
                        echo "<tr>";
                        echo "<td>". $nomor. "</td>";
                        echo "<td>".$row['namaInstruktur']. "</td>";
                        echo "<td><a href='editInstruktur.php?id=".$row['kodeInstruktur']."'>Edit</a></td>";
                        echo "<td><a href='deleteInstruktur.php?id=".$row['kodeInstruktur']."'>Delete</a></td>";
                    }
                
                ?>
            </table>
        <div class="tombol">
            <a href="addInstruktur.php" class="add" data-aos="Add Workoutfade-left">Tambahkan Data</a>
        </div>
        <div class="tombol">
            <a href="crud.php" class="add" data-aos="Add Workoutfade-left">Kembali</a>
        </div>
        </div>

        </section>

    </header>


</body>
</html>



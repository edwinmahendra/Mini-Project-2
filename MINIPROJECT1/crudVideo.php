<?php
session_start();
require_once("connection.php");
$sql= "SELECT * FROM video";
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
                            <form action="crud.php" method="POST">
                            <button type="submit" class="logout" value="logout" name="logout">LOGOUT</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        <div data-aos="fade-up"  class="box">
            
            <br>
        </div>
        <div class="tableCRUD" data-aos="fade-up">
            <table border=1>
                <tr>
                    <th>NO</th>
                    <th>Nama Olahraga</th>
                    <th>Nama Instruktur</th>
                    <th>Judul</th>
                    <th>Level</th>
                    <th>Link</th>
                    <th>Deskripsi</th>
                    <th>Peralatan</th>
                    <th>Durasi</th>
                    
                    <th colspan="2">Action</th>
                </tr>
                <?php 
                    $nomor = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nomor++;
                        echo "<tr>";
                        echo "<td>". $nomor. "</td>";
                        $query2 = 'SELECT * FROM workout WHERE idOlahraga = ' . $row['idOlahraga'];
                        $result2 = mysqli_query($conn, $query2);
                        $row2 = mysqli_fetch_assoc($result2);
                        echo "<td>".$row2['namaOlahraga']. "</td>";
                        $query3 = 'SELECT * FROM instruktur WHERE kodeInstruktur = ' . $row['kodeInstruktur'];
                        $result3 = mysqli_query($conn, $query3);
                        $row3 = mysqli_fetch_assoc($result3);
                        echo "<td>".$row3['namaInstruktur']. "</td>";
                        echo "<td>".$row['judul']. "</td>";
                        echo "<td>". $row['level']. "</td>";
                        echo "<td>". $row['link']. "</td>";
                        echo "<td>". $row['deskripsiKonten']. "</td>";
                        echo "<td>". $row['peralatan']. "</td>";
                        echo "<td>". $row['durasi']. "</td>";
                        echo "<td><a href='editVideo.php?id=".$row['idVideo']."'>Edit</a></td>";
                        echo "<td><a href='deleteVideo.php?id=".$row['idVideo']."'>Delete</a></td>";
                    }
                
                ?>
            </table>
        <div class="tombol">
            <a href="addVideo.php" class="add" data-aos="Add Workoutfade-left">Tambahkan Data</a>
        </div>
        <div class="tombol">
            <a href="crud.php" class="add" data-aos="Add Workoutfade-left">Kembali</a>
        </div>
        </div>

        </section>

    </header>


</body>
</html>



<?php
require_once("connection.php");
if ($_GET) {
    $idOlahraga = $_GET['id'];
    $query = 'SELECT * FROM workout WHERE idOlahraga = ' . $idOlahraga;
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $namaOlahraga = $row['namaOlahraga'];
        $deskripsiOlahraga = $row['deskripsiOlahraga'];
        $pathJero = $row['pathJero'];

    } else {
        echo "Item yang akan diedit tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Francois+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <header>
        <section class="header">
        <img src="<? $pathJero ?>" alt="">
            <nav>
                <a href="home.php">GO WORKOUT!</a>
                <div class="nav-links">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="searchBox">
                    <form action="" class="searchBar">
                        <input type="text" name="" placeholder="Search">
                        <button type="submit" href="#">
                            <img src="image/search.png" alt="">
                        </button>
                    </form>
                </div>
            </nav>
            <div class="box">
                <h1><?= $namaOlahraga ?></h1>
                <p><?= $deskripsiOlahraga ?></p>
            </div>
        </section>
    </header>
   
    <?php
    $query = 'SELECT * FROM video WHERE idOlahraga = ' . $idOlahraga;
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<section class="sub-penjelasan" >';
        echo '<div id="video">';
        echo '<h1>' . $row['level'] . '</h1>';
        echo '<h2>"' . $row['judul'] . '"</h2>';
        echo '<iframe width="709" height="399" src="'. $row['link'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo '<p>' . $row['deskripsiKonten'] . '</p>';
        echo '</div>';
        $query2 = 'SELECT * FROM instruktur WHERE kodeInstruktur = ' . $row['kodeInstruktur'];
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        echo '<div id="informasi">';
        echo '
            <h3>Instruktur: ' . $row2['namaInstruktur'] . '</h3>
        ';
        echo '<h3>Peralatan: '  . $row['peralatan'] . '</h3>';
        echo '</div>';
        echo '</section>';
        echo '<hr>';
        echo '</section>';
    }
    ?>

    <footer>
        <h3>About Us</h3>
        <div class="icon">
            <a href="https://www.instagram.com/?hl=en"><img src="image/1.png"></a>
            <a href="https://www.whatsapp.com/"><img src="image/2.png"></a>
            <a href="login.php">admin</a>
        </div>
        <p>Made by <b>Tim Bang Jago*</b></p>
    </footer>
</body>

</html>
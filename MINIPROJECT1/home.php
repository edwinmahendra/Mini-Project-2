<?php
require_once("connection.php");
$sql= "SELECT * FROM workout";
$result=mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   

</head>
<body>
    <header>
        <section class="header">
            <nav>
                <a href="home.php">GO WORKOUT!</a>
                <div class="nav-links">
                    <ul>
                        <li><a href="home.php" class="home">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>

                    </ul>
                </div>
                <div class="searchBox">
                    <form method="GET" action="search.php" class="searchBar">
                        <input type="text" name="search" placeholder="Search">
                        <button type="submit" class="search" href="#">
                            <img src="image/search.png" alt="">
                        </button>
                    </form>
                </div>
            </nav>
        <div data-aos="fade-up" class="box">
            <h1>Selamat Datang di GO WORKOUT</h1>
            <p><b>GO WORKOUT</b> merupakan wadah dimana para pecinta olahraga dapat mempelajari bagaimana cara berolahraga yang benar. <br><b>GO WORKOUT</b> akan memberikan informasi olahraga beserta video <i>tutorial</i> tentang olahraga yang anda cintai. </p>
            <h2>Salam Olahraga!</h2>
            <br>
        </div>
        </section>
    </header>
    <main >
        <?php
        while ($row=mysqli_fetch_assoc($result)) {
            echo '<section class="HIIT"data-aos = "fade-up">';
            echo '<br><h1>'.$row['namaOlahraga'].'</h1>';
            echo '<div class="baris">';
            echo '<div class="HIIT-baris">';
            echo '<br><img src="'.$row['pathImg'].'" alt="">';
            echo '</div></div>';
            echo '<section id="jelas">';
            echo $row['deskripsiOlahraga'];
            echo '</section>';
            
            echo '<button type="button" class="button"><a href="detail.php?id='.$row['idOlahraga'].'">Details</a></button>';
            echo '</section>';
        }
        ?>
    </main>

<footer>
    <h3>About Us</h3>
    <div class="icon">
        <a href="https://www.instagram.com/?hl=en"><img src="image/1.png"></a>
        <a href="https://www.whatsapp.com/"><img src="image/2.png"></a>
        <a href="login.php">admin</a>
    </div>
    <p>Made by <b>Tim Bang Jago*</b></p>
</footer>
<script>
    AOS.init({
        offset: 150,
        duration: 1000
    });
</script>
</body>
</html>
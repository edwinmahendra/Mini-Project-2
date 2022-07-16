<?php
require_once("connection.php");
$sql= "SELECT * FROM instruktur";
$result=mysqli_query($conn, $sql);
session_start();
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
            </nav>
        </section>
    </header>
    <main>
        <form action = "addInstruktur.php" method = "POST" enctype = "multipart/form-data">
            <div class = "form">
                <label for = "">Nama Instruktur</label><br>
                <input type = "text" name = "namaInstruktur" required>    
            </div>

            <div class = "form">
                <button type="submit" name="submit" class="submit">Submit</button>
            </div>
        </form>

</main>

<section class="line">
</section>
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
<?php 
if($_POST) {
    $namaInstruktur = $_POST["namaInstruktur"];

    $sql = "INSERT INTO instruktur ( kodeInstruktur, namaInstruktur) VALUES ('', '".$namaInstruktur."')";   
        if (mysqli_query($conn, $sql) ) {
            echo "<script>alert('Data berhasil diupload!');</script>";
        } else {
            echo "<script>alert('Data gagal diupload!');</script>"; 
        }
}
mysqli_close($conn);
?>

</html>
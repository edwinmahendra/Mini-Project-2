<?php
require_once("connection.php");
$sql= "SELECT * FROM video";
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
        
        <span class = "form">
        <h2>Tambah Data</h2>
        <form action = "addVideo.php" method = "POST" enctype = "multipart/form-data">
        <div>
            <label for = ""> Nama Olahraga</label><br>
        <select name="idOlahraga">
            <option value = "None">Pilih Nama Olahraga</option><br>
            <?php  
                $queryOlahraga = 'SELECT * FROM workout';
                $resultOlahraga = mysqli_query ($conn, $queryOlahraga);
                while($row2 = mysqli_fetch_assoc($resultOlahraga)) {
                    echo '<option value="' . $row2['idOlahraga'] . '">' . $row2['namaOlahraga'] . '</option>';
                    echo '<br><br>';
                }
            ?>
                 
        </select>
        <br><br> 
            <div>
            <label class=""> Nama Instruktur</label><br>
            <select name="kodeInstruktur">
            <option value="None"> Pilih Nama Instruktur</option><br>    
            <?php
                $queryInstruktur = 'SELECT * FROM instruktur';
                $resultInstruktur = mysqli_query($conn, $queryInstruktur);
                while($row3 = mysqli_fetch_assoc($resultInstruktur)) {
                    echo '<option value="' . $row3['kodeInstruktur'] . '">' . $row3['namaInstruktur'] . '</option>'; 
                }
            ?>
            
            </select>
            <br><br>
            </div>
            <div>
                <label for = "">Judul Video </label><br>
                <input type = "text" name = "judul" placeholder="Masukkan judul video" required>
                <br><br>
            </div>
            <div>
                <label for="">Level</label><br>
                <select name="level">
                <option value="None" class="option">Pilih Tingkat Kesulitan</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                </select>
                <br><br>
            </div>
                <label for = "">link</label><br>
                <input type = "text" name = "linkVideo" required>
                <br><br>
            </div>
            <div>
                <label for = "">Deskripsi Konten</label><br>
                <input type = "text" name = "deskripsiKonten" required> 
                <br><br>   
            </div>
            <div>
                <label for = "">Peralatan</label><br>
                <input type = "text" name = "peralatan" required>  
                <br><br>  
            </div>
            <div>
                <label for = "">durasi</label><br>
                <input type = "text" name = "durasi" required>
                <br><br>   
            </div>

            <div>
                <button type="submit" name="submit" class="submit">Submit</button>
            </div>
        </form>
        </section>
        </span>
    </header>


    <main>


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
<?php 
if($_POST) {
    $idOlahraga = $_POST["idOlahraga"];
    $kodeInstruktur = $_POST["kodeInstruktur"];
    $judulVideo = $_POST["judul"];
    $levelOlahraga = $_POST["level"];
    $linkVideo = $_POST["linkVideo"];
    $deskripsiKonten = $_POST["deskripsiKonten"];
    $peralatan = $_POST["peralatan"];
    $durasi = $_POST["durasi"];

    
   

    $sql = "INSERT INTO video ( idVideo,idOlahraga,kodeInstruktur, judul, level, link, deskripsiKonten, peralatan, durasi) VALUES ('', '".$idOlahraga."','".$kodeInstruktur."','".$judulVideo."','".$levelOlahraga."','".$linkVideo."','".$deskripsiKonten."','".$peralatan."','".$durasi."');";
    

   
        if (mysqli_query($conn, $sql) ) {
            echo "<script>alert('Data berhasil diupload!');</script>";
        } else {
            echo "<script>alert('Data gagal diupload!');</script>"; 
        }
}
mysqli_close($conn);
?>

</html>
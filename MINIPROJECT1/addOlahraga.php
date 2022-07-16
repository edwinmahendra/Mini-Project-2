<?php
require_once("connection.php");
$sql= "SELECT * FROM workout";
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
                <ul>
                        <li>
                            <form action="crud.php" method="POST">
                            <button type="submit" class="logout" value="logout" name="logout">LOGOUT</button>
                            </form>
                        </li>

                    </ul>
            </nav>
        <span class = "form">
        <form action = "addOlahraga.php" method = "POST" enctype = "multipart/form-data">
            <h2>Tambah Data</h2>
            <div>
                <label for = "">Nama Olahraga </label><br>
                <input type = "text" name = "namaOlahraga">
                <br><br>
            </div>
            <div>
                <label for = "">Deskripsi Olahraga </label><br>
                <input type = "text" name = "deskripsiOlahraga">
                <br><br>
            </div>
            <div>
                <label for = "">Foto</label><br>
                <input type = "file" name = "pathImg" required>
                <br><br>
            </div>
            <div>
                <label for = "">Detail Foto </label><br>
                <input type = "file" name = "pathJero"  required> 
                <br><br>   
            </div>
        
            <div>
                <button type="submit" name="submit" class="submit">Tambah</button>
                <br><br> 
            </div>
            <div class="tombol">
                <a href="crud.php" data-aos="Add Workoutfade-left">Kembali</a>
            </div>  
        </form>
</span>

    </header>



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
    $namaOlahraga = $_POST["namaOlahraga"];
    $deskripsiOlahraga = $_POST["deskripsiOlahraga"];

    $code = date_timestamp_get(date_create());

    
    $pathImg = 'image/'. $code . '1.'  . strtolower(pathinfo($_FILES["pathImg"]["name"], PATHINFO_EXTENSION));
    $pathJero = 'image/'. $code . '2.'  . strtolower(pathinfo($_FILES["pathJero"]["name"], PATHINFO_EXTENSION));

    $sql = "INSERT INTO workout (idOlahraga, namaOlahraga, deskripsiOlahraga, pathImg, pathJero) VALUES ('', '".$namaOlahraga."','".$deskripsiOlahraga."','".$pathImg."','".$pathJero."');";
    
    $tipefilePathFoto = (pathinfo($_FILES["pathImg"]["name"], PATHINFO_EXTENSION));
    $tipefilePathDetailFoto =(pathinfo($_FILES["pathJero"]["name"], PATHINFO_EXTENSION));


    if ($tipefilePathFoto !== "jpeg" && $tipefilePathFoto !== "jpg" && $tipefilePathFoto !== "png" && $tipefilePathDetailFoto !== "jpg" && $tipefilePathDetailFoto !== "jpeg" && $tipefilePathDetailFoto !== "png") {
        echo "<script>alert('File yang diupload harus berupa gambar (JPG/JPEG/PNG)')</script>";
    } else {
        if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES["pathImg"]["tmp_name"], $pathImg) && move_uploaded_file($_FILES["pathJero"]["tmp_name"], $pathJero)) {
            echo "<script>alert('Data workout berhasil diupload!');</script>";
            echo "<script>window.location.href='crudWorkout.php'</script>";
        } else {
            echo "<script>alert('Data gagal diupload!');</script>"; 
        }
}

}

mysqli_close($conn);
?>

</html>
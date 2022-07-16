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

if ($_GET) {
    $query = "SELECT * FROM instruktur WHERE kodeInstruktur=" . $_GET["id"];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldkodeInstruktur = $row["kodeInstruktur"];
        $oldnamaInstruktur = $row["namaInstruktur"];
    } else {

        echo "<script>alert('Data instruktur yang akan diedit tidak ditemukan!');</script>";
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Francois+One&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <section class="header">
            <nav>
                <a href="home.php">GO WORKOUT!</a>
                <div class="nav-links">
                    <ul>

                    </ul>
                </div>
            </nav>
            <span class="formIns">
            <h2>Edit Data</h2>

            <form action = "editInstruktur.php" method = "POST" enctype = "multipart/form-data">
            <input type="hidden" name="kodeInstruktur" value="<?php echo $_GET["id"] ?>">
            <div>
                <label for = "">Nama Instruktur </label><br>
                <input type = "text" name = "namaInstruktur" placeholder="Masukkan Nama Olahraga" value="<?php echo $oldnamaInstruktur ?>">
            </div>
            <div>
                <button type="submit" name="submit" class="submit">Submit</button>
            </div>
</form>
</body> 
<?php 
if($_POST) {
    $kodeInstruktur = $_POST["kodeInstruktur"];
    $namaInstruktur = $_POST["namaInstruktur"];
    $query = "UPDATE instruktur SET namaInstruktur = '$namaInstruktur' WHERE kodeInstruktur = '$kodeInstruktur'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah!');</script>";
        echo "<script>location.href='crudInstruktur.php';</script>";

    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
        echo "<script>location.href='editInstruktur.php';</script>";

    }
}
mysqli_close($conn);
?>
</html>
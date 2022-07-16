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

if ($_GET) {
    $query = "SELECT * FROM video WHERE idVideo=" . $_GET["id"];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldidOlahraga = $row["idOlahraga"];
        $oldkodeInstruktur = $row["kodeInstruktur"];
        $oldjudulVideo = $row["judul"];  
        $oldlevelOlahraga = $row["level"];
        $oldlinkVideo = $row["link"];
        $olddeskripsiKonten = $row["deskripsiKonten"];
        $oldperalatan = $row["peralatan"];
        $olddurasi = $row["durasi"];
        
        $instruktur = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM instruktur WHERE kodeInstruktur=" . $oldkodeInstruktur));
        $namaOlahr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM workout WHERE idOlahraga=" . $oldidOlahraga));
        $oldNamaInstruktur = $instruktur["namaInstruktur"];
        $oldnamaOlahraga = $namaOlahr["namaOlahraga"]; 
    } else {
        echo "<script>alert('Data video yang akan diedit tidak ditemukan!');</script>";
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
    <link rel="stylesheet" href="crudVideo.css">
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
            <div class="formVideo">
            <h2>Edit Data</h2>
            <form action = "editVideo.php" method = "POST" enctype = "multipart/form-data">
            <input type="hidden" name="idOlahraga" value="<?php echo $_GET["id"] ?>">
            <div>
                <label for = ""> Nama Olahraga</label><br>
                <select name="idOlahraga">
                <option value="<?= $oldidOlahraga ?>">Sebelumnya (<?= $oldnamaOlahraga ?>)</option>
                <?php  
                    $queryOlahraga = 'SELECT * FROM workout';
                    $resultOlahraga = mysqli_query ($conn, $queryOlahraga);
                    while($row2 = mysqli_fetch_assoc($resultOlahraga)) {
                        echo '<option value="' . $row2['idOlahraga'] . '">' . $row2['namaOlahraga'] . '</option>';
                    }
                ?>      
                </select> 
            </div>
            <div>
                <label class=""> Nama Instruktur</label><br>
                <select name="kodeInstruktur">
                <option value="<?php $oldkodeInstruktur ?>">Sebelumnya (<?php echo $oldNamaInstruktur ?>)</option><br>
                <?php
                    $queryInstruktur = 'SELECT * FROM instruktur';
                    $resultInstruktur = mysqli_query($conn, $queryInstruktur);
                    while($row3 = mysqli_fetch_assoc($resultInstruktur)) {
                        echo '<option value="' . $row3['kodeInstruktur'] . '">' . $row3['namaInstruktur'] . '</option>'; 
                    }
                ?>
                </div>
                </select>
            <div>
                <label for = "">Judul Video </label><br>
                <textarea type="text" name="judul" placeholder="Masukkan judul video"><?php echo $oldjudulVideo ?></textarea>
            </div>
            <div>
            <div>
                <label for="">Level</label><br>
                <select name="level">
                    <option value="<?php $oldlevelOlahraga ?>">Sebelumnya (<?php echo $oldlevelOlahraga ?>)</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
            <div>
                <label for = "">link</label><br>
                <textarea type="text" name="link" placeholder="Masukkan link"><?php echo $oldlinkVideo?></textarea>
                </div>
            <div>
                <label for = "">Deskripsi Konten</label><br>
                <textarea type="text" name="deskripsiKonten" placeholder="Masukkan deskrpsi olahraga"><?php echo $olddeskripsiKonten?></textarea>

                </div>
                <div>
                    <label for = "">Peralatan</label><br>
                    <textarea type="text" name="peralatan" placeholder="Masukkan peralatan"><?php echo $oldperalatan?></textarea>
                </div>
                <div>
                    <label for = "">durasi</label><br>
                    <textarea type="text" name="durasi" placeholder="Masukkan durasi"><?php echo $olddurasi?></textarea>
                    
                </div>

                <div>
                    <button type="submit" name="submit" class="submit">Submit</button>
                </div>
            </form>
            </span>
        </section>
    </header>
    <main>
    
</main>

<section class="line">
</section>
<script>
    AOS.init({
        offset: 150,
        duration: 1000
    });
    
</script>
</body>
<?php 
if($_POST) {
    $idOlahraga = $_POST['idOlahraga'];
    $kodeInstruktur = $_POST["kodeInstruktur"];
    $judulVideo = $_POST["judul"];
    $levelOlahraga = $_POST["level"];
    $linkVideo = $_POST["link"];
    $deskripsiKonten = $_POST["deskripsiKonten"];
    $peralatan = $_POST["peralatan"];
    $durasi = $_POST["durasi"];

    echo $idOlahraga;
    echo $kodeInstruktur;
    echo $judulVideo;
    echo $levelOlahraga;
    echo $linkVideo;
    echo $deskripsiKonten;
    echo $peralatan;
    echo $durasi;
        $query = "UPDATE video SET kodeInstruktur = '$kodeInstruktur', judul = '$judulVideo', level = '$levelOlahraga', link = '$linkVideo' , deskripsiKonten = '$deskripsiKonten', peralatan = '$peralatan', durasi = '$durasi' WHERE idOlahraga = '$idOlahraga'" ;
        if (mysqli_query($conn, $query)) {
            echo "<script>location.href='crudWorkout.php';</script>";
            echo "<script>alert('Data berhasil diubah!');</script>";
        } else {
            echo "<script>alert('Data gagal diubah!');</script>";
            echo "<script>location.href='crudWorkout.php';</script>";

        }
    }

mysqli_close($conn);
?>

</html>

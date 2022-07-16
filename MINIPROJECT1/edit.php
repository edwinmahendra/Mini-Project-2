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

if ($_GET) {
    $query = "SELECT * FROM workout WHERE idOlahraga=" . $_GET["id"];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldidOlahraga = $row['idOlahraga'];
        $oldnamaOlahraga = $row['namaOlahraga'];
        $olddeskripsiOlahraga = $row['deskripsiOlahraga'];
        $oldpathImg = $row['pathImg'];
        $oldpathJero = $row['pathJero'];
    } else {
        echo "<script>alert('Data workout yang akan diedit tidak ditemukan!');</script>";
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
            <span class="formEd">
            <h2>Edit Data</h2>
            <form action = "edit.php" method = "POST" enctype = "multipart/form-data">
            <input type="hidden" name="idOlahraga" value="<?php echo $_GET["id"] ?>">
            <div>
                <label for = "">Nama Olahraga </label><br>
                <input type = "text" name = "namaOlahraga" placeholder="Masukkan Nama Olahraga" value="<?php echo $oldnamaOlahraga ?>">
                <br><br>
            </div>
            <div>
                <label for = "">Deskripsi Olahraga </label><br>
                <textarea type="text" name="deskripsiOlahraga" placeholder="Masukkan Detail Deskripsi Workout (Show on Video Page)"><?php echo $olddeskripsiOlahraga ?></textarea>
                <br><br>
            </div>
            <input type="hidden" name="oldpathImg" value="<?php echo $oldpathImg ?>">
            <div >
                <label for = "">Foto</label><br>
                <div class="preview">
                    <img src="<?php echo $oldpathImg?>" alt="Preview Thumbnail Cover" id="thumbnailCover">
                    <input type="file" name="pathImg" class="sideInput">
                </div>
            </div>
            <input type="hidden" name="oldpathJero" value="<?php echo $oldpathJero ?>">
            <div class="preview">
                <label for = "">Detail Foto </label><br>
                <div">
                    <img src="<?php echo $oldpathJero ?>" alt="Preview Thumbnail Cover" id="thumbnailCover">
                    <input type="file" name="pathJero" class="sideInput">
                </div> 
            </div>
            <div>
                <button type="submit" name="submit" class="submit">Submit</button>
            </div>
        </form>
        </section>

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
    $idOlahraga = $_POST['idOlahraga'];
    $namaOlahraga = $_POST["namaOlahraga"];
    $deskripsiOlahraga = $_POST["deskripsiOlahraga"];
    $oldpathImg = $_POST["oldpathImg"];
    $oldpathJero = $_POST["oldpathJero"];

    if ((!file_exists($_FILES['pathImg']['tmp_name']) || !is_uploaded_file($_FILES['pathImg']['tmp_name'])) && (!file_exists(($_FILES['pathJero']['tmp_name'])) || !is_uploaded_file($_FILES['pathJero']['tmp_name']))) {
        $query = "UPDATE workout SET namaOlahraga = '$namaOlahraga', deskripsiOlahraga = '$deskripsiOlahraga', pathImg = '$oldpathImg', pathJero = '$oldPathJero' WHERE idOlahraga = '$idOlahraga'";
        if (mysqli_query($conn, $query)) {
            header("Location:crudWorkout.php");
            echo "<script>alert('Data workout berhasil diedit dan gambar tidak terdapat perubahan!');</script>";
        } else {
            echo "<script>alert('Data workout gagal diedit!');</script>";
        }
    } 
    
    else if (!file_exists($_FILES['pathImg']['tmp_name']) || !is_uploaded_file($_FILES['pathImg']['tmp_name'])) {
        $code = date_timestamp_get(date_create());

        $pathJero = 'images/' . $code . '1.' . strtolower(pathinfo($_FILES['pathJero']['name'], PATHINFO_EXTENSION));

        $query = "UPDATE workout SET namaOlahraga = '$namaOlahraga', deskripsiOlahraga = '$deskripsiOlahraga', pathImg = '$oldpathImg', pathJero = '$pathJero' WHERE idOlahraga = '$idOlahraga'";

        $tipeBackground = strtolower(pathinfo($_FILES["pathJero"]["name"], PATHINFO_EXTENSION));

        if ($tipeBackground != "jpg" && $tipeBackground != "jpeg" && $tipeBackground != "png") {
            echo "<script>alert('File yang diupload harus berupa gambar (JPG/JPEG/PNG)')</script>";
        } else {
            if (mysqli_query($conn, $query) && move_uploaded_file($_FILES["pathJero"]["tmp_name"],  $pathJero)) {
                echo "<script>alert('Data workout beserta file background berhasil diupload!');</script>";
                header("Location:crudWorkout.php");
            } else {
                echo "<script>alert('Data workout beserta file background gagal diupload!');</script>";
            }
        }
    }

    else if (!file_exists($_FILES['pathJero']['tmp_name']) || !is_uploaded_file($_FILES['pathJero']['tmp_name'])) {
        $code = date_timestamp_get(date_create());

        $pathImg = 'image/' . $code . '2.' . strtolower(pathinfo($_FILES['pathImg']['name'], PATHINFO_EXTENSION));

        $query = "UPDATE workout SET namaOlahraga = '$namaOlahraga', deskripsiOlahraga = '$deskripsiOlahraga', pathImg = '$pathImg', pathJero = '$oldpathJero' WHERE idOlahraga = '$idOlahraga'";

        $tipeCover = strtolower(pathinfo($_FILES["pathImg"]["name"], PATHINFO_EXTENSION));

        if ($tipeCover != "jpeg" && $tipeCover != "jpg" && $tipeCover != "png") {
            echo "<script>alert('File yang diupload harus berupa gambar (JPG/JPEG/PNG)')</script>";
        } else {
            if (mysqli_query($conn, $query) && move_uploaded_file($_FILES["pathImg"]["tmp_name"], $pathImg)) {
                echo "<script>alert('Data workout beserta file cover berhasil diupload!');</script>";
                header("Location:crudWorkout.php");
            } else {
                echo "<script>alert('Data workout beserta file cover gagal diupload!');</script>";
            }
        }
    }

    else {
        $code = date_timestamp_get(date_create());

        $pathImg = 'image/' . $code . '1.' . strtolower(pathinfo($_FILES['pathImg']['name'], PATHINFO_EXTENSION));
        $pathJero = 'image/' . $code . '2.' . strtolower(pathinfo($_FILES['pathJero']['name'], PATHINFO_EXTENSION));

        $query = "UPDATE workout SET namaOlahraga = '$namaOlahraga', deskripsiOlahraga = '$deskripsiOlahraga', pathImg = '$pathImg', pathJero = '$pathJero' WHERE idOlahraga = '$idOlahraga'";

        $tipeCover = strtolower(pathinfo($_FILES["pathImg"]["name"], PATHINFO_EXTENSION));
        $tipeBackground = strtolower(pathinfo($_FILES["pathJero"]["name"], PATHINFO_EXTENSION));

        if ($tipeCover != "jpeg" && $tipeCover != "jpg" && $tipeCover != "png" && $tipeBackground != "jpg" && $tipeBackground != "jpeg" && $tipeBackground != "png") {
            echo "<script>alert('File yang diupload harus berupa gambar (JPG/JPEG/PNG)')</script>";
        } else {
            if (mysqli_query($conn, $query) && move_uploaded_file($_FILES["pathImg"]["tmp_name"], $pathImg) && move_uploaded_file($_FILES["pathJero"]["tmp_name"],$pathJero)) {
                echo "<script>location.href='crudWorkout.php';</script>";
                echo "<script>alert('Data workout beserta file cover dan background berhasil diupload!');</script>";
            } else {
                echo "<script>alert('Data workout beserta file cover dan background gagal diupload!');</script>";
            }
        }
    }
}

mysqli_close($conn);
?>

</html>

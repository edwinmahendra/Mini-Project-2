<?php
// Koneksi ke Database
include '../dbconnect.php';

// Ambil data workout dari database
$query = 'SELECT * FROM workout WHERE kodeWO = "' . $_GET['id'] . '"';
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if (unlink("../../" . $row['pathCoverWO']) && unlink("../../" . $row['pathBackgroundWO'])) {
    $query = 'DELETE FROM workout WHERE kodeWO = "' . $_GET['id'] . '"';
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script>alert("Data Berhasil Dihapus!");</script>';
        echo '<script>window.location.href = "CRUD Workout.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus!");</script>';
        echo '<script>window.location.href = "CRUD Workout.php";</script>';
    }
} else {
    echo '<script>alert("Data Gagal Dihapus!");</script>';
    echo '<script>window.location.href = "CRUD Workout.php";</script>';
}

session_start();
if (!isset($_SESSION["nama"])) {
    header("Location:../login.php");
}
?>
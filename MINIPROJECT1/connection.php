<?php
$servername="127.0.0.1";
$username="root";
$password="";
$databasename="minpro2";
$conn=mysqli_connect($servername, $username, $password, $databasename) or die ("Koneksi gagal");

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
?>
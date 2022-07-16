<script>
var cf=confirm("Apakah anda yakin ingin delete data?");
if (cf){
    <?php
        require_once("connection.php");
        $sql= 'DELETE FROM video WHERE idVideo=' . $_GET['id'];
        $result=mysqli_query($conn, $sql);
        session_start();
        if(!isset($_SESSION["email"])){
            header("Location: login.php");
        }elseif (isset($_POST["logout"])){
            session_destroy();
            header("Location:login.php");
        }

    ?>
    window.location="crudVideo.php";
} else{
    console.log("Data tidak jadi didelete");
}

</script>
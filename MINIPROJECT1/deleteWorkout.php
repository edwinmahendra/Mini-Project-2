<script>
var cf=confirm("Apakah anda yakin ingin delete data?");
if (cf==true){
    <?php
        require_once("connection.php");
        $sql= 'DELETE FROM workout WHERE idOlahraga=' . $_GET['id'];
        $result=mysqli_query($conn, $sql);
        session_start();
        if(!isset($_SESSION["email"])){
            header("Location: login.php");
        }elseif (isset($_POST["logout"])){
            session_destroy();
            header("Location:login.php");
        }

    ?>
    window.location="crudWorkout.php";
} else if(cf==false){
    console.log("Data tidak jadi didelete");
}
window.location="crudWorkout.php";

</script>




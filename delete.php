<?php
if(isset($_POST["ID"]))
{
    $conn = new mysqli("localhost", "root", "", "test");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }    
    $ID = mysqli_real_escape_string($conn, $_POST["ID"]);
    $sql = "DELETE FROM `test` WHERE id =  $ID ";
    if(mysqli_query($conn, $sql)){ 
        header("Location: index.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    $conn->close(); 
}
?>
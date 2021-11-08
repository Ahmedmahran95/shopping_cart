<?php

$connect = mysqli_connect("localhost", "root", "", "test");

if($_POST['item']){
    
    $query = " DELETE FROM cart WHERE id=".$_POST["item"]." ";

    $result = mysqli_query($connect, $query);
}
header('Location: cart.php ');




?>
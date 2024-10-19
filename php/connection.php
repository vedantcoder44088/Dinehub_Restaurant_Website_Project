<?php
$servername = "localhost";
$username = "root";
$dbname = "RestaurantSystem";

$conn = mysqli_connect($servername, $username, "", $dbname);

if($conn){
    echo "Connected";
}else{
    echo "Not Connected";
}
?>

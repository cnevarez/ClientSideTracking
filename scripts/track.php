
<?php
include "config/config.php";


date_default_timezone_set("America/Los_Angeles");

$page = $_GET['page'];
$time =date("l F d, Y  h:i:s a T ");
// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
}
else{
	$createDB = "CREATE DATABASE IF NOT EXISTS tracking";
	mysqli_query($conn,$createDB);
	mysqli_select_db($conn, "tracking");
	mysqli_query($conn, "CREATE TABLE tracking_table ( page VARCHAR(200) )");
}

$sql = "INSERT INTO tracking_table(page) VALUES ('hit page $page on $time')";
mysqli_query($conn, $sql);


?>
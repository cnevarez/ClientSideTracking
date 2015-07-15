<?php
include "config/config.php";

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
	mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tracking_table ( page VARCHAR(200) )");
}

$sql = "SELECT * FROM tracking_table";
$results = mysqli_query($conn, $sql);
echo "<table id='ptable'>";
while ($row = mysqli_fetch_array($results)) {
    echo '<tr>';

        echo '<td>' . $row['page']. '</td>';
    
    echo '</tr>';
}
echo "</table>;"

?>
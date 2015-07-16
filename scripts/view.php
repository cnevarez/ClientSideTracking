<?php include 'header.php'; ?>
<?php
include "config/config.php";

date_default_timezone_set("America/Los_Angeles");

$page = $_POST['data'];
$day =date("l F d, Y");
$time = date("h:i:s a T");

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
}
else{
  mysqli_select_db($conn, "tracking");

}



//Showing the page hits
$sql = "SELECT * FROM tracking_table";
$results = mysqli_query($conn, $sql);
echo "<center><h3>What the database shows for this contact</h3><table id='ptable' border='1'><th>IP Address</th><th>Page</th><th>Date</th><th>Time</th>";
while ($row = mysqli_fetch_array($results)) {
    echo '<tr>';

        echo '<td>' . $row['ip_address']. '</td><td>' . $row['page']. '</td><td>'.$row['day'].'</td><td>' . $row['time']. '</td>';
    
    echo '</tr>';
}
echo "</table></center>;"

?>
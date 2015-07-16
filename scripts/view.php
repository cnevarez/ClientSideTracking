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
	$createDB = "CREATE DATABASE IF NOT EXISTS tracking";
	mysqli_query($conn,$createDB);
	mysqli_select_db($conn, "tracking");
	mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tracking_table ( page VARCHAR(200) )");
}


//Echoing the js needed on the client side
$str1 = '<iframe src="scripts/track.php?page='.$page.'" style="display:none;"></iframe>';

echo "<strong>iframe code that should go on ".$page.":</strong><br /><hr />";
echo "<pre>";        
echo htmlentities($str1, ENT_QUOTES);
echo "</pre><hr />";
$str = '
<script>
	function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
var page = getQueryVariable(\'page\');
</script>

<form method="post">
//I have prepopulated the time for this input\'s value, but leave the value blank. This value should be the end result.
	<input type="hidden" id="timestamp" name="CustomFieldName" value="hit page '.$page.' on '.$day.' at '.$time.'"/>
</form>
<script>
	var d = new Date();
	var n = d.toLocaleString();
	document.getElementById("timeStamp").value = "hit page " + page + " on " + n;
	document.onload.forms[0].submit();
</script>';

echo "<strong>HTML coding that should go on the page that is the iframe is directed at:</strong><br /><hr />";
echo "<pre>";        
echo htmlentities($str, ENT_QUOTES);
echo "</pre>";

//echo "<strong>Preview</strong><br/><hr/>";
//echo $str;
//End echo js

//Showing the page hits
$sql = "SELECT * FROM tracking_table";
$results = mysqli_query($conn, $sql);
echo "<center><h3>What the database shows for this contact</h3><table id='ptable' border='1'>";
while ($row = mysqli_fetch_array($results)) {
    echo '<tr>';

        echo '<td>' . $row['page']. '</td>';
    
    echo '</tr>';
}
echo "</table></center>;"

?>
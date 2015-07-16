
  <?php
  include "../scripts/config/config.php";


date_default_timezone_set("America/Los_Angeles");

$ip = $_SERVER['REMOTE_ADDR'];
$page = "Page 2";
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

$sql = "INSERT INTO tracking_table(ip_address, page, day, time) VALUES ('$ip', '$page', '$day', '$time')";
mysqli_query($conn, $sql);

?>
<html>
  <head>
    <title><?php echo $page ?></title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

  </head>
  <body>
    <h3>You are on Page 1</h3><br />
    <a href="../">Home</a><br />
    <a href="page1.php">Visit Page 1 </a><br />
    <a href="page2.php">Visit Page 2 </a><br />
    <a href="page3.php">Visit Page 3 </a><br />
    <a href="page4.php">Visit Page 4 </a><br /><br />

    <div id="byte_content"></div>

<script>
    //Normal AJAX
function sendTheFile(){
//Ajax requesst
   $.ajax({
        type: "POST",
        url: "../scripts/view.php",
        data: {data : document.title}, 
        cache: false,

        success: function(data) {
           // data is ur summary
          $('#byte_content').html(data);
        }
    });
}
sendTheFile();

//End Normal AJAX
</script>
  </body>
  <link rel="stylesheet" href="../style/style.css">
</html>

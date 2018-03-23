  <?php
$servername = "localhost";
$username = "act0786";
$password = "hP+miybi6~Qr";
$dbname = "act0786";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_REQUEST['submitval']))
{
$data= $_REQUEST['yourval'];
$sql = "UPDATE `fuel_welcome` SET pera='".$data."' WHERE `welcome_id`=1";

if ($conn->query($sql) === TRUE) {
   

   

 echo'<script>window.location="http://auscompliancewer.com.au/index.php/fuel/property";</script>';
   
} else {
    echo "Error updating record: " . $conn->error;
}

	

	

}
?>
<?php
require_once "Credentials.php";
$restaurants=$_POST['Restaurants'];
$rating=$_POST['rating'];
if(isset($_POST['review'])){
    $review=$_POST['review'];
} else{
    $review='';
}
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
//$sql=$conn->prepare('Insert Into Reviews(ID,Star Rating,Review Text) values(?,?,?)');
$sql="Insert into Reviews values('$restaurants','$rating','$review')";
if(mysqli_query($conn,$sql)){
    echo "Your review has been uploaded";
    echo "<br>";
    echo '<a href="Restaurants.php">Return</a>';
}
//$sql->bind_param("sss",$restaurants,$rating,$review);
//$sql->execute();
//echo "Your review has been uploaded";
?>



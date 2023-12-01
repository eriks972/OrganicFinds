<?php
$name=$_POST['Vname'];
$Address=$_POST['Address'];
$zip=$_POST['Zipcode'];
$State=$_POST['State'];
$deliver=$_POST['Vendors'];
require_once "Credentials.php";
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$sql="INSERT INTO `Vendors`(`Vendor_Name`, `Address`, `State`, `ZipCode`, `Deliever`) VALUES ('$name','$Address','$State','$zip','$deliver')";
if(mysqli_query($conn,$sql)){
    echo "The vendor you add was uploaded and will be reviewed";
    echo "<br>";
    echo '<a href="Vendors.php">Return</a>';
}
?>
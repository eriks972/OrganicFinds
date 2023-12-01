<?php
require_once "Credentials.php";
$name=$_POST['Ename'];
$VendorID=$_POST['vendor'];
$Desc=$_POST['Desc'];
$SDate=$_POST['StartDate'];
$EDate=$_POST['CloseDate'];
$STime=$_POST['start'];
$CTime=$_POST['end'];
$days=array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
$string="";
$count=0;
for($i=0;$i<count($days);$i++){
    if(isset($_POST[$days[$i]])){
        $count++;
        if($count>1){
            $string.=",";
        }
        $string.=$_POST[$days[$i]];
    }
}
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$sql="INSERT INTO `Vendor_Events`(`Vendor_ID`, `Event Name`, `Event Description`, `Start Date:`, `End Date:`, `Start Time`, `End Time`, `Days Open`) VALUES ('$VendorID','$name','$Desc','$SDate','$EDate','$STime','CTime','$string')";
if(mysqli_query($conn,$sql)){
    echo "The event you add was uploaded and will be reviewed";
    echo "<br>";
    echo '<a href="Vendors.php">Return</a>';
}
?>
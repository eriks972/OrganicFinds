<?php
require_once "Credentials.php";
$name=$_POST['Rname'];
$Address=$_POST['Address'];
$zipcode=$_POST['Zipcode'];
$State=$_POST['State'];
$Review=$_POST['Review'];
$link=$_POST['Link'];
//$Photo=$_POST['Photo'];
/*$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
       die("Fatal error");
$sql=$conn->prepare("Insert Into Restaurants(Name,Address,zipcode,state,review,website) values (?,?,?,?,?,?)");
$sql->bind_param("ssssss",$name,$Address,$zipcode,$State,$Review,$link);
$sql->execute();
echo "Your Restaurant has been uploaded";
echo "<br>";
echo '<a href="Restaurants.php">Return</a>';*/
if(count($_FILES)>0){
    if (is_uploaded_file($_FILES['Photo']['tmp_name'])) {
    $imgData = file_get_contents($_FILES['Photo']['tmp_name']);
    $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
    if($conn->connect_error)
       die("Fatal error");
    $sql=$conn->prepare("Insert Into Restaurants(Name,Address,zipcode,state,review,website,Photo) values (?,?,?,?,?,?,?)");
    $sql->bind_param("sssssss",$name,$Address,$zipcode,$State,$Review,$link,$imgData);
    $sql->execute();
    echo "Your Restaurant has been uploaded";
    echo "<br>";
    echo '<a href="Restaurants.php">Return</a>';    
    }
}
?>

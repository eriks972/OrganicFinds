<?php
$username=$_POST["Uname"];
$password=$_POST["pword"];
$check=0;
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
    die("Fatal error");
$query="Select * from Accounts";
$result=$conn->query($query);
$rows=$result->num_rows;
for($i=0;$i<$rows;$i++){
$row2=$result->fetch_array(MYSQLI_ASSOC);
$string=$row2["Username"];
$string2=$row2["Password"];
if(strcmp($username,$string)==0 && strcmp($password,$string2)==0){
    session_start();
    echo "You have logged in";
    $check=1;
    echo "<br>";
    echo "<a href='index.php'>Home</a>";
    $_SESSION['Username']=$username;
    $_SESSION['ID']=$row2["ID"];
    $_SESSION['Type']=$row2["Account_Type"];
} 
}
if($check==0){
    echo "You have failed to login in";
     echo "<a href='Test.php'>Return Home</a>";
}
?>
<?php
$username=$_POST["Uname"];
$password=$_POST["pword"];
$Repassword=$_POST["repword"];
$account=$_POST["account"];
if(strcmp($password,$Repassword)!=0){
    echo "The passwords do not match";
    echo "<br>";
    echo "<a href='account.php'>Return</a>";
    return;
}
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
       die("Fatal error");
$sql=$conn->prepare("Insert Into Accounts (Username,Password,Account_Type) values (?,?,?)");
$sql->bind_param("sss",$username,$password,$account);
$sql->execute();
echo "Your account has been created";
echo "<br>";
echo "<a href='Test.php'>Return</a>";
?>
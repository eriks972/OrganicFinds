<?php
session_start();
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
       die("Fatal error");
$name=$_POST['Rname'];
$link=$_POST['Link'];
$Type=$_POST['Type'];
$Diet=$_POST['Diet'];
//$Photo=$_POST['Photo'];
$ID = array();
$i=0;
$string="";
$result=$conn->query("Select * from Products Order by Name");   
$rows=$result->num_rows;
for ($b=0;$b<$rows;$b++){
     $row2=$result->fetch_array(MYSQLI_ASSOC);
     $String=$row2["Name"];
     if(isset($_POST[$String])){
       $ID[$i]=$_POST[$String];
       $i++;
     }
}
for($x=0;$x<count($ID);$x++){
    $string=$string.$ID[$x];
    if($x!=count($ID)-1){
        $string.=",";
    }
}
$conn->next_result();
$imgData = file_get_contents($_FILES['Photo']['tmp_name']);
$sql=$conn->prepare("Insert Into Recipes(`Name`,`Ingredient Code`,`URL`,`Meal Type`,`Diet`,`Photo`) values (?,?,?,?,?,?)");
$sql->bind_param("ssssss",$name,$string,$link,$Type,$Diet,$imgData);
$sql->execute();
echo "Your Recipe has been Uploaded";
echo "<br>";
echo "<a href='Recipes.php'>Return</a>";
// INSERT INTO `Recipes`(`Name`, `Ingredient Code`, `URL`, `Meal Type`, `Diet`) VALUES ('$name','$string','$link','$Type','$Diet')//
?>

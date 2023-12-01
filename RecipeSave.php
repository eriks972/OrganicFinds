<?php
session_start();
$RiD=$_POST["submit"];
$ID=$_SESSION["ID"];
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
       die("Fatal error");
$sql="Select * from Saved_Recipes;
      Insert Into Saved_Recipes(ID,Recipe_ID) values ('$ID','$RiD');";
$conn->multi_query($sql);
$result=$conn->store_result();   
$rows=$result->num_rows; 
for($i=0;$i<$rows;$i++){
     $row=$result->fetch_array(MYSQLI_ASSOC);
     if($row['ID']==$ID && $row['Recipe_ID']==$RiD){
         echo "You have already added this recipe";
         echo "<br>";
         echo "<a href='Recipes.php'>Return</a>";
         Return;
     }
}
$conn->next_result();
//$sql=$conn->prepare("Insert Into Saved_Recipes(ID,Recipe_ID) values (?,?)");
//$sql->bind_param("ss",$ID,$RiD);
//$sql->execute();

echo "Your Recipe has been saved to your account";
echo "<br>";
echo "<a href='Recipes.php'>Return</a>";
?>

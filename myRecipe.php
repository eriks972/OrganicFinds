<?php
session_start();
?>
<header>
    <link rel="stylesheet" href="Test Home Style.css">
    <link rel='stylesheet' href='Restaurant.css'>
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center" style="background-color: #109037;">
</header>
<body >
    <div class="topnav">
    <a href="index.php">Home</a>
    <a href="About Us.html">About Us</a>
    <a href="Search.php">Search</a>
    <a href="Products.html">Products</a>
    <a class="active"href="Recipes.php">Recipes</a>
    <a href="Gardening.html">Gardening</a>
    <a href="Restaurants.php">Restaurants</a>
    <a href="Vendors.php">Vendors</a>
    </div>
<body>
<?
require_once 'Credentials.php'; 
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$query="Select * from Saved_Recipes;";
$query.="Select * from Recipes";
$conn->multi_query($query);
$result=$conn->store_result();
$rows=$result->num_rows;
$ID = array();
$c=0;
for($i=0; $i<$rows; $i++){
    $row=$result->fetch_array(MYSQLI_ASSOC);
    if($row["ID"]==$_SESSION["ID"]){
        $ID[$c]=$row["Recipe_ID"];
        $c++;
    }
}
 $conn -> next_result();
 $result3 = $conn -> store_result();
 $rows2=$result3->num_rows;
 for($i=0;$i<$rows2;$i++){
 $row3=$result3->fetch_array(MYSQLI_ASSOC);
 $value=$row3["ID"];
 if(check($value,$ID)==0){
 echo "<div class=Restaurants>";
 echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
 echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
 echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
 echo '<br>';
 echo $row3['Meal Type'];
 echo '<br>';
 echo '<br>';
 echo $row3['Diet'];
 echo '<br>';
 echo '<br>';
 echo "</div>";
 echo '<br>';
 }
}
function check($num,$IDs){
    for($b=0;$b<count($IDs);$b++){
        if($num==$IDs[$b]){
             return 0;
        }
     }
     return 1;
 }       
?>
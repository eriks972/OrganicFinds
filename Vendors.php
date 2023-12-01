<?php
session_start();
?>
<style>
.Event{
  background-color: transparent;
  color:black;
  font-size:20px;
  float:right;
}
</style>
<header>
    <link rel="stylesheet" href="Test Home Style.css">
    <link rel='stylesheet' href='Restaurant.css'>
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center style="background-color: #109037;">
    <?
    if(!isset ($_SESSION["Username"])){
        ?>
        <a href="Test.php" style="float: left;">Login</a>
        <?
    } else {
        ?>
        <a href="Logout.php" style="float: left;">Log out</a>
        <?
    }
    ?>
</header>
<body>
<div class="topnav">
        <a href="index.php">Home</a>
        <a href="About Us.html">About Us</a>
        <a href="Search.php">Search</a>
        <a href="Products.html">Products</a>
        <a href="Recipes.php">Recipes</a>
        <a href="Gardening.html">Gardening</a>
        <a href="Restaurants.php">Restaurants</a>
        <a class="active" href="Vendors.php">Vendors</a>
</div>
<input type="button" value="Add Vendor" style="background-color: Red; color:white; font-size:20px;float:right" onclick="location='AddVendor.html'"/>
<input type='button' value='Add Event' style='background-color: Green; color:white; font-size:20px;float:right' onclick="location='AddEvent.php'"/>";
<br>
<?
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$result=$conn->query("Select * from Vendors");   
$rows=$result->num_rows;
for ($i=0;$i<$rows;$i++){
    $row=$result->fetch_array(MYSQLI_ASSOC);
     echo "<div class=Restaurants>";
     echo "<h1>".htmlspecialchars($row['Vendor_Name'])."</h1>";
     ?>
     <form method='post' action='Event.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Event" value='.htmlspecialchars($row["ID"]).'>Event</button>';
        } else {
        echo '<button name="submit" type="submit" class="Event" value='.htmlspecialchars($row["ID"]).' disabled>Event</button>';
        }
        echo "</form>";

     echo "<h2>".htmlspecialchars($row['Address'])."</h2>";
     if($row['Deliever']==0){
        echo "<h3>Deliever: No</h3>";
    } else {
        echo "<h3>Deliever: Yes</h3>";
        }
    echo "</div>";
    echo "<br>";
}
?>
<body>
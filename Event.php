<?php
$ID=$_POST["submit"];
?>
<header>
    <link rel="stylesheet" href="Test Home Style.css">
    <link rel='stylesheet' href='Restaurant.css'>
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center style="background-color: #109037;">
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
<?
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$result=$conn->query("Select * from Vendor_Events where Vendor_ID=$ID"); 
$rows=$result->num_rows;
if($rows==0){
    echo "<h1>Sorry, There are no Events for this vendor</h1>";
} else{
    for ($i=0;$i<$rows;$i++){
    $row=$result->fetch_array(MYSQLI_ASSOC);
    echo "<div class=Restaurants>";
    echo "<h1>".htmlspecialchars($row['Event Name'])."</h1>";
    echo "<h3>Start Date: ".htmlspecialchars($row['Start Date:'])."</h3>";
    echo "<h3>End Date: ".htmlspecialchars($row['End Date:'])."</h3>";
    echo "<h2>".htmlspecialchars($row['Event Description'])."</h2>";
    echo "<h3>Open: ".htmlspecialchars($row['Start Time'])."-".htmlspecialchars($row['End Time'])."</h3>";
    echo "<h3>Days: ".htmlspecialchars($row['Days Open'])."</h3>";
    echo "</div>";
    echo '<br>';
    }
}
?>
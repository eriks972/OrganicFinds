<?php
session_start();
?>
<header>
    <link rel="stylesheet" href="Test Home Style.css">
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
$result=$conn->query("Select * from Vendors");   
$rows=$result->num_rows;
echo "<form method='post' action='EventUpload.php'>";
echo "Select a vendor below: ";
echo "<br>";
echo "<select name='vendor' id='vendor'>";
for ($i=0;$i<$rows;$i++){
    $row=$result->fetch_array(MYSQLI_ASSOC);
    echo "<option value=".htmlspecialchars($row["ID"]).">".htmlspecialchars($row["Vendor_Name"])."</option>";
}
echo "</select>";
echo "<br>";
echo "<br>";

echo "Event Name: ";
echo "<br>";
echo "<input type='text' id='Ename' name='Ename'><br><br>";

echo "Event Description: ";
echo "<br>";
echo "<textarea id='Desc' name='Desc' rows='6' cols='50'>";
echo "</textarea>";
echo "<br>";
echo "<br>";

echo "Opening Date: ";
echo "<br>";
echo "<input type='date' id='StartDate' name='StartDate' max='2025-12-31'>";
echo "<br>";
echo "<br>";

echo "Closing Date: ";
echo "<br>";
echo "<input type='date' id='CloseDate' name='CloseDate' max='2025-12-31'>";
echo "<br>";
echo "<br>";

echo "Opening Time: ";
echo "<br>";
echo " <input type='time' id='start' name='start' min='00:00' max='24:00' required>";
echo "<br>";
echo "<br>";

echo "Closing Time: ";
echo "<br>";
echo "<input type='time' id='end' name='end' min='00:00' max='24:00' required>";
echo "<br>";
echo "<br>";

echo "Select the days of the week it's event is open: ";
echo "<br>";
echo "<input type='checkbox' id='monday' name='monday' value='Monday'>";
echo "<label for='Monday'>Monday</label><br>";
echo "<input type='checkbox' id='tuesday' name='tuesday' value='tuesday'>";
echo "<label for='tuesday'>Tuesday</label><br>";
echo "<input type='checkbox' id='wednesday' name='wednesday' value='Wednesday'>";
echo "<label for='Wednesday'>Wednesday</label><br>";
echo "<input type='checkbox' id='thursday' name='thursday' value='Thursday'>";
echo "<label for='Thursday'>Thursday</label><br>";
echo "<input type='checkbox' id='friday' name='friday' value='Friday'>";
echo "<label for='Friday'>Friday</label><br>";
echo "<input type='checkbox' id='saturday' name='saturday' value='Saturday'>";
echo "<label for='Saturday'>Saturday</label><br>";
echo "<input type='checkbox' id='sunday' name='sunday' value='Sunday'>";
echo "<label for='Sunday'>Sunday</label><br>";
echo "<br>";

echo "<input type='submit'>";
echo "</form>";
?>
<body>
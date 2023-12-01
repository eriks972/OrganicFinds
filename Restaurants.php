<?php
session_start();
?>
<link rel='stylesheet' href='Test Home Style.css'>
<link rel='stylesheet' href='Restaurant.css'>
<header>
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
<div class="topnav">
        <a href="index.php">Home</a>
        <a href="About Us.html">About Us</a>
        <a href="Search.php">Search</a>
        <a href="Products.html">Products</a>
        <a href="Recipes.php">Recipes</a>
        <a href="Gardening.html">Gardening</a>
        <a class="active" href="Restaurants.php">Restaurants</a>
        <a href="Vendors.php">Vendors</a>
      </div>
<!--<input type="button" value="Leave a review" onclick="location='About Us.html'" />-->
<input type="button" value="Leave a review" style="background-color: blue; color:white; font-size:20px;float:right" onclick="location='Rating.php'"/>
<?
if(isset($_SESSION['Username'])){
?>
<input type="button" value="Add a Restaurant" style="background-color: red; color:white; font-size:20px;float:right" onclick="location='RestaurantForm.php'"/>
<?
} else {
?>
<input type="button" value="Add a Restaurant" style="background-color: red; color:white; font-size:20px;float:right" onclick="location='RestaurantForm.php'" disabled/>
<?
}
?>
<br>
<br>
<?
require_once 'Credentials.php';
    $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
    if($conn->connect_error)
        die("Fatal error");
    $query="Select MAX(ID) from Restaurants;
        Select * from Reviews;
        Select * from Restaurants;";
    $conn->multi_query($query);
    $result=$conn->store_result();
    $row = mysqli_fetch_array($result);
    $Max=$row['MAX(ID)'];
    $conn -> next_result();
    $result2=$conn -> store_result();
    $rows=$result2->num_rows;
    $RatAve=array();
    for($i=1;$i<$Max+1;$i++){
        $total=0;
        $num=0;
        $result2->data_seek(0);
        for($i2=0;$i2<$rows;$i2++){
            $row3=$result2->fetch_array(MYSQLI_ASSOC);
            $ID=$row3["ID"];
            if($ID==$i){
                $total=$total+$row3["Star Rating"];
                $num++;
            }
        }
        if($total>0){
            $average=$total/$num;
        } else{
            $average="";
        }
        $string=strval($i);
        $RatAve[$string]=$average;
    }
    $conn -> next_result();
    $result3=$conn -> store_result();
    $rows2=$result3->num_rows;
    for($i3=0;$i3<$rows2;$i3++){
        $row4=$result3->fetch_array(MYSQLI_ASSOC);
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row4['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row4["website"]).'>'.htmlspecialchars($row4["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
        if($RatAve[$row4["ID"]]>1){
           echo number_format($RatAve[$row4["ID"]],2); 
        }
        echo '<br>';
        echo '<br>';
        echo $row4['review'];
        echo '<br>';
        echo '<br>';
        echo $row4['Address'];
        echo "</div>";
        echo '<br>';
    }
?>
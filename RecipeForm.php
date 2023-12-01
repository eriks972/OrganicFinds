<html>
<style>
div.scroll {
  background-color: #fed9ff;
  width: 160px;
  height: 150px;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: left;
  padding: 20px;
}
</style>
<header>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="Test Home Style.css">
        <img src="organicFindslogo2.jpg" width="400" height="256" class="center style="background-color: #109037;">
 </header>
     <body>
     <div class="topnav">
             <a href="index.html">Home</a>
             <a href="About Us.html">About Us</a>
             <a href="Search.php">Search</a>
             <a href="Products.html">Products</a>
             <a class="active" href="Recipes.php">Recipes</a>
             <a href="Gardening.html">Gardening</a>
             <a href="Restaurants.php">Restaurants</a>
             <a href="Vendors.php">Vendors</a>
           </div>
           <br>
<form enctype="multipart/form-data" action="RecipeUpload.php" method="POST">
           <label for="Ingredient">Ingredients:</label>
           <div class="scroll">
                <?
                require_once "Credentials.php";
                $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
                if($conn->connect_error)
                die("Fatal error");
                $query="Select * from Products";
                $result=$conn->query($query);
                $rows=$result->num_rows;
                for($i=0;$i<$rows;$i++){
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $number=$row["ID"];
                    $String2=$row["Name"];
                    echo '<input type=checkbox id='.htmlspecialchars($String2).' name='.htmlspecialchars($String2).' value='.htmlspecialchars($number).'>';
                    echo "<label for='Type'>".htmlspecialchars($String2)."</label><br>";
                    echo '<br>';
                }
                ?>
            </div>
            <br>
           <label for="Name">Recipe Name:</label>
           <input type="text" id="Rname" name="Rname" required><br><br>
           <label for="link">Recipe Link:</label>
           <input type="text" id="Link" name="Link"required><br><br>
           <label for="Meal">Meal Type:</label>
           <select name="Type" id="Type">
           <option value="Breakfast">Breakfast</option>
           <option value="Lunch">Lunch</option>
           <option value="Dinner">Dinner</option>
           <option value="Dessert">Dessert</option>
           <option value="Soup">Soup</option>
           <option value="Drink">Drink</option>
           <option value="Side">Side</option>
           </select>
           <br> <br>
           <label for="Diet">Diet:</label>
           <select name="Diet" id="Diet">
           <option value="None">None</option>
           <option value="Vegetarian">Vegetarian</option>
           <option value="Keto">Keto</option>
           <option value="Vegan">Vegan</option>
           </select>
           <br><br>
           <label for="Photo">Choose a Photo: </label>
           <input type="file" name="Photo"><br><br>
           <input type="submit">
</form>
</html>
<?php
?>
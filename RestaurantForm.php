<html>
<style>
label {
        display: inline-block;
        width: 150px;
      }
input[type=submit] {
        background-color: #62529c;
        border: none;
        color: #fff;
        padding: 15px 30px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
      }
</style>
<header>
        <link rel="stylesheet" href="Test Home Style.css">
        <img src="organicFindslogo2.jpg" width="400" height="256" class="center style="background-color: #109037;">
 </header>
     <body>
     <div class="topnav">
             <a href="index.html">Home</a>
             <a href="About Us.html">About Us</a>
             <a href="Search.php">Search</a>
             <a href="Products.html">Products</a>
             <a href="Recipes.html">Recipes</a>
             <a href="Gardening.html">Gardening</a>
             <a class="active" href="Restaurants.php">Restaurants</a>
             <a href="Vendors.php">Vendors</a>
           </div>
           <br>
<form enctype="multipart/form-data" action="RestaurantUpload.php" method="POST">
           <label for="Rname">Restaurant Name:</label>
           <input type="text" id="Rname" name="Rname" required><br><br>
           <label for="Address">Address:</label>
           <input type="text" id="Address" name="Address"required><br><br>
           <label for="Zipcode">Zipcode:</label>
           <input type="text" id="Zipcode" name="Zipcode"required><br><br>
           <label for="State">State:</label>
           <input type="text" id="State" name="State"required><br><br>
           <label for="Review">Review:</label>
           <input type="text" id="Review" name="Review"required><br><br>
           <label for="link">Restaurant website:</label>
           <input type="text" id="Link" name="Link"required><br><br>
           <label for="Photo">Choose a Photo: </label>
           <input type="file" name="Photo"><br><br>
           <input type="submit">
</form>
</html>
<?php
?>
<html>
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
             <a class="active" href="Recipes.php">Recipes</a>
             <a href="Gardening.html">Gardening</a>
             <a href="Restaurants.php">Restaurants</a>
             <a href="Vendors.php">Vendors</a>
           </div>
           <br>
</html>
<?php
    require_once 'Credentials.php';
    $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
    if($conn->connect_error)
        die("Fatal error");
    $query="Select * from Recipes";
    $result=$conn->query($query);
    $rows=$result->num_rows;
    echo '<form action="RecipeReviewPost.php" method="post">';
    echo 'Which Recipe are reviewing: ';
    echo '<br>';
    echo '<select id="Recipes" name="Recipes">';
    for($i=0;$i<$rows;$i++){
        $row=$result->fetch_array(MYSQLI_ASSOC);
        echo '<option value='.htmlspecialchars($row["ID"]).'>'.htmlspecialchars($row["Name"]).'</option>';
    }
    echo '</select>';
    echo '<br>';
    echo '<br>';
    ?>
    <label>Enter a rating (1-5): </label>
        <input type="number" id="rating" name="rating"><br>
        <br>
        <label>Expand on rating(optional): </label><br>
        <br>
        <input type="text" style="height: 200px; width: 1000px;" id="review" name="review"><br>
        <br>
        <input type="submit">
    </form>
    <?
?>
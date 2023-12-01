<?
session_start();
?>
<!DOCTYPE html>
<html>
<style>
    .accordion {
background-color: #eee;
color: #444;
cursor: pointer;
padding: 18px;
width: 100%;
text-align: left;
border: none;
outline: none;
transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
padding: 0 18px;
background-color: white;
display: none;
overflow: hidden;
}
.accordion a{
padding-right: 30px;
}
.tip{
padding: 0 18px;
background-color: white;
display: none;
overflow: hidden;
width: 600px;
transform: translate(-1px,-70px);
}
.tool{
padding: 0 18px;
background-color: white;
display: none;
overflow: hidden;
width: 600px;
transform: translate(105px,-70px);
}
div.scroll {
  background-color: #fed9ff;
  width: 160px;
  height: 150px;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: left;
  padding: 20px;
}
.Save{
  background-color: transparent; 
  color:black;                       
  font-size:20px;
  float:right;
}
</style>
<?
if(isset($_POST['sort'])){
    $sort=$_POST['sort'];
} else{
    $sort='';
}
$ID = array();
 $i=0;
 $meals=array("Breakfast","Lunch","Dinner","Dessert","Soup","Drink","Side");
            if(isset($_POST["Meal"])){
                $check=$_POST["Meal"];
            } else {
                $check="All";
            }
 $Diets=array("None","Vegetarian","Keto","Vegan");
            if(isset($_POST["Diet"])){
                $check2=$_POST["Diet"];
            } else {
                $check2="All";
            }
require_once 'Credentials.php'; 
                $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
                if($conn->connect_error)
                die("Fatal error");
                $query="Select * from Products Order by Name;";
                $query.="Select * from Recipes";
                $conn->multi_query($query);
                $result=$conn->store_result();
                $rows=$result->num_rows;
?>
<header>
    <link rel="stylesheet" href="Test Home Style.css">
    <link rel='stylesheet' href='Restaurant.css'>
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center" style="background-color: #109037;">
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
if(isset($_SESSION['Username'])){
?>
<input type="button" value="My Recipes" style="background-color: green; color:white; font-size:20px;float:right" onclick="location='myRecipe.php'"/>
<?    
} else {
?>
<p style="float:left; color:red">To Save your Recipes, Please Log In</p>
<input type="button" value="My Recipes" style="background-color: green; color:white; font-size:20px;float:right" Disabled/>
<?
}
?>
<input type="button" value="Leave a review" style="background-color: blue; color:white; font-size:20px;float:right" onclick="location='RecipeReview.php'"/>
<input type="button" value="Add Recipe" style="background-color: red; color:white; font-size:20px;float:right" onclick="location='RecipeForm.php'"/>
<br><br>
 <button class="accordion" style="background-color: blue;color: white;">Filter</button>
    <div class="panel" style="background-color:gray;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
            <body>
             <h2>Ingredents</h2>
            <div class="scroll">
                <?
                for ($b=0;$b<$rows;$b++){
                    $row2=$result->fetch_array(MYSQLI_ASSOC);
                    $String=$row2["Name"];
                    if(isset($_POST[$String])){
                     $ID[$i]=$_POST[$String];
                     $i++;
                    }
                }
                function check($num,$IDs){
                    for($b=0;$b<count($IDs);$b++){
                    if($num==$IDs[$b]){
                     return 1;
                    }
                 }
                return 0;
                } 

                $result->data_seek(0);
                for($i=0;$i<$rows;$i++){
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $number=$row["ID"];
                    $String2=$row["Name"];
                    if(check($number,$ID)==1){
                     echo '<input type=checkbox id='.htmlspecialchars($String2).' name='.htmlspecialchars($String2).' value='.htmlspecialchars($number).' checked>';
                     echo "<label for='Type'>".htmlspecialchars($String2)."</label><br>";
                     echo '<br>';
                    } else {
                     echo '<input type=checkbox id='.htmlspecialchars($String2).' name='.htmlspecialchars($String2).' value='.htmlspecialchars($number).'>';
                     echo "<label for='Type'>".htmlspecialchars($String2)."</label><br>";
                     echo '<br>';
                    }
                }
                ?>
            </div>
            <br>
            <h2>Meals</h2>
            <?
            if($check==""){
             echo "<input type='radio' id='All' name='Meal' value='All'checked>";
             echo "<label for='Type'>All</label><br>";
            } else if($check=="All"){
             echo "<input type='radio' id='All' name='Meal' value='All'checked>";
             echo "<label for='Type'>All</label><br>";
            } else {
             echo "<input type='radio' id='All' name='Meal' value='All'>";
             echo "<label for='Type'>All</label><br>";
            }
            for($m=0;$m<count($meals);$m++){
                $meal=$meals[$m];
                if($check==$meal){
                    echo '<input type=radio id='.htmlspecialchars($meal).' name="Meal" value='.htmlspecialchars($meal).' checked>';
                    echo "<label for='vehicle1'>".htmlspecialchars($meal)."</label><br>";
                } else {
                    echo "<input type='radio' id=".htmlspecialchars($meal)." name='Meal' value=".htmlspecialchars($meal).">";
                    echo "<label for='vehicle1'>".htmlspecialchars($meal)."</label><br>";
                }
            }
            ?>
            <br>
            <h2>Diet</h2>
            <?
            if($check2==""){
            echo "<input type='radio' id='All' name='Diet' value='All' checked>";
            echo "<label for='Type'>All</label><br>";
            } else if($check2=="All"){
            echo "<input type='radio' id='All' name='Diet' value='All' checked>";
            echo "<label for='Type'>All</label><br>";
            } else {
            echo "<input type='radio' id='All' name='Diet' value='All'>";
            echo "<label for='Type'>All</label><br>";
            }
            for($d=0;$d<count($Diets);$d++){
                $Diet=$Diets[$d];
                if($Diet==$check2){
                    echo '<input type=radio id='.htmlspecialchars($Diet).' name="Diet" value='.htmlspecialchars($Diet).' checked>';
                    echo "<label for='vehicle1'>".htmlspecialchars($Diet)."</label><br>";
                } else {
                    echo "<input type='radio' id=".htmlspecialchars($Diet)." name='Diet' value=".htmlspecialchars($Diet).">";
                    echo "<label for='vehicle1'>".htmlspecialchars($Diet)."</label><br>";
                }
            }
            ?>
            <input type="submit" name="submit" value="Submit">
         </body>
        </form>
</div>
 <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
        this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
        panel.style.display = "none";
        } else {
        panel.style.display = "block";
        }
        });
    }
</script>
<body>
<?
    function IngredentsCheck($ingredients,$id){
        $bools=array();
        $bs=0;
        for($nums=0;$nums<count($id);$nums++){
            for($nums2=0;$nums2<count($ingredients);$nums2++){
                if($id[$nums]==$ingredients[$nums2]){
                $bools[$bs]=1;
                $bs++;
                }
            }
        }
        if(count($bools)==count($id)){
            return 1;
        }
        return 0;
    } 

    if(count($ID)==0 && strcmp($check,"All")==0 && strcmp($check2,"All")==0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
        ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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

    } else if (count($ID)>=1 && strcmp($check,"All")==0 && strcmp($check2,"All")==0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $Ingredients=explode(",",$row3["Ingredient Code"]);
        if(IngredentsCheck($Ingredients,$ID)==1){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } else if(count($ID)==0 && strcmp($check,"All")!=0 && strcmp($check2,"All")==0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $word=$row3['Meal Type'];
        if(strcmp($word,$check)==0){
            echo "<div class=Restaurants>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
            echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
            echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
             ?>
            <form method='post' action='RecipeSave.php'>
            <?
            if(isset($_SESSION['Username'])){
            echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
            } else {
            echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
            }
            echo "</form>";
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
     } else if(count($ID)==0 && strcmp($check,"All")==0 && strcmp($check2,"All")!=0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $word2=$row3['Diet'];
        if(strcmp($word2,$check2)==0){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } else if(count($ID)>=0 && strcmp($check,"All")!=0 && strcmp($check2,"All")==0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $Ingredients=explode(",",$row3["Ingredient Code"]);
        $word=$row3['Meal Type'];
        if(IngredentsCheck($Ingredients,$ID)==1 && strcmp($word,$check)==0){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } else if(count($ID)>=0 && strcmp($check,"All")==0 && strcmp($check2,"All")!=0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $Ingredients=explode(",",$row3["Ingredient Code"]);
        $word2=$row3['Diet'];
        if(IngredentsCheck($Ingredients,$ID)==1 && strcmp($word2,$check2)==0){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } else if(count($ID)==0 && strcmp($check,"All")!=0 && strcmp($check2,"All")!=0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $word=$row3['Meal Type'];
        $word2=$row3['Diet'];
        if(strcmp($word,$check)==0 && strcmp($word2,$check2)==0){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } else if(count($ID)>=1 && strcmp($check,"All")!=0 && strcmp($check2,"All")!=0){
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
        $Ingredients=explode(",",$row3["Ingredient Code"]);
        $word=$row3['Meal Type'];
        $word2=$row3['Diet'];
        if(IngredentsCheck($Ingredients,$ID)==1 && strcmp($word,$check)==0 && strcmp($word2,$check2)==0){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row3['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row3["URL"]).'>'.htmlspecialchars($row3["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
         ?>
        <form method='post' action='RecipeSave.php'>
        <?
        if(isset($_SESSION['Username'])){
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).'>Save</button>';
        } else {
        echo '<button name="submit" type="submit" class="Save" value='.htmlspecialchars($row3["ID"]).' disabled>Save</button>';
        }
        echo "</form>";
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
     } 
 ?>
</body>
</html>
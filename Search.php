<!DOCTYPE html>
<html>
<?php
require_once 'Credentials.php';
$conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
if($conn->connect_error)
die("Fatal error");
$query="Select * from Restaurants;";
$query.="Select * from Vendors";
$conn->multi_query($query);
$result=$conn->store_result();
$rows=$result->num_rows;
if(isset($_POST['search'])){
    $search=$_POST['search'];
} else{
    $search='';
}
$input=$_POST['input'];
function check($check,$inVal,$value){
    if(strcmp($check,"ZipCode")==0){
        if($inVal==$value){
            return 1;
        }
        return 0;
    } else if (strcmp($check,"State")==0){
        if (strcasecmp($inVal,$value)==0){
            return 1;
        }
        return 0;
    } else if (strcmp($check,"name")==0){
        $pos1 = stripos($value, $inVal);
        if($pos1 !== false){
            return 1;
        }
        return 0;
    }
    return 0;
}
?>
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
<html>

<header>
    <link rel="stylesheet" href="Test Home Style.css">
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center" style="background-color: #109037;">
</header>

<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="About Us.html">About Us</a>
        <a class="active" href="Search.php">Search</a>
        <a href="Products.html">Products</a>
        <a href="Recipes.php">Recipes</a>
        <a href="Gardening.html">Gardening</a>
        <a href="Restaurants.php">Restaurants</a>
        <a href="Vendors.php">Vendors</a>
      </div>
      <br>
<form  method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
      <label for="search">Select what you want to search by: </label><br>
      <input type="radio" id="ZipCode" name="search" value="ZipCode" checked>
      <label for="ZipCode">ZipCode</label>
      <input type="radio" id="name" name="search" value="name">
      <label for="name">Name</label>
      <input type="radio" id="State" name="search" value="State">
      <label for="State">State</label><br>
      <br>
      <label for="search">Enter your search term below:  </label><br>
      <input type="text" id="input" name="input" required>
      <button type="submit">Submit</button>
</form>
      <br><br>
      <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d321518.7881409153!2d-73.41275180229317!3d40.817189090314756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1677198085721!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
      
      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Restaurants')">Restaurants</button>
        <button class="tablinks" onclick="openCity(event, 'Vendors')">Vendors</button>
        <!--<button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>-->
      </div>
      
      <!-- Tab content -->
      <div id="Restaurants" class="tabcontent">
        <?
        for($i=0;$i<$rows;$i++){
        $row=$result->fetch_array(MYSQLI_ASSOC);
        
        if(strcmp($search,"ZipCode")==0){
            $value=$row['zipcode'];
        } else if (strcmp($search,"State")==0){
             $value=$row['state'];
        } else if (strcmp($search,"name")==0){
            $value=$row['Name'];
        }
        if(check($search,$input,$value)==1){
        echo "<div class=Restaurants>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Photo']).'"width="100" height="105" style="float:left;padding-right: 10px;"/>';
        echo '<a style="font-size: 30px;"href='.htmlspecialchars($row["website"]).'>'.htmlspecialchars($row["Name"]).'</a>';
        echo "<span style='font-size:200%;color:yellow;'>&starf;</span>";
        echo '<br>';
        echo '<br>';
        echo $row['review'];
        echo '<br>';
        echo '<br>';
        echo $row['Address'];
        echo "</div>";
        echo '<br>';
        }
        }
        ?>
      </div>
      
      <div id="Vendors" class="tabcontent">
       <?
        $conn -> next_result();
        $result3 = $conn -> store_result();
        $rows2=$result3->num_rows;
        for($i=0;$i<$rows2;$i++){
        $row3=$result3->fetch_array(MYSQLI_ASSOC);
         if(strcmp($search,"ZipCode")==0){
            $value=$row3['ZipCode'];
        } else if (strcmp($search,"State")==0){
             $value=$row3['State'];
        } else if (strcmp($search,"name")==0){
            $value=$row3['Vendor_Name'];
        }
        if(check($search,$input,$value)==1){
             echo "<h1>".htmlspecialchars($row3['Vendor_Name'])."</h1>";
             echo "<h2>".htmlspecialchars($row3['Address'])."</h2>";
             if($row3['Deliever']==0){
                 echo "<h3>Deliever: No</h3>";
             } else {
                 echo "<h3>Deliever: Yes</h3>";
             }
             echo "<br>";
        }
        }
       ?>
      </div>
      
      <!--<div id="Tokyo" class="tabcontent">
        <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p>
      </div>-->
</body>

<script>
    function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>

</html>
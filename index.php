<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <header>
    <link rel="stylesheet" href="Test Home Style.css">
    <img src="organicFindslogo2.jpg" width="400" height="256" class="center">
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
        <a class="active" href="index.php">Home</a>
        <a href="About Us.html">About Us</a>
        <a href="Search.php">Search</a>
        <a href="Products.html">Products</a>
        <a href="Recipes.php">Recipes</a>
        <a href="Gardening.html">Gardening</a>
        <a href="Restaurants.php">Restaurants</a>
        <a href="Vendors.php">Vendors</a>
      </div>
      <h1 style="text-align: center; font-size: 40px; padding-right: 10px;">Welcome</h1>
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="numbertext">1 / 4</div>
      <img src="Barrels of Apple.jpg" style="width:100%">
      <div class="text">Barrels of Apple </div>
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">2 / 4</div>
      <img src="Chicken.jpg" style="width:100%">
      <div class="text">Happy Chicken</div>
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">3 / 4</div>
      <img src="Farm land.jpg" style="width:100%">
      <div class="text">A sunset over farmland</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">4 / 4</div>
        <img src="New Season.jpg" style="width:100%">
        <div class="text">A new farm season has started</div>
      </div>
  
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
  </div>
  <script>
    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
  </script>
</body>
</html>
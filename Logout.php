<?php
session_start();
session_destroy();
echo 'You have been Logged out';
echo '<a href="index.php">Home</a>';
?>
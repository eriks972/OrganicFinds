<?php
?>
<form action="NewAccount.php" method="post">
<label for="uname">Enter a Username:</label>
<input type="text" id="Uname" name="Uname"><br><br>
<label for="pword">Enter a Password:</label>
<input type="text" id="pword" name="pword"><br><br>
<label for="rePword">Reenter Password:</label>
<input type="text" id="repword" name="repword"><br><br>
<label for="account">Choose your account type: </label><br>
<input type="radio" id="normal" name="account" value="Normal">
<label for="normal">Normal</label><br>
<input type="radio" id="vendor" name="account" value="Vendor">
<label for="vendor">Vendor</label><br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?
?>

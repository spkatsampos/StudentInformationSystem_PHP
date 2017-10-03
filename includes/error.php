<?php
 error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED^E_WARNING); 
include ("main_header.php");
include ("mydomain.php");

?>



<?php



echo "<center>"; 
echo "<font color=\"#FF0000\"><strong><br>Προέκυψε απρόσμενο πρόβλημα!!!<br></strong></font>";
echo "<form><input type=\"button\" value=\"Πατήστε ΕΔΩ\" \n"; 
echo "onClick=\"window.location.href='$mydomain/index.php'\"></form> \n";
session_start();
session_destroy();
echo "</center>\n"; 
	
?>

<?php 
include ("header/footer.php");
?>



	
		
	
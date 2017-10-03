  <form name="form" method="post" action="testdatabase.php">
<select name="grade">
	<option value="0"  >0 </option>
	<option value="0.5" >0.5 </option>
	<option value="1"  >1 </option>
	<option value="1.5"  >1.5 </option>
	<option value="2" >2 </option>
	<option value="2.5"  >2.5 </option>
	<option value="3"  >3 </option>
	<option value="3.5"> 3.5 </option>
	<option value="4"  >4 </option>
	<option value="4.5" >4.5 </option>
	<option value="5"  >5 </option>
	<option value="5.5" >5.5 </option>
	<option value="6"  >6 </option>
	<option value="6.5" >6.5 </option>
	<option value="7"  >7 </option>
	<option value="7.5" >7.5 </option>
	<option value="8"  >8 </option>
	<option value="8.5" >8.5 </option>
	<option value="9"  >9 </option>
	<option value="9.5" >9.5 </option>
	<option value="10"  >10 </option>
</select>
<input type="submit" />
</form>

<?php include("database.php");
 error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED^E_WARNING); 
$var = $_POST['grade']; 
echo $var;
$var2=md5('liza');
echo $var2;
?>


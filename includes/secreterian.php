<?php
 error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED^E_WARNING); 
include ("main_header.php");
include ("mydomain.php");
include ("database.php");
?>
<?php 
 $today = date("d/m/Y"); 

session_start(); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}


$am=$_SESSION['am'];

$sql="select fname,lname from users where am='$am'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
$temp=mysql_Fetch_array($result);
if($num!=0){
$fname=$temp['fname'];
$lname=$temp['lname'];
echo "<font size=4px color=\"#3300FF\"><strong>Καλωσήρθες $fname $lname <br>$today</strong>";

}
?>
<div id="wrap">

<center>
<table id="table1">
<tr>
<td><a href="sec_user_insert.php"><img src="styles/basic/img/users.jpg" alt="some_text"/>  </a></td>
<td><a href="sec_lesson_insert.php"><img src="styles/basic/img/lessons.jpg" alt="some_text"/>  </a></td>
</tr>
<tr>
<td><a href="sec_insert_vevaioseis.php"><img src="styles/basic/img/vevaioseis.jpg" alt="some_text"/>  </a></td>
<td><a href="sec_dilosi.php"><img src="styles/basic/img/dilosima8imaton.jpg" alt="some_text"/>  </a></td>
</tr>
</table> 
	
	
</center>
<?php 
include ("header/footer.php");
?>
	
	
	
	
	
	
	
	
	





</div>






	</center>
</body>






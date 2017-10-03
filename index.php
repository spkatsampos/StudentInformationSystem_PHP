 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<link rel="stylesheet" href="includes/styles/basic/style.css" type="text/css" media="screen" />
<center>
	
	<?php
		include ("includes/header/header.php");
	?>
	<?php include("includes/mydomain.php");
	?>
	<?php 
	$username="";
	$password="";
	
	?>
	<?php
	
      include("includes/database.php");




if(isset($_POST['log'])&&($_POST['log']="Login")){
$username=$_POST['username'];
$password=$_POST['password'];

$error = 0;
			if ($username == "") {
			echo "<center><font color=\"#FF0000\">Δώστε Username!!<br></font></center>";
			$error = 1;
			
			               }
		    if ($password == "") {
			echo "<center><font color=\"#FF0000\">Δώστε Password!!<br></font></center>";
			$error = 1;
			
			               }
			
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η αυθεντικοποίηση δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else {
$password=md5($password);			
$sql="select username, password, role,am from users where username='$username' and password='$password'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);

if($num!=0){
session_start();
$temp=mysql_Fetch_array($result);
$_SESSION['am']=$temp['am'];



$role=$temp['role'];

switch($role){
case 'student';
$student='student';
session_register("student");
header("Location: $mydomain/includes/student.php");
break;
case 'professor';
$professor='professor';
session_register("professor");
header("Location: $mydomain/includes/professor.php");
break;
case 'secreterian';
$secreterian='secreterian';
session_register("secreterian");
header("Location: $mydomain/includes/secreterian.php");
break;
} 





}
else{echo "<center><font color=\"#FF0000\">Αποτυχία Αυθεντικοποίησης!!!<br></font></center>";}
}
}
?>
<link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
<div id="main">
        <form method="post" name="frmadd" action="index.php">
            <fieldset>
                <legend>Είσοδος</legend>
				<tr><td>Username:</td><td><input type="text" name="username"
				 maxlength="15"></td></tr><br>
				<tr><td>Password:</td><td><input type="password" name="password" value="" maxlength="15"></td></tr><br>
				<tr><td>&nbsp;</td><td><input name="log" type="submit" value="Login"></td></tr>
            </fieldset>
        </form>
    </div>
	

		
	
	
	<?php
		include ("includes/header/footer.php");
		
	?>
</center>


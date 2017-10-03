<?php
		include ("main_header.php");
	?>
	<?php
		include ("database.php");
	?>
	
	<?php
		include ("mydomain.php");
	?>
	<?php 
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
session_start();

if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>

	<?php
		//define the variables
			$am= "";
			?>
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Αναζήτηση") {
			//get new values to insert
			$am = $_POST['am'];
			
			
			
			$error = 0;
			if ($am == "") {
			echo "<font color=\"#FF0000\">Δώστε στοιχείο για αναζήτηση!<br></font>";
			$error = 1;
			
			               }
			
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η αναζήτηση δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else { 
						
						
									
								
$sql="select fname,lname,year,role from users where am='$am'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);

if($num!=0){

session_start();
$temp=mysql_Fetch_array($result);
$_SESSION['vevrole']=$temp['role'];
if($_SESSION['vevrole']!='student'){echo "<font color=\"#FF0000\"><strong><br>Η εγγραφή που βρέθηκε δεν αντιστοιχεί σε φοιτητή!!!!!<br></strong></font>";}
else {$_SESSION['vevfname']=$temp['fname'];
$_SESSION['vevlname']=$temp['lname'];
$_SESSION['vevyear']=$temp['year'];
$_SESSION['useridd']=$am;

header("Location: $mydomain/includes/sec_vevaioseis.php");}





			 }
else
{echo "<font color=\"#FF0000\"><strong><br>Δεν βρέθηκαν εγγραφές με αυτόν τον Αριθμό Μητρώου!!<br></strong></font>";


}

								
								 
				}  
	                                                                          }  
?>


<div id="wrap">
		<div id="menu">
		<a href="secreterian.php"><font class="menu">Αρχική </font></a>
		
			
			
			
			
			</div>
			 
	       <form name="contactform" method="post" action="sec_insert_vevaioseis.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Κωδικός Φοιτητη: *</td>
									<td><input type="text" name="am" maxlength="50" size="30" value=<?php echo $am ?>></td>
								</tr>
								
								
								
						</table>
						
								<center><input type="submit" name="submit" value="Αναζήτηση"></center>
						
				</form>	
		
		
		
		
		
    </div>
	<?php 
include ("header/footer.php");
?>
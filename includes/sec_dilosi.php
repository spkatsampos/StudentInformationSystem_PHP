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

session_start();
  error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>
	<?php $fname = "";
			$lname = "";
			$email = "";
			
			$am="";
			$role="";
			$today = date("Y");
			$year="";?>
<!-- Diadikasia Anazitisis------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
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
						
						
									
								
$sql="select am,fname,lname,year,role,email from users where am='$am'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);

if($num!=0){

session_start();
$temp=mysql_Fetch_array($result);
$_SESSION['role']=$temp['role'];
if($_SESSION['role']!='student'){
echo "<font color=\"#FF0000\"><strong><br>Η εγγραφή που βρέθηκε δεν αντιστοιχεί σε φοιτητή!!!!!<br></strong></font>";
}
else {
$_SESSION['fname']=$temp['fname'];
$_SESSION['lname']=$temp['lname'];
$_SESSION['year']=$temp['year'];
$_SESSION['email']=$temp['email'];
$_SESSION['sid']=$temp['am'];
}




			 }
else
{echo "<font color=\"#FF0000\"><strong><br>Δεν βρέθηκαν εγγραφές με αυτόν τον Αριθμό Μητρώου!!<br></strong></font>";


}

								
								 
				}  
	                                                                          }  
?>
<!--------------------Lessons------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
			
				if ((isset($_GET['id'])) && ($_GET['status']=='statement')) {
				 $id=$_GET['id'];
			     
				 session_start();
				 $sid=$_SESSION['sid'];
				 ////////////////////////
			     $sqla="select grade from student where lid='$id' and sid='$sid' and grade>=5";
                  $resulta=mysql_query($sqla);
                 $numa=mysql_num_rows($resulta);
                   $grade=0;
                  if($numa!=0){
                 $tempa=mysql_Fetch_array($resulta);
				 $grade=$tempa['grade'];
				              }
			////////////////////////////////////////////
			     if($grade<5){
				mysql_query("START TRANSACTION");
				$sql = "insert into student(lid, 
											sid,
											year,
											grade)
											values(
											'$id',
											'$sid',
											'$today',
											'0')";
									
							
				
										  
				$result = mysql_query($sql) or $msg[]="dat_er";
			
				if ($result) {
					echo "<font color=\"#3300FF\"><strong><br>Η δήλωση του μαθήματος πραγματοποιήθηκε με επιτυχία!!!<br></strong>";
					mysql_query("COMMIT");
				}
				else {
				echo "<font color=\"#FF0000\"><strong><br>Έχει γίνει δήλωση μαθήματος για φέτος!!!<br></strong>";
					mysql_query("ROLLBACK");
				     }
			                 }
						
			  else{echo "<font color=\"#FF0000\"><strong><br>Το μάθημα αυτό έχει περαστεί!!!<br></strong>";}
			                                                                     }
?>
						  
						  <?php
								$sql = "select  
								id,
								title,
								sem,
								ects,
								start_date,
								end_date,
								pam
						        from lessons,professor where professor.lid=id   ";	
								
								$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
						
						?>

<!-- Forma Anazitisis--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div id="wrap">
		<table class=main_menu>
			<tr>
				<td>
					<div id="menu">
		<a href="secreterian.php"><font class="menu">Αρχική </font></a>

			        </div>
					
             </td>
			 </tr>
			 </table>
			 
	       <form name="contactform" method="post" action="sec_dilosi.php">
						
						<table width="50%" class=form>
								<tr>
									<td>Κωδικός Φοιτητη: *</td>
									<td><input type="text" name="am" maxlength="50" size="30" value=<?php echo $am ?>></td>
								</tr>
								<tr>
							
								
								</tr>
								
									
									
								
						</table>
						<center><input type="submit" name="submit" value="Αναζήτηση"></center>
						
				</form>	
		
		
		
		
		
    </div>
<!-- Forma Anazitisis--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Forma Stoixeion Foititi-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

						
					
			
								<br>
								<table class="view">
								<tr>
								<th>Α.Μ</th>
								<th>Όνομα</th>
								<th>Επώνυμο</th>
							    <th>Email</th>
								<th>Έτος Εισαγωγής</th>
							
							
								
								
								</tr>
						
							<?php 
							session_start();
							if($_SESSION['role']=='secreterian'){ }
							else{
							
							
							?>
								<tr class="alt">
								<td><?php echo $_SESSION['sid']; ?></td>
								<td><?php echo $_SESSION['fname']; ?></td>
								<td><?php echo $_SESSION['lname']; ?></td>
							    <td><?php echo $_SESSION['email'];?></td>
								<td><center><?php echo $_SESSION['year']; ?></center></td>
								
								
			                    </tr>
								
						
								</table>
								<br><br><br>
								<?php } ?>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	</table>
						
				</form>	
		</div>
								<br>
								<table class="view">
								<tr>
								<th>Κωδικος Μαθήματος</th>
								<th>Τίτλος Μαθήματος</th>
								<th>Εξάμηνο</th>
								<th>ECTS</th>
								
								<th>Κωδικός Καθηγητή</th>
							
							
								
							
								 <th>Δήλωση</th>
								
								</tr>
						<?php
								while ($row = mysql_fetch_assoc($result)) {
						?>
							
								<tr class="alt">
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo $row['sem']; ?></td>
								<td><?php echo $row['ects']; ?></td>
					
								<td><?php echo $row['pam']; ?></td>
								
								
								
								
						
							
								
								
								</form>
								<td align="center"><a onClick="return confirm
('Είσαι σίγουρος ότι θες να δηλώση το μάθημα <?php echo $row['title']; ?> ?') "href="sec_dilosi.php?status=statement&id=<?php echo$row['id'];?>"><img src="styles/basic/img/check.png"></a></td>
			</tr>
							
							
						<?php		
								}
						?>	
									</table>
									
<?php 
include ("header/footer.php");
?>
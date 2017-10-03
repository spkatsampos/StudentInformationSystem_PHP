 <?php
		include ("main_header.php");
	?>
	<?php
		include ("database.php");
	?>
	<?php
		include ("sec_user_menu.php");
	?>
	<?php 

session_start();
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED^E_WARNING); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>
	
 <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
 <?php
			
				if ((isset($_GET['am'])) && ($_GET['status']=='delete')) {
				$am=$_GET['am'];
				mysql_query("START TRANSACTION");
				$sql1 = "delete FROM users
									WHERE
						            am = '$am' ";
				$sql2 = "delete FROM professor
									WHERE
						            pam='$am'";	
				
				$sql3 = "delete FROM student
									WHERE
						            sid='$am'";					
				
										  
				$result1 = mysql_query($sql1) or $msg[]="dat_er";
				$result2 = mysql_query($sql2) or $msg[]="dat_er";
				$result3 = mysql_query($sql3) or $msg[]="dat_er";
				if ($result1&&$result2&&result3) {
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br>Η διαγραφή του χρήστη ολοκληρώθηκε με επιτυχία!!!<br></strong>";
				}
				else {
					mysql_query("ROLLBACK");
				}
			}
	?>
 <?php
		//define the variables
			$fname = "";
			$lname = "";
			$mail = "";
			$address = "";
			$am="";
			$role="";
			$username="";
			$pwd="";
			$year="";
			
	?>
	

	
	<?php
			//------------------update xristi----------------------------
				if ( isset($_POST['submit']) && $_POST['submit'] == "update1") {
				$am=$_POST['am'];
				session_start();
			    $_SESSION['userid']=$am;
				
				$sql4 = "select am,
								fname,
								lname,
								email,
								address,
								year,
								username,
								password,
								role
						from users where am = '$am'";					
				$result4 = mysql_query($sql4) or die(header("Location: error.php?msg=dat_er"));
				
				$row = mysql_fetch_assoc($result4);
				$fname = $row['fname'];
				$lname = $row['lname'];
				$mail = $row['email'];
				$address = $row['address'];
				$year = $row['year'];
				$username = $row['username'];
				$pwd = $row['password'];
				$role= $row['role'];
			}
	?>	
	
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Ενημέρωση") {
			//get new values to insert
			session_start();
			$am = $_SESSION['userid'];
			
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$mail = $_POST['mail'];
			$address = $_POST['address'];
			$year = $_POST['year'];
			$username = $_POST['username'];
		
			$role= $_POST['role'];
			
			
			$error = 0;
			
			//check first_name
			if ($fname == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Όνομα!<br></font>";
			$error = 1;
			}

			//check last_name
			if ($lname == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το επώνυμο!<br></font>";
			$error = 1;
			}
			
			//check address
			if ($address == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε την διεύθυνση!<br></font>";
			$error = 1;
			}
			if ($mail == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το email!<br></font>";
			$error = 1;
			}
			if ($am == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον αριθμό μητρώου!<br></font>";
			$error = 1;
			}
			if ($year == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το έτος εισαγωγής!<br></font>";
			$error = 1;
			}
			if ($role== "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε την βαθμίδα!<br></font>";
			$error = 1;
			}
			if ($username == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Όνομα Χρήστη!<br></font>";
			$error = 1;
			}
			
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else { 
						//kane eisagogi tis times stin vasi
										
								mysql_query("START TRANSACTION");
								$sql5 = "update users set
													fname = '$fname',
													lname = '$lname',
													email = '$mail',
													address = '$address',
													year='$year',
													username='$username',
												
													role='$role'
										where am = '$am'";

								  $result5 = mysql_query($sql5) or die(header("Location: error.php?msg=dat_er")); 
								  if ($result5) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η επεξεργασία ολοκληρώθηκε με επιτυχία!!!<br></strong>";
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η επεξεργασία δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
			}
		}
	?>
	
	
						<?php
								$sql6 = "select am,
												fname,
												lname,
												email,
												address,
												year,
								                username,
												password,
												role
										from users";
								
								$result6= mysql_query($sql6) or die(header("Location: error.php?msg=dat_er"));
						
						?>
						<br>	
			<div id="wrap">
				<form name="contactform" method="post" action="sec_user_admin.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Όνομα: *</td>
									<td><input type="text" name="fname" maxlength="50" size="30" value=<?php echo $fname ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Επώνυμο: *</td>
									<td><input type="text" name="lname" maxlength="50" size="30" value=<?php echo $lname ?>> </td>
								</tr>
								<tr>
									<td class=form_subheader>Αριθμός Μητρώου: </td>
									<td><h3><?php echo $am?><h3></td>
								</tr>
								<tr>
									<td class=form_subheader>Email: *</td>
									<td><input type="text" name="mail" maxlength="80" size="30" value=<?php echo $mail ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Διεύθυνση: *</td>
									<td><input type="text" name="address" maxlength="30" size="30" value=<?php echo $address ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Έτος Εισαγωγής: * </td>
									<td><input type="text" name="year" maxlength="30" size="30" value=<?php echo $year ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Username: *</td>
									<td><input type="text" name="username" maxlength="80" size="30" value=<?php echo $username ?>></td>
								</tr>
								
								<tr>
									<td class=form_subheader>Ρόλος: <?php echo $role ?>*</td>
									<td><select name="role">
	                                <option value="<?php echo$role?>"  ><?php echo $role?> </option>
									<option value="secreterian"  >Γραμματεία </option>
									<option value="professor" >Καθηγητής </option>
									<option value="student"  >Φοιτητής </option>
			                       </select>
									</td>
								</tr>
								</tr>
								
						</table>
						       <center><input type="submit" name="submit" value="Ενημέρωση"></center>
						
						
						
						
				</form>	
				
<!------------------------------------------------------------------------------------------------------------------------------------->				
				        <form name="passform" method="post" action="sec_user_admin.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Νεο Password <?php echo $am ?> : </td>
									<td><input type="text" name="pwd" maxlength="80" size="30" value=""></td>
									<td align=left><input type="submit" name="submit" value="Αλλαγή Κωδικού"></td>
								</tr>
				        </table>
						
						 </form>
				      <?php 
					  if ( isset($_POST['submit']) && $_POST['submit'] == "Αλλαγή Κωδικού") {
		
			             session_start();
			              $am=$_SESSION['userid'];
						 
			             $password = md5($_POST['pwd']);
						
						  mysql_query("START TRANSACTION");
								$sql7 = "update users set
													password='$password'
										where am = '$am'";

								  $result7 = mysql_query($sql7) or die(header("Location: error.php?msg=dat_er")); 
								  if ($result7) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η αλλαγή του Password ολοκληρώθηκε με επιτυχία!!!<br></strong>";
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η επεξεργασία δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
					 
					  
					  }
					  
					  ?>
				
<!---------------------------------------------------------------------------------------------------------------------------------------------->				
				
				
				
				
				</div>
								<br>
								<table class="view">
								<tr>
								<th>Α.Μ</th>
								<th>Όνομα</th>
								<th>Επώνυμο</th>
								<th>E-mail</th>
								<th>Διεύθυνση</th>
								<th>Έτος</th>
								<th>Username</th>
							
								<th>Ρόλος</th>
								<th>Update</th>
								 <th>Delete</th>
								
								</tr>
						<?php
								while ($row = mysql_fetch_assoc($result6)) {
						?>
							
								<tr class="alt">
								<td><?php echo $row['am']; ?></td>
								<td><?php echo $row['fname']; ?></td>
								<td><?php echo $row['lname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['address']; ?></td>
								<td><?php echo $row['year']; ?></td>
								<td><?php echo $row['username']; ?></td>
								
								<td><?php echo $row['role']; ?></td>
								<td valign="center" align="center">
								<form name="updateform" method="post" action="sec_user_admin.php">
								<input type="hidden" name="status" value="update">
								<input type="hidden" name="am" value="<?php echo $row['am']; ?>">
								<BUTTON TYPE="submit" name="submit" value="update1" CLASS="image1"></BUTTON>
								</form>
								<td align="center"><a onClick="return confirm
			('Είσαι σίγουρος ότι θες να διαγράψεις τον χρήστη <?php echo $row['fname']." ".$row['lname']; ?> ?')" href="sec_user_admin.php?status=delete&am=<?php 
			echo$row['am']; ?>"><img src="styles/basic/img/delete.png"></a></td>
			</tr>
								
						<?php		
								}
						?>	
								</table>
	
	
				

</center>
<?php 
include ("header/footer.php");
?>
 
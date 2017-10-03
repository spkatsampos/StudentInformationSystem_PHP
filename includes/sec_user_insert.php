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
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>
<br>
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
		if ( isset($_POST['submit']) && $_POST['submit'] == "Καταχώριση") {
			//get new values to insert
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$mail = $_POST['mail'];
			$address = $_POST['address'];
			$am = $_POST['am'];
			$role = $_POST['role'];
			$username = $_POST['username'];
			$pwd =$_POST['pwd'];
			$year=$_POST['year'];
			
			
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
			if ($pwd == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον κωδικό!<br></font>";
			$error = 1;
			}
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else { 
						//kane eisagogi tis times stin vasi
						
								$pwd=md5($pwd);		
								
								mysql_query("START TRANSACTION");
								$sql = "insert into users
													(fname,
													 lname,
													 am,
													 year,
													 email,
													 address,
													 username,
													 password,
													 role
													)
													values
													('$fname',
													 '$lname',
													 '$am',
													 '$year',
													 '$mail',
													 '$address',
													 '$username',
													 '$pwd',
													 '$role'
													)";

								  $result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
								  if ($result) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
													$fname = "";
			                                        $lname = "";
			                                        $mail = "";
													$address = "";
													$am="";
													$role="";
													$username="";
													$pwd="";
													$year="";
													
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
			}
		}
	?>


		<div id="wrap">
		
	       <form name="contactform" method="post" action="sec_user_insert.php">
						
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
									<td class=form_subheader>Αριθμός Μητρώου: *</td>
									<td><input type="text" name="am" maxlength="80" size="30" value=<?php echo $am ?>></td>
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
									<td class=form_subheader>Password: *</td>
									<td><input type="text" name="pwd" maxlength="80" size="30" value=<?php echo $pwd ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Ρόλος: *</td>
									<td><select name="role">
	<option value="secreterian"  >Γραμματεία </option>
	<option value="professor" >Καθηγητής </option>
	<option value="student"  >Φοιτητής </option>
	</select>
									</td>
								</tr>
								
								
						</table>
						     <center><input type="submit" name="submit" value="Καταχώριση"></center>
						
				</form>	
		
		
		
		
		
    </div>
	<?php 
include ("header/footer.php");
?>
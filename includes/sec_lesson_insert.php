<?php
		include ("main_header.php");
	?>
	<?php
		include ("database.php");
	?>
	<?php
		include ("sec_lesson_menu.php");
	?>
<br>
	<?php
		//define the variables
			$title= "";
			$code="";
			$sem = "";
			$ects= "";
			$start_date = "";
			$end_date="";
			$professor="";
			
			
	?>
	<?php 

session_start();
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Καταχώριση") {
			//get new values to insert
			$code = $_POST['code'];
			$title = $_POST['title'];
			$sem = $_POST['sem'];
			$ects = $_POST['ects'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$professor = $_POST['professor'];
			
			
			
			$error = 0;
			
			//check first_name
			if ($title == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Τιτλο του Μαθήματος!<br></font>";
			$error = 1;
			}
              if ($code == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Κωδικό του Μαθήματος!<br></font>";
			$error = 1;
			}
			//check last_name
			if ($sem  == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το εξάμηνο του Μαθήματος!<br></font>";
			$error = 1;
			}
			
			//check address
			if ($ects == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τις ECTS!<br></font>";
			$error = 1;
			}
			if ($start_date == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε την Ημερομηνία Έναρξης!<br></font>";
			$error = 1;
			}
			
			if ($professor== "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Αριθμό Μητρώου Διδάσκοντα!<br></font>";
			$error = 1;
			}
		
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else { 
						//kane eisagogi tis times stin vasi
						
									
								
								mysql_query("START TRANSACTION");
								$sql = "insert into lessons
													(title,
													 id,
													 sem,
													 ects,
													 start_date,
													 end_date													
													)
													values
													('$title',
													 '$code',
													 '$sem',
													 '$ects',
													 '$start_date',
													 '$end_date'
													)";
								$sql2="insert into professor (pam,lid) values ('$professor','$code')";
							     $result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er")); 

								  $result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
								  if (($result)&&($result2)) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
													$title= "";
													$code="";
			                                        $sem = "";
			                                        $ects= "";
			                                        $start_date = "";
			                                        $end_date="";
			                                        $professor="";
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
			}
		}
	?>


		<div id="wrap">
		
	       <form name="contactform" method="post" action="sec_lesson_insert.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Κωδικός Μαθήματος: *</td>
									<td><input type="text" name="code" maxlength="50" size="30" value=<?php echo $code ?>></td>
								</tr>
								<tr>
							
									<td class=form_subheader>Τίτλος Μαθήματος: *</td>
									<td><input type="text" name="title" maxlength="50" size="30" value=<?php echo $title ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Εξάμηνο: *</td>
									<td><input type="text" name="sem" maxlength="50" size="30" value=<?php echo $sem ?>> </td>
								</tr>
								<tr>
									<td class=form_subheader>ECTS: *</td>
									<td><input type="text" name="ects" maxlength="80" size="30" value=<?php echo $ects ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Ημερομηνία Έναρξης: *</td>
									<td><input type="text" name="start_date" maxlength="80" size="30" value=<?php echo $start_date ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Ημερομηνία Λήξης: </td>
									<td><input type="text" name="end_date" maxlength="30" size="30" value=<?php echo $end_date ?>></td>
								</tr>
								<tr>
									<td class=form_subheader>Αριθμός Μητρώου Διδάσκοντα: *</td>
									<td><input type="text" name="professor" maxlength="80" size="30" value=<?php echo $professor ?>></td>
								</tr>
								
								
								
						</table> 
						          <center><input type="submit" name="submit" value="Καταχώριση"></center>
						
				</form>	
		
		
		
		
		
    </div>
	<?php 
include ("header/footer.php");
?>
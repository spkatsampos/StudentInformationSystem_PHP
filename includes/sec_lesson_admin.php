    <?php
		include ("main_header.php");
	?>
	<?php
		include ("database.php");
	?>
	<?php
		include ("sec_lesson_menu.php");
	?>
	<?php 

session_start();
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
	
 <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
 <?php
			
				if ((isset($_GET['id'])) && ($_GET['status']=='delete')) {
				 $id=$_GET['id'];
				mysql_query("START TRANSACTION");
				$sql = "delete FROM lessons
									WHERE
						            id = '$id' ";
				$sql2 = "delete FROM professor
									WHERE
						            lid='$id'";				
				
										  
				$result = mysql_query($sql) or $msg[]="dat_er";
				$result2 = mysql_query($sql2) or $msg[]="dat_er";
				if ($result&&$result2) {
					mysql_query("COMMIT");
					echo "<font color=\"#3300FF\"><strong><br>Η διαγραφή του μαθήματος ολοκληρώθηκε με επιτυχία!!!<br></strong>";
				}
				else {
					mysql_query("ROLLBACK");
				}
			}
	?>

<?php
		//define the variables
			$title= "";
			$id="";
			$sem = "";
			$ects= "";
			$start_date = "";
			$end_date="";
			$pam="";
			
			
	?>
	
	<?php
			//------------------update xristi----------------------------
				if ( isset($_POST['submit']) && $_POST['submit'] == "update1") {
				$id=$_POST['id'];
				session_start();
				$_SESSION['lessonid']=$id;
				$sql = "select id,title,sem,ects,start_date,end_date,pam from lessons,professor where professor.lid='$id' and lessons.id = '$id'";		
					
				$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
				
			
				$row = mysql_fetch_assoc($result);
			$id = $row['id'];
			$title = $row['title'];
			$sem = $row['sem'];
			$ects = $row['ects'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
		     $pam = $row['pam'];   
			}
	?>
	
	
	<?php
		if ( isset($_POST['submit']) && $_POST['submit'] == "Ενημέρωση") {
			//get new values to insert
			session_start();
			$id = $_SESSION['lessonid'];
			$title = $_POST['title'];
			$sem = $_POST['sem'];
			$ects = $_POST['ects'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$pam = $_POST['pam'];
			
			
			$error = 0;
			
			//check first_name
			

			if ($title == "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Τιτλο του Μαθήματος!<br></font>";
			$error = 1;
			}
              if ($id == "") {
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
			
			if ($pam== "") {
			echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε τον Αριθμό Μητρώου Διδάσκοντα!<br></font>";
			$error = 1;
			}
			
			
			if ($error) {
						echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
			}
			else { 
						//kane eisagogi tis times stin vasi
										
								mysql_query("START TRANSACTION");
								$sql = "update lessons set
													id = '$id',
													title = '$title',
													sem = '$sem',
													ects = '$ects',
													start_date='$start_date',
													end_date='$end_date'
										where id = '$id'";
								$sql2="update professor set pam='$pam' where lid='$id'";

								  $result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er")); 
								  $result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er")); 
								  if (($result)&&($result2) ){     
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
								$sql = "select  
								id,
								title,
								sem,
								ects,
								start_date,
								end_date,
								pam
						        from lessons,professor where lid=id   ";	
								
								$result = mysql_query($sql) or die(header("Location: error.php?msg=dat_er"));
						
						?>
		<center>
						<br>	
			<div id="wrap">
		
	       <form name="contactform" method="post" action="sec_lesson_admin.php">
						
						<table width="50%" class=form>
								<tr>
									<td class=form_subheader>Κωδικός Μαθήματος: *</td>
									<td><h3><?php echo $id ?><h3></td>
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
									<td><input type="text" name="pam" maxlength="80" size="30" value=<?php echo $pam ?>></td>
								</tr>
								
							
								
						</table>
						<center><input type="submit" name="submit" value="Ενημέρωση"></center>
				</form>	
		</div>
								
								<table class="view">
								<tr>
								<th>Κωδικος Μαθήματος</th>
								<th>Τίτλος Μαθήματος</th>
								<th>Εξάμηνο</th>
								<th>ECTS</th>
								<th>Ημερομηνία Έναρξης</th>
								<th>Ημερομηνία Λήξης</th>
								<th>Κωδικός Καθηγητή</th>
							
							
								
								<th>Update</th>
								 <th>Delete</th>
								
								</tr>
						<?php
								while ($row = mysql_fetch_assoc($result)) {
						?>
							
								<tr class="alt">
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo $row['sem']; ?></td>
								<td><?php echo $row['ects']; ?></td>
								<td><?php echo $row['start_date']; ?></td>
								<td><?php echo $row['end_date']; ?></td>
								<td><?php echo $row['pam']; ?></td><td valign="center" align="center">
								<form name="updateform" method="post" action="sec_lesson_admin.php">
								<input type="hidden" name="status" value="update">
								<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<BUTTON TYPE="submit" name="submit" value="update1" class="image1"></BUTTON>
								</form>
								<td align="center"><a onClick="return confirm
			('Είσαι σίγουρος ότι θες να διαγράψεις τον μάθημα <?php echo $row['title']; ?> ?')"href="sec_lesson_admin.php?status=delete&id=
			<?php 
			echo$row['id']; ?>"><img src="styles/basic/img/delete.png"></a></td>
			</tr>
							
							
						<?php		
								}
						?>	
									</table>
	
	
		

</center>
<?php 
include ("header/footer.php");
?>
 
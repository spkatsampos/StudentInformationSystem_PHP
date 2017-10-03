
 <?php
		include ("main_header.php");
		 include("mydomain.php");
	?>
	<?php
		include ("database.php");
	?>
<?php $fname = "";
	  $lname = "";
	  $today = date("d/m/Y"); 
	 
  
			?>
<?php 
 error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED^E_WARNING); 

session_start();
if(!session_is_registered(professor)){
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
echo "<font size=4px color=\"#3300FF\"><strong>Καλωσήρθες Dr. $fname $lname <br>$today</strong>";

}
////////////////////////////////////////////////////////////////////////////////
                    $sql2 = "select  
								id,
								title,
								sem,
								ects
								
								
								from lessons,professor where lessons.id=professor.lid and professor.pam='$am' ";	
								
								$result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er"));




////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<br>
								<table class="view">
								<tr>
								<th>Κωδικος Μαθήματος</th>
								<th>Τίτλος Μαθήματος</th>
								<th>Εξάμηνο</th>
								<th>ECTS</th>
								 <th>Εμφάνιση Φοιτητών</th>
								
								</tr>
						<?php
								while ($row2 = mysql_fetch_assoc($result2)) {
						?>
							
								<tr class="alt">
								<td><?php echo$row2['id']; ?></td>
								<td><?php echo $row2['title']; ?></td>
								<td><?php echo $row2['sem']; ?></td>
								<td><?php echo $row2['ects']; ?></td>
								
                                <form name="updateform" method="post" action="professor.php">
								<input type="hidden" name="status" value="update">
								<input type="hidden" name="id" value="<?php echo$row2['id']; ?>">
								<td><center><BUTTON TYPE="submit" name="submit" value="update" CLASS="image2"></BUTTON></center></td>
								</form>
			</tr>
							
							
						<?php		
								}
						?>	
									</table><br><br>


<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <?php                       if ( isset($_POST['submit']) && $_POST['submit'] == "update") {
			                   $year= date("Y");
			                   $lid = $_POST['id'];
								
                                $sql3 = "select am,fname,lname,grade from users,student where users.am=student.sid and student.lid='$lid' and student.year='$year'   ";	
								$result3 = mysql_query($sql3) or die;
								session_start();
								$_SESSION['lessonid']=$lid;
								 $n=mysql_num_rows($result3);
								 ///////////////////////////
								 $sql4 = "select title from lessons where id='$lid'";
								 $result4=mysql_query($sql4);
								 $row4 = mysql_fetch_assoc($result4);
								 echo "<center><br>Το μάθημα <i><u>";
								 echo$row4['title'];
								 echo "</u></i> το έχουν δηλώσει ".$n ." φοιτητές<br><br></center>";
								 //////////////////////////////
								}
					
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->									
							<table class="view">
								<tr>
								<th>Αριθμός Μητρώου</th>
								<th>Όνομα</th>
								<th>Επώνυμο</th>
								<th>Βαθμός</th>
								<th>Ορισμός Βαθμού</th>
			
								<th>Καταχώριση Βαθμού</th>
								
								</tr>
						<?php
								while ($row3 = mysql_fetch_assoc($result3)) {
						?>
							
								<tr class="alt">
								<td><?php echo$row3['am']; ?></td>
								<td><?php echo $row3['fname']; ?></td>
								<td><?php echo $row3['lname']; ?></td>
								<td><?php echo $row3['grade']; ?></td>
								
					
			
								<form name="updateform2" method="post" action="professor.php">
								<td> <select name="grade">
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
</select></td>
								
								<input type="hidden" name="am" value="<?php echo$row3['am']; ?>">
								<td><center><BUTTON TYPE="submit" name="submit" value="insert" CLASS="image3"></BUTTON></center></td>
			                    </tr>
							</form>
							
						<?php		
								}
						?>	
									</table>		
									
									
<!------------------------------------------------------------------------------------------------------------------------------------>
		<?php
		       
			     if ( isset($_POST['submit']) && $_POST['submit'] == "insert") {
			       $sid = $_POST['am'];
				  $grade = $_POST['grade'];
                  $year= date("Y");			
session_start();
$lid=$_SESSION['lessonid'];				  
			   mysql_query("START TRANSACTION");
								$sql5 = "update student set
													grade = '$grade'
													
													
										            where sid = '$sid' and lid='$lid'" ;

								  $result5 = mysql_query($sql5) or die;
								  if ($result5) {     
												mysql_query("COMMIT");
												echo "<font color=\"#3300FF\"><strong><br>Ο Βαθμός καταχωρήθηκε με επιτυχία!!!<br></strong>";
											  }
								  else {
												mysql_query("ROLLBACK");
												echo "<font color=\"#FF0000\"><strong><br>Η επεξεργασία δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
											  }
		
		                                                                        }
		
		
		?>
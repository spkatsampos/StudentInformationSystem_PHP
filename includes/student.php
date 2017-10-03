
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
  
			;?>

<?php 
 error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 

session_start();
if(!session_is_registered(student)){
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

 





								$sql2 = "select  
								id,
								title,
								sem,
								ects,
								grade,
								year
								from lessons,student where lessons.id=student.lid and student.sid='$am' ";	
								
								$result2 = mysql_query($sql2) or die(header("Location: error.php?msg=dat_er"));
								
				                
						
						?>
						

								<br><br><center><h3>Αναλυτική Βαθμολογία</h3></center>
								<table class="view">
								<tr>
								<th>Κωδικος Μαθήματος</th>
								<th>Τίτλος Μαθήματος</th>
								<th>Εξάμηνο</th>
								<th>Έτος</th>
								<th>ECTS</th>
								<th>Βαθμός</th>
								</tr>
						<?php
								while ($row = mysql_fetch_assoc($result2)) {
						?>
							
								<tr class="alt">
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo $row['sem']; ?></td>
							    <td><?php echo $row['year']; ?></td>
								<td><?php echo $row['ects']; ?></td>
								<td><?php echo $row['grade']; ?></td>
								
								</form>
								
			                    </tr>
							
							
						<?php		
								}
						?>	
									</table>
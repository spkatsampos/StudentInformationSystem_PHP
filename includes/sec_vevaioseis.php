<?php 

session_start();
error_reporting (E_ALL ^ E_NOTICE^E_DEPRECATED); 
if(!session_is_registered(secreterian)){
session_destroy();
header("Location: $mydomain/index.php");}

?>

<?php

session_start();
$now=date("Y");
$fname=$_SESSION['vevfname'];
$lname=$_SESSION['vevlname'];
$am=$_SESSION['useridd'];
$year=$_SESSION['vevyear'];
$into='Εισιτηριες Εξετάσεις';
$etos=$now-$year;

?>
<head>




<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
<center>
 <A HREF="javascript:window.print()"><IMG SRC="styles/basic/img/blogo.jpg" BORDER="0" ></A>
  
</center>
<title>University of Kyklades</title>
</head>
<body>



<center>
<h1>Πανεπιστήμιο Κυκλάδων</h1>
<h2>Τμήμα: Μηχανικών Σχεδίασης Ποδηλάτων</h2>
</center>
<br><br>

<center>
<table id="table2";>
<td>
Αριθμ. Πρωτ:.......


<center>
<h2>Βεβαίωση Σπουδων</h2>
</center>
Βεβαιώνεται ότι ο <?php echo $fname ?> <?php echo $lname ?> με αριθμό μητρώου <?php echo $am ?> ,είναι φοιτητής του<br>
 <?php echo $etos?>ου έτος του τμήματος Μηχανικών Σχεδίασης Ποδηλάτων του Πανεπιστημίου<br>
Κυκλάδων για το ακαδημαϊκό έτος <?php echo $now ?><br>
Ο ανωτέρω έκανε εγγραφή για πρώτη φορά το ακαδημαϊκό έτος <?php echo $year ?><br>
Τρόπος αρχικής Εγγραφής: <?php echo $into ?> <br>
Σύνολο ετών φοίτησης: 5 <br><br>
Η βεβαίωση εκδίδεται για κάθε νόμιμη χρήση<br><br>
                                                <p align=right>  Ο/Η Γραμματέας του τμήματος</p>
</td>
												  </table></center>










</body>
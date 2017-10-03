<?php
		include ("main_header.php");
	?>

<link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
<div id="main">
        <form method="post" name="frmadd" action="includes/authentication.php">
            <fieldset>
                <legend>Εισαγωγή Χρήστη</legend>
				<table >
				<tr><td>Όνομα:</td><td><input type="text" name="fname"
				 maxlength="15"></td></tr><br>
				 
				 <tr><td>Επώνυμο:</td><td><input type="text" name="lname"
				 maxlength="15"></td></tr><br>
				 
				 <tr><td>Αριθμός Μητρώου:</td><td><input type="text" name="am"
				 maxlength="15"></td></tr><br>
				 
				 <tr><td>e-mail:</td><td><input type="text" name="mail"
				 maxlength="15"></td></tr><br>
				 
				 <tr><td>Διεύθυνση:</td><td><input type="text" name="address"
				 maxlength="15"></td></tr><br>
				 
				 <tr><td>Username:</td><td><input type="text" name="username"
				 maxlength="15"></td></tr><br>
				 
				 
				 <tr><td>Password:</td><td><input type="password" name="pwd" value="" maxlength="15"></td></tr><br>
				 <tr><td>Βαθμήδα:</td><td><input type="text" name="role"
				 maxlength="15"></td></tr><br>
				 <br>
				<tr><td>&nbsp;</td><td><input name="log" type="submit" value="Καταχώρηση"></td></tr>
				</table>
				
            </fieldset>
        </form>
    </div>
<?php include("database.php");
include("mydomain.php");



if(isset($_POST['log'])&&($_POST['log']="Login")){
$username=$_POST['username'];
$password=md5($_POST['pwd']);

}
$sql="select username, password, role from users where username='$username' and password='$password'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);

if($num!=0){
session_start();
$temp=mysql_Fetch_array($result);
$_SESSION['role']=$temp['role'];
$_SESSION['username']=$temp['username'];
$role=$_SESSION['role'];

switch($role){
case 'student';
header("Location: $mydomain/includes/student.php");
break;
case 'professor';
header("Location: $mydomain/includes/professor.php");
break;
case 'secreterian';
header("Location: $mydomain/includes/secreterian.php");
break;
} 
session_destroy();




}
else
{

header("Location: $mydomain/includes/error.php");
session_destroy();
exit();
}

?>
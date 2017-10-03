<?php 
include ("mydomain.php");


session_start();
session_destroy();

header("Location: $mydomain/index.php");

?>
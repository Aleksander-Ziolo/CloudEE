<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$login=$_POST["login"];
$login = secure_string($connect, $login);
$password=$_POST["password"];
$password = secure_string($connect, $password);
//$password=sha1(sha1($password));
if(mysqli_connect_errno()==0)
{
  $result=$connect->query("SELECT * From admins$dbprefix WHERE login='$login' AND password='$password'");
  
  if(mysqli_num_rows($result) > 0){
    $row=$result->fetch_assoc();
    $_SESSION['login']=$login;
    $_SESSION['privilige_lvl']=$row['privilige_lvl'];
    header("Location: accountmanager.php");
		die();
  }
  else{
    session_unset();
    session_destroy();
    header("Location: adminpanel.php?err=1");
    die();
  }
}

?>
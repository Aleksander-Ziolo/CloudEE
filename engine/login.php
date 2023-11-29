<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$login=$_POST["login"];
$login = secure_string($connect, $login);
$password=$_POST["password"];
$password = secure_string($connect, $password);
if(mysqli_connect_errno()==0)
{
  $result=$connect->query("SELECT * From users$dbprefix WHERE login='$login'");
  
  if(mysqli_num_rows($result) > 0){
    $row=$result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['login']=$login;
      $_SESSION['permissions']=$row['permissions'];
      $_SESSION['storage']=$row['storage'];
      $_SESSION['usedspace']=$row['usedspace'];
      $_SESSION['key'] = hash('sha256', $row['password']);
      header("Location: filemanager.php");
      die();
    }
    else{
      session_unset();
      session_destroy();
      header("Location: loginform.php?err=1");
      die();
    }
  }
  else{
    session_unset();
    session_destroy();
    header("Location: loginform.php?err=1");
    die();
  }
}

?>

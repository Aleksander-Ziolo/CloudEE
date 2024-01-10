<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$login=$_POST["login"];

$id=$_POST['id'];
settype($id, "integer");
$login = secure_string($connect, $login);
$storage=$_POST["storage2"];
settype($storage, "integer");
$password = secure_string($connect, $password);
if(mysqli_connect_errno()==0)
{
  
    //header("Location: accountmanager.php");
    $result = $connect->query("UPDATE users$dbprefix SET storage = $storage WHERE id = 38 "); 

    
    header("Location: accountmanager.php");
    die();
}

  else{
    session_unset();
    session_destroy();
    header("Location: accountmanager.php");
    die();
  }


?>
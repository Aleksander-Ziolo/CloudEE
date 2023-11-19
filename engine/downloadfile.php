<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])){
    $login = $_SESSION['login'];
    $id = secure_string($connect, $_POST['id']);
    $result = $connect->query("SELECT name,path FROM files$dbprefix WHERE id='$id' AND owner='$login'");
    $row = $result->fetch_assoc();
    $path = $row['path'];
    $name = $row['name'];
    if(!empty($path) && file_exists($path)){ //sprawdzanie, czy plik istnieje
      header('Content-Disposition: attachment; filename=' . $name); //ustawianie pierwotnej nazwy pliku
      readfile($path); //rozpoczecie pobierania
    }
    else{
      header("Location: ../index.php");
      die();
    }
  }
  else{
    header("Location: ../index.php");
    die();
  }
}
?>

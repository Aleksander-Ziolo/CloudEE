<?php
require_once("config.php");
require_once("addons.php");

session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login']) && isset($_SESSION['key'])){
    $login = $_SESSION['login'];
    $userId = $_SESSION['userId'];
    $id = secure_string($connect, $_POST['id']);
    $result = $connect->query("SELECT name,path,checksum FROM files$dbprefix WHERE id='$id' AND owner='$userId'");
    $row = $result->fetch_assoc();
    $path = $row['path'];
    $name = $row['name'];
    $checksum = $row['checksum'];
    if(!empty($path) && file_exists($path)){ //sprawdzanie, czy plik istnieje
      decrypt($path, $path.".tmp", $_SESSION['key']);
      if(hash_equals($checksum, hash_file('sha256', $path.".tmp"))){
        header('Content-Disposition: attachment; filename=' . $name); //ustawianie pierwotnej nazwy pliku
        readfile($path.".tmp"); //rozpoczecie pobierania
        unlink($path.".tmp"); //usun odszyfrowana kopie po pobraniu
      }
      else{
        unlink($path.".tmp"); //usun odszyfrowana kopie
        header("Location: filemanager.php?error=1");
        die();
      }
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
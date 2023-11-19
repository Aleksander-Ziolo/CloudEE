<?php
session_start();
if (isset($_SESSION["login"])){
  header("Location: engine/filemanager.php");
  die();
}
else{
  header("Location: engine/loginform.php");
  die();
}
?>

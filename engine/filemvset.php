<?php
session_start();
if(isset($_GET['move']) && isset($_GET['pid'])){
  $id=intval($_GET['move']);
  $pid=intval($_GET['pid']);
  $_SESSION['move']=$id;
  header("Location: filemanager.php?pid=$pid");
  die();
}
else{
  header("Location: ../index.php");
  die();
}
?>

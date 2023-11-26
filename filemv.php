<?php
function refresh_usedspace($connect, $username, $dbprefix){
  $result = $connect->query("SELECT sum(size) AS size FROM files$dbprefix WHERE owner='$username';");
  $row = $result->fetch_assoc();
  $size = intval($row['size']);
  $result = $connect->query("UPDATE users$dbprefix SET usedspace=$size WHERE login='$username';");
}


require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0){
  if(isset($_GET['id']) && isset($_GET['pid']) && isset($_GET['action']) && isset($_SESSION['login'])){
    $id=intval($_GET['id']);
    if($id<1){
      header("Location: filemanager.php");
      die();
    }
    $pid=intval($_GET['pid']);
    $action=intval($_GET['action']);
    $owner=$_SESSION['login'];
    unset($_SESSION['move']);
    if($action==0){
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else if($action==1){ //kopiowanie
      $result = $connect->query("SELECT * FROM files$dbprefix WHERE id='$id' AND owner='$owner' ");
      $row = $result->fetch_assoc();
      $name = $row['name'];
      $ext = $row['ext'];
      $type = $row['type'];
      $date = date('Y-m-d H:i:s', time());
      $size = $row['size'];
      $path = $row['path'];
      $result = $connect->query("INSERT INTO files$dbprefix VALUES ('', '$pid', '$name', '$ext', '$owner', '$type', '$date', '$size', '$path')");
      refresh_usedspace($connect, $owner, $dbprefix);
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else if($action==2){ //przenoszenie
      $result = $connect->query("UPDATE files$dbprefix SET pid='$pid' WHERE id='$id' AND owner='$owner' AND type='FILE' ");
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else{
      header("Location: filemanager.php?pid=$pid");
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
?>

<?php
require_once("config.php");
require_once("addons.php");

header("Location: filemanager.php?error=2"); //function disabled - encryption not supported
die();

session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])) {
    $id = $_POST['id'];
    $id = secure_string($connect, $id);
    $current_dir = $_POST['pid'];
    $current_dir = htmlspecialchars($current_dir);
    $login = $_SESSION['login'];
    $userId=$_SESSION['userId'];
    $result = $connect->query("SELECT name,ext,path FROM files$dbprefix WHERE id='$id' AND owner='$userId' AND type='FILE'");
    $row = $result->fetch_assoc();
    $filename = $row['name'];
    $ext = $row['ext'];
    $path = $row['path'];
  }
  else{
    header("Location: ../index.php");
    die();
  }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title><?php echo $filename; ?> - File Viewer - <?php echo $project_title;?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   
	   <link rel="stylesheet" href="..\css\openfile.css">
	   
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >
	
	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
	<div class="container">
    <form method="get" action="filemanager.php">
      <input type='hidden' name='pid' value=
      <?php echo $current_dir; ?>
      >
      <button type='submit' class="btn btn-primary style-btn">Return to Explorer</button>
    </form>
    
      <?php
	  
	  if($ext!=="pdf"){
		echo "<h1 class='text-center text-style'><?php echo $filename; ?></h1>";
	  }
	  
	  
      if($ext==="mp4" || $ext==="webm" || $ext==="ogg"){ //video player
        echo "<video controls autoplay style='width:600px;'>";
        echo "<source src='".$path."' type='video/".$ext."'>";
        echo "Your browser does not support HTML5 video.";
        echo "</video>";
		
      }
      else if($ext==="mp3" || $ext==="wav" || $ext==="flac"){ //audio player
        if($ext==="mp3") $ext = "mpeg";
        echo "<audio controls autoplay class='music'>";
        echo "<source src='".$path."' type='audio/".$ext."'>";
        echo "Your browser does not support HTML5 audio.";
        echo "</audio>";
      }
      else if($ext==="jpg"|| $ext==="jpeg" || $ext==="png" || $ext==="bmp" || $ext==="gif" || $ext==="tiff"){ //zdjecia
        echo "<embed src='".$path."' width='600px' class='center-img img-responsive'>";
      }
	  else if($ext==="pdf"){
      }
	  else{
        echo "Preview unavailable.";
      }
      ?>
	  
	  </div>
	  <?php
	  if($ext==="pdf"){
        echo "<embed class='pdf-view' src='".$path."' alt='pdf' pluginspage='http://www.adobe.com/products/acrobat/readstep2.html'>";
      }
	  ?>
	  <!-- include javascript, jQuery FIRST -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../include/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
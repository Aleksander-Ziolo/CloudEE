<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!isset($_SESSION['login'])){ //sprawdzanie czy zalogowany
  header("Location: ../index.php");
  die();
}
$login = $_SESSION['login'];
$userId=$_SESSION['userId'];
$stat = new Statistics($connect, $userId, $dbprefix); //dostep do statystyk
if(!isset($_GET['pid'])) $current_dir=0; //sprawdzanie, w jakim katalogu sie znajdujemy
else{
  $current_dir=secure_string($connect, $_GET['pid']);
}
if(mysqli_connect_errno()==0) //pobieranie danych z bazy
{
  if($current_dir!=0){ //ustalanie nazwy katalogu, w ktorym jestesmy
    $result = $connect->query("SELECT name,pid,type FROM files$dbprefix WHERE id='$current_dir' AND owner='$userId'");
    $row = $result->fetch_assoc();
    $dir_name = $row['name'];
    $dir_parent = $row['pid'];
    $dir_verify = $row['type'];
    if($dir_verify !== "DIR"){
      header("Location: ../index.php"); //Blad: obiekt nie jest katalogiem
      die();
    }
  }
  else{
    $dir_name = "Katalog główny";
    $dir_parent = 0;
  }
  //pobieranie listy plikow
 $files = array();
 $result = $connect->query("SELECT id,name,ext,type,updated,size FROM files$dbprefix WHERE pid='$current_dir' AND owner='$userId'");
 while($row = $result->fetch_assoc()){
 $files[] = $row;
 }
 $num_of_files = count($files);
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	  <!--
  //////////////////////////////
  //                          //
  // Pamiętaj, by dodać CSS   //
  //   i pliki bootstrapa     //
  //                          //
  //////////////////////////////
  -->
	   <title> <?php echo $dir_name." - Files of ".$login." - ".$project_title; ?></title>
	   <meta charset="utf-8">

	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link rel="stylesheet" href="..\css\panelstat.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a href="../index.php"><img class="navbar-brand img" src="../img/clouds_logo2.png" alt="<?php echo $project_title;?>"></a>
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="myNavbar">

				<ul class="nav navbar-nav navbar-right">
					<li><span class="login">Signed in as: <?php echo $login; ?></span></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Tools
						<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="uploadfileform.php"><i class="fa fa-file"></i> Upload File</a></li>
								<li><a href="filemanager.php#newfolder"><i class="fa fa-folder-open"></i> Create New Directory</a></li>
								<li><a href="panelstat.php"><i class="fa fa-star"></i> Storage Information</a></li>
							</ul>
					</li>
					<li><a href="logout.php"><span class="fa fa-power-off" aria-hidden="true"></span><span class="hidden-lg hidden-md hidden-sm">    WSign out </span></a></li>
				</ul>

			</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  <div class="container">

<div class="rela-block">
	<div class="rela-block profile-card">
		<div class="profile-pic" id="profile_pic"></div>
		<div class="rela-block profile-name-container">
			<div class="rela-block user-name" id="user_name"><?php echo $login; ?></div>
			<div class="rela-block user-desc" id="user_description">Statystki użytkownika</div>
		</div>
		<div class="statistics">
		<?php //echo "Tak na marginesie: <br>";
			echo "Całkowita ilość plików: ".$stat->num_of_files()."<br>Zajęte miejsce na dysku: ".responsive_filesize($stat->size_profile())."<br>";
			echo "Całkowita dostępna przestrzeń: ".responsive_filesize($stat->total_storage())."<br><br>"
		?>
		</div>
		</div>
		<div style="text-align: center; margin-bottom: 20px;"><a href="changepasswordform.php"><button type='button' class="btn btn-danger">Change Password</button></a></div>
</div>
<br><br>
<script src="../include/jquery.min.js"></script>
<script src="../include/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

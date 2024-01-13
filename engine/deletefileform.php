<?php //okreslanie nazwy usuwanego pliku
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])) {
    if(isset($_POST['pid'])) $pid=$_POST['pid'];
    $id = secure_string($connect, $_POST['id']);
    $result = $connect->query("SELECT name,type FROM files$dbprefix WHERE id='$id'");
    $row = $result->fetch_assoc();
    $filename = $row['name'];
    $type = $row['type'];
    if($type==='DIR') $datatype = "katalog";
    else if($type==='FILE') $datatype = "plik";
  }
  else{
    header("Location: ../index.php");
    die();
  }
} //dostepne zmienne: $id->id pliku, $filename->nazwa pliku
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
	   <title>Delete <?php echo $datatype ?> - <?php echo $project_title;?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="..\css\delete_file.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >

	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
	<!--<div class="container">-->

	<br><br>
		<div class="middle col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-12 col-xs-offset-1 col-xs-10">
		<br>
			<div class="row">
			<img src="../img/question.jpg" alt="img" class="img left">
			<h1>Delete <?php echo $filename; ?>?</h1><br>
			</div>
			<div class="left">
				  

				  <h3>This action can't be reversed.</h3><br>
					<form action="deletefile.php" method="post" class="left">
						 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
						 <input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
						 <button type='submit' class="btn btn-danger">Delete forever</button>
					</form>

						<a href="filemanager.php"><button type='submit' class="btn btn-primary left cancel">Cancel</button><a>
						<br><br>
			</div>
	   </div>
  </body>
</html>

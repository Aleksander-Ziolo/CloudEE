<?php
require_once("config.php");
require_once("addons.php");

session_start();
$permissions = $_SESSION['permissions'];
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!isset($_SESSION['login'])){ //sprawdzanie czy zalogowany
  header("Location: ../index.php");
  die();
}
if( $permissions != 2){ 
    header("Location: filemanager.php");
    die();
  }
$login = $_SESSION['login'];
$stat = new Statistics($connect, $login, $dbprefix); //dostep do statystyk
if(!isset($_GET['pid'])) $current_dir=0; //sprawdzanie, w jakim katalogu sie znajdujemy
else{
  $current_dir=secure_string($connect, $_GET['pid']);
}
if(mysqli_connect_errno()==0) //pobieranie danych z bazy
{
  
//pobieranie listy plikow
 $users = array();
 $result = $connect->query("SELECT id,login,password,permissions,registerdate,storage, usedspace FROM users$dbprefix");
 while($row = $result->fetch_assoc()){
 $users[] = $row;
 }
 $num_of_users = count($users);
}
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
	   <title> <?php echo $dir_name." - Files of ".$login." - ".$project_title; ?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="../css/filemanager.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >

	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  
	<script>
	function footer(){
		if ( document.getElementById("myFooter").classList.contains('footerclose') ){
			
			document.getElementById("myFooter").classList.remove('footerclose');
			document.getElementById("myFooter").classList.add('footeropen');
			document.getElementById("buttonft").style.transition="All 1s ease";
			document.getElementById("buttonft").style.transform="rotate(180deg)";
			
		}else if(document.getElementById("myFooter").classList.contains('footeropen')){
			
			document.getElementById("myFooter").classList.add('footerclose');
			document.getElementById("myFooter").classList.remove('footeropen');
			document.getElementById("buttonft").style.transition="All 1s ease";
			document.getElementById("buttonft").style.transform="rotate(0deg)";
			
		}
	}
	
	</script>

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
                            <li><a href="uploadfileform.php"><i class="fa fa-file"></i> Upload file</a></li>
								<li><a href="filemanager.php#newfolder"><i class="fa fa-folder-open"></i> Create new directory</a></li>
                <li><a href="panelstat.php"><i class="fa fa-star"></i> Storage information</a></li>
                <?php if($permissions == 2): ?>
                <li><a href="accountmanager.php"><i class="fa fa-star"></i> Admin Panel</a></li>
                <?php endif; ?>
							</ul>
					</li>
					<li><a href="logout.php"><span class="fa fa-power-off" aria-hidden="true"></span><span class="hidden-lg hidden-md hidden-sm">    Sign </span></a></li>
				</ul>

			</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  <br><br><br>



  <div class="container">




    <h1>ADMIN PANEL
    <?php
    echo $dir_name;
    ?>
    </h1>
    <br>
	  <?php
 if(isset($_SESSION['move'])){
   $move_id=intval($_SESSION['move']);
   $result = $connect->query("SELECT name,size FROM files$dbprefix WHERE id=$move_id AND owner='$login'");
   $move_item = $result->fetch_assoc();
   echo "<div class='fileemanager'><div class='inner1'>";
   echo "<h4><i class='fa fa-compass fa-2x'></i> Clipboard</h4></div><div class='inner2'>Wybrany plik: ".$move_item['name']."<br>";
   echo "<div class='center-inner'><a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=1' class='btn btn-success'>Copy here</a>";
   echo "<a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=2' class='btn btn-info'>Move here</a>";
   echo "<a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=0' class='btn btn-warning'>Cancel</a></div></div>";
   echo "</div> ";
 }

  
  echo "<div class='table-responsive'> <table class='table table-bordered table-condensed table-dark'><thead><tr><th>Username</th><th>Storage</th><th>Register date</th><th>Permissions</th><th>Actions</th></tr></thead><tbody>";
  for($i=0;$i<$num_of_users;$i++){ //divy z pojedynczymi plikami
    $temp = $users[$i]['id'];
    $temp2 = $users[$i]['permissions'];
    $temp_login = $users[$i]['login'];
    $temp_storage = $users[$i]['storage'];
    if($temp2 == 2){
        $temp3 = "ADMIN";
    }else{
        $temp3 = "USER";
    }
    $_SESSION['variable'] = $temp;
    echo "
      <tr  class='tr-file'>
      <td>".$users[$i]['login']."</td>
        <td>".$users[$i]['storage']."</td>
        <td>".$users[$i]['registerdate']."</td>
        <td>".$temp3."</td>
        

        

        <td style='width:163px;'>
          <form method='post' action='deleteacc.php' style='float:left;'>
            <input type='hidden' name='id' value='".$temp."'>
            <input type='hidden' name='pid' value='".$temp."'>
            <button class='btn btn-link delete' type='submit'> <i class='fa fa-times' aria-hidden='true'></i><span class='hidden-xs hidden-sm hidden-xs-down'> Delete</span></button>
          </form>
        
          <form method='post' action='changepriv.php' style='float:left;'>
            <input type='hidden' name='id' value='".$temp."'>
            <input type='hidden' name='permissions' value='".$temp2."'>
            <button class='btn btn-link' type='submit'><i class='fa fa-cloud-download' aria-hidden='true'></i><span class='hidden-xs hidden-sm hidden-xs-down'> Modify priviliges</span></button>
          </form>

          <form method='post' action='editaccount.php' style='float:left;'>
          <input type='hidden' name='id' value='".$temp."'>
          <input type='hidden' name='storage' value='".$temp_storage."'>
          <input type='hidden' name='login' value='".$temp_login."'>
          <button class='btn btn-link' type='submit'><i class='fa fa-cloud-download' aria-hidden='true'></i><span class='hidden-xs hidden-sm hidden-xs-down'> Edit account details</span></button>
        </form>

        </td>
      </tr>
      ";
    
  }
  
  
    ?>
  
  </form>
  
  </div>
  </div>


<br><br><br><br><br>
  </div> <!-- end of container  -->
  
	<div class="footer footerclose" id="myFooter">
		<button id="buttonft" type="button" class="btn btn-link" onClick="footer()" ><i class="fa fa-angle-up fa-3x"></i></button>
		<?php 
			echo "<br>Number of files: ".$stat->local_filesInDir($current_dir)."<br>Directory size: ".responsive_filesize($stat->local_sizeOfDir($current_dir))."<br>";
			/*echo "Total files: ".$stat->num_of_files()."<br>Disk space taken: ".$stat->size_profile()."<br>";
			echo "Total available storage: ".$stat->total_storage()."<br>";*/
		?>
		<a class="white" href="panelstat.php">More information</a>
	</div>
  
  
  <!-- include javascript, jQuery FIRST -->
<script src="../include/jquery.min.js"></script>
<script src="../include/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>

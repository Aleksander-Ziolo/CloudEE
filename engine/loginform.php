<!DOCTYPE HTML>
<?php include('config.php'); ?>
<html lang="en">
  <head>
	   
   <!--
  //////////////////////////////
  //                          //
  // Pamiętaj, by dodać CSS   //
  //   i pliki bootstrapa     //
  //                          //
  //////////////////////////////
  -->
	
	
	
	   <title>Sign in - <?php echo $project_title;?> </title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="..\css\login.css">
	   
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >
	
	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
	  
  </head>
	
  <body>
    <div class="register-main col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="register-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
  
			<form action="login.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1>Sign in</h1>
			  <span>Login: </span><br><input type="text" name="login" class=" form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <span>Password: </span><br><input type="password" name="password" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
			  <br>
			  <div style="text-align: center;"><button type='submit' class="btn btn-success">Sign In</button></div>
			  <br>
			</form>
			
    <div style="text-align: center; margin-bottom: 20px;"><a href="registerform.php"><button type='button' class="btn btn-danger">Register</button></a></div>
	
	</div>
	</div>
	
	<div class="clearfix"></div>
	
  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==1){
    echo "<script>
      alert('Error: Invalid login data.');
    </script>
    ";
  }
  else{
    echo "<script>
      alert('Error: Unexpected issue has occured.');
    </script>
    ";
  }
}
?>

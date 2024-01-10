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
	
	
	
	   <title>Change password</title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="..\css\login.css">
	   
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	  
  </head>
	
  <body>
    <div class="register-main col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="register-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
  
			<form action="changepassword.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1>Change Password</h1>
			  <span>Old password: </span><br><input type="password" name="old" class=" form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <span>New password: </span><br><input type="password" name="new" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
              <span>Repeat New password: </span><br><input type="password" name="new2" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
			  <br>
			  <div style="text-align: center;"><button type='submit' class="btn btn-success">Change</button></div>
			  <br>
			</form>
			
    
	
	</div>
	</div>
	
	<div class="clearfix"></div>
	
  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==1){
    echo "<script>
      alert('Error: New password mismatch.');
    </script>
    ";
  }
  else if($_GET["err"]==2){
    echo "<script>
      alert('Error: New password is too short.');
    </script>
    ";
  }
  else if($_GET["err"]==3){
    echo "<script>
      alert('Error: Internal communication error.');
    </script>
    ";
  }
  else if($_GET["err"]==4){
    echo "<script>
      alert('Error: Old password is invalid.');
    </script>
    ";
  }
  else{
    echo "<script>
      alert('Error: Unexpected error occured.');
    </script>
    ";
  }
}
?>

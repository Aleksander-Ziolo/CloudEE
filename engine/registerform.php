<?php
include('config.php');

?>
<!DOCTYPE HTML>
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

	   <title>Sign on - <?php echo $project_title; ?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="..\css\register_form.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

  <div class="register-main col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="register-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<form action="register.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1 id="reg_h1">Sign On</h1>


			  Login: <br><input type="text" name="login" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <h6>Password must contain at least 8 characters!</h6>
			  Password: <br><input type="password" name="password" class=" form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  Retype password: <br><input type="password" name="password2" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  Anti-spam: Two + 2 * four is...<br> <input type="text" name="spambot" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <br>
			  <div style="text-align: center;"><button type='sumbit' class="btn btn-success">Register</button></div>

		</form>
		<br>
		<div style="text-align: center;"><a href="../index.php"><button type='button' class="btn btn-danger">Return to Sign In</button></a></div>
		<br>

	</div>
	</div>
	<br>
	<br>
	<div class="clearfix"></div>


  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==1){
    echo "<script>
      alert('Błąd: Hasła nie są zgodne.');
    </script>
    ";
  }
  else if($_GET["err"]==2){
    echo "<script>
      alert('Błąd: Długość hasła nie spełnia wymagań.');
    </script>
    ";
  }
  else if($_GET["err"]==3){
    echo "<script>
      alert('Błąd: Odpowiedź na pytanie antyspamowe jest nieprawidłowa.');
    </script>
    ";
  }
  else if($_GET["err"]==4){
    echo "<script>
      alert('Błąd: Ta nazwa użytkownika jest już zajęta.');
    </script>
    ";
  }
  else if($_GET["err"]==5){
    echo "<script>
      alert('Błąd: Długość nazwy użytkownika jest nieprawidłowa.');
    </script>
    ";
  }
  else{
    echo "<script>
      alert('Wystąpił nieoczekiwany błąd.');
    </script>
    ";
  }
}
?>

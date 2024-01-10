
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
	   <title>Delete account</title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="..\css\delete_file.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
	<!--<div class="container">-->

	<br><br>
		<div class="middle col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-12 col-xs-offset-1 col-xs-10">
		<br>
			<div class="row">
			<img src="../img/question.jpg" alt="img" class="img left">
			<h1>Delete <?php echo "account"; ?>?</h1><br>
			</div>
			<div class="left">
				  

				  <h3>This action can't be reversed.</h3><br>
					<form action="deletefile.php" method="post" class="left">
						
						 <button type='submit' class="btn btn-danger">Delete forever</button>
					</form>

						<a href="accountmanager.php"><button type='submit' class="btn btn-primary left cancel">Cancel</button><a>
						<br><br>
			</div>
	   </div>
  </body>
</html>

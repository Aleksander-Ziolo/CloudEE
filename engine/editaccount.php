<!DOCTYPE HTML>
<?php include('config.php'); 
$login=$_POST["login"];
$storage=$_POST["storage"];
settype($storage, "integer");
$storage=$_POST["id"];
settype($storage, "integer");
?>
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
  
			<form action="edit.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1>Edit <?php print_r($login)?> 's account</h1>
              <input type='hidden' name='id' value="$id">

			  <span>Storage: </span><br><input type="number" name="storage2" class="form-control col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
			  <br>
			  <div style="text-align: center;"><button type='submit' class="btn btn-success">EDIT STORAGE</button></div>
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

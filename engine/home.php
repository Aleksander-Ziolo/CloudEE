// <!DOCTYPE html>
<?php
error_reporting(-1);
include('config.php');
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/user_panel.css">
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<title> <?php echo "$project_title - panel"; ?> </title>
  </head>
  <body>	
<div class="body">
	<div class="nav-side-menu">
    <div class="brand"> 
		<img src="../img/clouds_logo2.png" alt="clouds" class="clouds-logo">
	</div>
	<div class="clearfix"></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="?link=dashboard"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a>
                </li>
				<!-- dropdown -->
                <li  data-toggle="collapse" data-target="#products" class="collapsed">
                  <a href="#"><i class="fa fa-flag fa-lg"></i> UI Elements <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="#">CSS3 Animation</a></li>
                    <li><a href="#">Random</a></li>
                    <li><a href="#">Text</a></li>
                    <li><a href="#">Because</a></li>
                    <li><a href="#">I have no idea</a></li>
                    <li><a href="#">What</a></li>
                    <li><a href="#">I am</a></li>
                    <li><a href="#">Doing</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>
				<!-- /dropdown -->

                 <li>
					<a href="?link=profile"><i class="fa fa-user fa-lg"></i> Profile</a>
                 </li>

                 <li>
					<a href="?link=myfiles"><i class="fa fa-cloud fa-lg"></i> My Files</a>
				 </li>
				 
				 <li>
					<a href="?link=uploadfile"><i class="fa fa-upload fa-lg"></i> Upload File</a>
				 </li>
				 <li>
					<a href="?link=logout"><i class="fa fa-power-off fa-lg"></i> Sign Out</a>
				 </li>
            </ul>
     </div>
	 
	<div class="date-bottom navbar-fixed-bottom">
	<?php 
		echo "<span class='hidden-sm hidden-xs'> Today is ". date('l'). ", ". date("d M Y"). "</span>";
	?>
	</div>
</div>

	<section class="main">
		<div class="content-display">
		<?php 
		
		if (!isset($_GET['link']) || $_GET['link']== "dashboard"){
		?>
		<br>
			<h1>Lorem Ipsum</h1>
			<br>
			
			<div class="row">                   
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">60% Complete</span>
					</div>
					<span class="progress-type">Random</span>
					<span class="progress-completed">60%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
						<span class="sr-only">40% Complete (success)</span>
					</div>
					<span class="progress-type">Pie</span>
					<span class="progress-completed">40%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
						<span class="sr-only">20% Complete (info)</span>
					</div>
					<span class="progress-type">Chart</span>
					<span class="progress-completed">20%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
					<span class="progress-type">on this</span>
					<span class="progress-completed">60%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete (danger)</span>
					</div>
					<span class="progress-type">website</span>
					<span class="progress-completed">80%</span>
				</div>
			</div>
			<br>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultricies posuere arcu, vel bibendum eros congue id. Pellentesque vulputate lacus felis, in pellentesque velit mollis id. Donec eget tristique nunc, faucibus tristique metus. Aliquam eget erat mauris. Vivamus felis nisi, tempor sit amet purus sit amet, euismod facilisis diam. Duis cursus eros a luctus cursus. Integer vel elit suscipit, mattis quam in, varius elit. Proin aliquam sit amet ipsum vitae ornare. </p>

			<p> Morbi non nunc eu est volutpat pulvinar. Vestibulum eleifend nulla vel semper vulputate. Donec et nisi eu lorem convallis bibendum non in tellus. Proin ipsum nisl, consequat eget molestie sit amet, tristique porttitor neque. Pellentesque suscipit eros dui, nec pulvinar arcu sodales non. Suspendisse sodales dignissim nulla et aliquam. Duis eget mollis velit. </p>

			<p> Cras quis lacus et nisl tincidunt maximus eget ac libero. Aliquam id lacus dui. Nulla efficitur tortor id leo pulvinar, nec aliquet enim mattis. Curabitur ultrices, lorem eget consequat blandit, libero mauris ultricies lorem, nec sodales sapien lectus sit amet ligula. Morbi pretium nunc non nibh bibendum placerat. Suspendisse potenti. Suspendisse finibus blandit nunc at porttitor. Etiam mauris dui, condimentum ut risus in, convallis dignissim purus. Nullam et quam ac tortor mattis accumsan. Integer suscipit nisl ut sapien bibendum ultricies. Pellentesque lacinia, leo non egestas convallis, nisi neque placerat nulla, eget commodo augue ante non purus. Nunc consectetur sodales arcu, a dapibus justo consequat non. Aliquam elementum tortor in suscipit condimentum. Aenean venenatis at justo non blandit. Proin eleifend tempor euismod. </p>

			<p> Sed sollicitudin erat non urna dignissim imperdiet. Cras dignissim elit quis dui vestibulum, sed luctus est suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ante egestas, malesuada odio eu, mattis nibh. Donec iaculis velit lobortis ligula consequat commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vitae iaculis nisl, a ultrices metus. </p>

			<p> Donec volutpat arcu id mollis vehicula. Suspendisse euismod mattis nulla, vel lobortis urna dignissim vel. Sed id maximus orci. Nam pharetra ligula justo, vel scelerisque nunc tincidunt eget. Ut malesuada dui a semper mattis. Cras a risus venenatis, tempor lectus at, aliquet elit. Praesent ut hendrerit mi. </p>
		
		
		<?php	
		}else if($_GET['link']== "profile"){
		?>
		<br>
			<h1>My Profile</h1>
			<br>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultricies posuere arcu, vel bibendum eros congue id. Pellentesque vulputate lacus felis, in pellentesque velit mollis id. Donec eget tristique nunc, faucibus tristique metus. Aliquam eget erat mauris. Vivamus felis nisi, tempor sit amet purus sit amet, euismod facilisis diam. Duis cursus eros a luctus cursus. Integer vel elit suscipit, mattis quam in, varius elit. Proin aliquam sit amet ipsum vitae ornare. </p>

			<p> Morbi non nunc eu est volutpat pulvinar. Vestibulum eleifend nulla vel semper vulputate. Donec et nisi eu lorem convallis bibendum non in tellus. Proin ipsum nisl, consequat eget molestie sit amet, tristique porttitor neque. Pellentesque suscipit eros dui, nec pulvinar arcu sodales non. Suspendisse sodales dignissim nulla et aliquam. Duis eget mollis velit. </p>

			<p> Cras quis lacus et nisl tincidunt maximus eget ac libero. Aliquam id lacus dui. Nulla efficitur tortor id leo pulvinar, nec aliquet enim mattis. Curabitur ultrices, lorem eget consequat blandit, libero mauris ultricies lorem, nec sodales sapien lectus sit amet ligula. Morbi pretium nunc non nibh bibendum placerat. Suspendisse potenti. Suspendisse finibus blandit nunc at porttitor. Etiam mauris dui, condimentum ut risus in, convallis dignissim purus. Nullam et quam ac tortor mattis accumsan. Integer suscipit nisl ut sapien bibendum ultricies. Pellentesque lacinia, leo non egestas convallis, nisi neque placerat nulla, eget commodo augue ante non purus. Nunc consectetur sodales arcu, a dapibus justo consequat non. Aliquam elementum tortor in suscipit condimentum. Aenean venenatis at justo non blandit. Proin eleifend tempor euismod. </p>

			<p> Sed sollicitudin erat non urna dignissim imperdiet. Cras dignissim elit quis dui vestibulum, sed luctus est suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ante egestas, malesuada odio eu, mattis nibh. Donec iaculis velit lobortis ligula consequat commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vitae iaculis nisl, a ultrices metus. </p>

			<p> Donec volutpat arcu id mollis vehicula. Suspendisse euismod mattis nulla, vel lobortis urna dignissim vel. Sed id maximus orci. Nam pharetra ligula justo, vel scelerisque nunc tincidunt eget. Ut malesuada dui a semper mattis. Cras a risus venenatis, tempor lectus at, aliquet elit. Praesent ut hendrerit mi. </p>
			<div class="row">                   
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">60% Complete</span>
					</div>
					<span class="progress-type">Random</span>
					<span class="progress-completed">60%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
						<span class="sr-only">40% Complete (success)</span>
					</div>
					<span class="progress-type">Pie</span>
					<span class="progress-completed">40%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
						<span class="sr-only">20% Complete (info)</span>
					</div>
					<span class="progress-type">Chart</span>
					<span class="progress-completed">20%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
					<span class="progress-type">on this</span>
					<span class="progress-completed">60%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete (danger)</span>
					</div>
					<span class="progress-type">website</span>
					<span class="progress-completed">80%</span>
				</div>
			</div>
		<?php
		}else if($_GET['link']== "myfiles"){
		?>
		<br>
			<h1>My Files</h1>
			<br>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultricies posuere arcu, vel bibendum eros congue id. Pellentesque vulputate lacus felis, in pellentesque velit mollis id. Donec eget tristique nunc, faucibus tristique metus. Aliquam eget erat mauris. Vivamus felis nisi, tempor sit amet purus sit amet, euismod facilisis diam. Duis cursus eros a luctus cursus. Integer vel elit suscipit, mattis quam in, varius elit. Proin aliquam sit amet ipsum vitae ornare. </p>

			<p> Morbi non nunc eu est volutpat pulvinar. Vestibulum eleifend nulla vel semper vulputate. Donec et nisi eu lorem convallis bibendum non in tellus. Proin ipsum nisl, consequat eget molestie sit amet, tristique porttitor neque. Pellentesque suscipit eros dui, nec pulvinar arcu sodales non. Suspendisse sodales dignissim nulla et aliquam. Duis eget mollis velit. </p>

			<p> Cras quis lacus et nisl tincidunt maximus eget ac libero. Aliquam id lacus dui. Nulla efficitur tortor id leo pulvinar, nec aliquet enim mattis. Curabitur ultrices, lorem eget consequat blandit, libero mauris ultricies lorem, nec sodales sapien lectus sit amet ligula. Morbi pretium nunc non nibh bibendum placerat. Suspendisse potenti. Suspendisse finibus blandit nunc at porttitor. Etiam mauris dui, condimentum ut risus in, convallis dignissim purus. Nullam et quam ac tortor mattis accumsan. Integer suscipit nisl ut sapien bibendum ultricies. Pellentesque lacinia, leo non egestas convallis, nisi neque placerat nulla, eget commodo augue ante non purus. Nunc consectetur sodales arcu, a dapibus justo consequat non. Aliquam elementum tortor in suscipit condimentum. Aenean venenatis at justo non blandit. Proin eleifend tempor euismod. </p>

			<p> Sed sollicitudin erat non urna dignissim imperdiet. Cras dignissim elit quis dui vestibulum, sed luctus est suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ante egestas, malesuada odio eu, mattis nibh. Donec iaculis velit lobortis ligula consequat commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vitae iaculis nisl, a ultrices metus. </p>

			<p> Donec volutpat arcu id mollis vehicula. Suspendisse euismod mattis nulla, vel lobortis urna dignissim vel. Sed id maximus orci. Nam pharetra ligula justo, vel scelerisque nunc tincidunt eget. Ut malesuada dui a semper mattis. Cras a risus venenatis, tempor lectus at, aliquet elit. Praesent ut hendrerit mi. </p>
		<?php
		}else if($_GET['link']== "uploadfile"){
			?>
		<br>
			<h1>Hey, upload your file</h1>
			<br>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultricies posuere arcu, vel bibendum eros congue id. Pellentesque vulputate lacus felis, in pellentesque velit mollis id. Donec eget tristique nunc, faucibus tristique metus. Aliquam eget erat mauris. Vivamus felis nisi, tempor sit amet purus sit amet, euismod facilisis diam. Duis cursus eros a luctus cursus. Integer vel elit suscipit, mattis quam in, varius elit. Proin aliquam sit amet ipsum vitae ornare. </p>

			<p> Morbi non nunc eu est volutpat pulvinar. Vestibulum eleifend nulla vel semper vulputate. Donec et nisi eu lorem convallis bibendum non in tellus. Proin ipsum nisl, consequat eget molestie sit amet, tristique porttitor neque. Pellentesque suscipit eros dui, nec pulvinar arcu sodales non. Suspendisse sodales dignissim nulla et aliquam. Duis eget mollis velit. </p>

			<p> Cras quis lacus et nisl tincidunt maximus eget ac libero. Aliquam id lacus dui. Nulla efficitur tortor id leo pulvinar, nec aliquet enim mattis. Curabitur ultrices, lorem eget consequat blandit, libero mauris ultricies lorem, nec sodales sapien lectus sit amet ligula. Morbi pretium nunc non nibh bibendum placerat. Suspendisse potenti. Suspendisse finibus blandit nunc at porttitor. Etiam mauris dui, condimentum ut risus in, convallis dignissim purus. Nullam et quam ac tortor mattis accumsan. Integer suscipit nisl ut sapien bibendum ultricies. Pellentesque lacinia, leo non egestas convallis, nisi neque placerat nulla, eget commodo augue ante non purus. Nunc consectetur sodales arcu, a dapibus justo consequat non. Aliquam elementum tortor in suscipit condimentum. Aenean venenatis at justo non blandit. Proin eleifend tempor euismod. </p>

			<p> Sed sollicitudin erat non urna dignissim imperdiet. Cras dignissim elit quis dui vestibulum, sed luctus est suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ante egestas, malesuada odio eu, mattis nibh. Donec iaculis velit lobortis ligula consequat commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vitae iaculis nisl, a ultrices metus. </p>

			<p> Donec volutpat arcu id mollis vehicula. Suspendisse euismod mattis nulla, vel lobortis urna dignissim vel. Sed id maximus orci. Nam pharetra ligula justo, vel scelerisque nunc tincidunt eget. Ut malesuada dui a semper mattis. Cras a risus venenatis, tempor lectus at, aliquet elit. Praesent ut hendrerit mi. </p>
		<?php
		}else{
			echo "<br><br><h2>There is no such a page! I think you got lost :/ ~ Crew from cloud</h2>";
			echo "<p>Maybe website is still not finished</p>";
		}
		
		?>
		</div>
	</section>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>

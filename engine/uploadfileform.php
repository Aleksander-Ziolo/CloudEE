<?php
  session_start(); //sesja dla wielokrotnego dodawania plikow do tego samego katalogu
  if(isset($_POST['pid'])) $pid=$_POST['pid'];
  else if(isset($_SESSION['cpid'])) {
    $pid=$_SESSION['cpid'];
    unset($_SESSION['cpid']);
  }
  else $pid=0;
  require_once("config.php");
  require_once("addons.php");
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
	   <title>Upload a file - <?php echo $project_title; ?></title>
	   <meta charset="utf-8">
	   <link rel="stylesheet" href="..\css\upload_file.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../include/bootstrap.min.css" >

	<!-- Font-Awesome -->
	<link href="../include/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">


  </head>
  <body>

	<div class="container">

	<br><br>

		<img src="../img/uploadfiles.png" alt="Upload file" class="img-responsive img">

		<div class="middle col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
      <div>
			<form id="upload" action="uploadfile.php" method="post" enctype="multipart/form-data" class="col-lg-10 col-lg-offset-1">
        <label for="fileselect">File chooser</label>

				<input multiple type="file" name="file[]" id="file" class="btn btn-default"/><br>

				<input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
        <div id="filedrag">... or drop your files here</div>
				<div id="center1">
  			<button type="submit" name="sendfile" id="submitbutton" class="btn btn-success float">Upload</button>
        </div>
				</form>

				<form method="get" action="filemanager.php" class="col-lg-10 col-lg-offset-1">
					<div id="center1">
					<input type="hidden" name="pid" value="<?php echo $pid; ?>">
					<button type='submit' class="btn btn-primary">Cancel</button>
					</div>
				</form>

				<div class="clearfix" style='margin-top:10px;'></div>
        <div id="messages" style='margin-top:10px;'></div>
		<br><br>
		</div>


	</div>

  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==0){
    echo "<script>
      alert('Upload completed');
    </script>
    ";
  }
  else if($_GET["err"]==1){
    echo "<script>
      alert('Error: Please log in');
    </script>
    ";
  }
  else if($_GET["err"]==2){
    echo "<script>
      alert('Error: No space available or the file exceeds the file limit of ".responsive_filesize($max_file_size)."');
    </script>";
  }
  else if($_GET["err"]==3){ //mozliwa zla konfiguracja PHP
    echo "<script>
      alert('Error: File upload failed. Possible server misconfiguration. Please contact with Administrator.'); 
    </script>
    ";
  }
  else{
    echo "<script>
      alert('Unexpected error has occured');
    </script>
    ";
  }
}
?>

<script>

function $id(id) {
	return document.getElementById(id);
}
// output information
function Output(msg) {
	var m = $id("messages");
	m.innerHTML = msg + m.innerHTML;
}

// call initialization file
if (window.File && window.FileList && window.FileReader) {
	Init();
}

//
// initialize
function Init() {

	var fileselect = $id("file"),
		filedrag = $id("filedrag"),
		submitbutton = $id("submitbutton");

    fileselect.addEventListener("change", FileSelectHandler, false);
	// is XHR2 available?
	var xhr = new XMLHttpRequest();
	if (xhr.upload) {

		// file drop
		filedrag.addEventListener("dragover", FileDragHover, false);
		filedrag.addEventListener("dragleave", FileDragHover, false);
		filedrag.addEventListener("drop", FileSelectHandler, false);
		filedrag.style.display = "block";
	}

}
// file drag hover
function FileDragHover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.target.className = (e.type == "dragover" ? "hover" : "");
}
// file selection
function FileSelectHandler(e) {
	// cancel event and hover styling
	FileDragHover(e);
	// fetch FileList obj =ect
	var files = e.target.files || e.dataTransfer.files;
  if(e.type !== 'change')
    $id('file').files = files;
	// process all File objects
  if(e.type === 'change'){
  	for (var i = 0, f; f = files[i]; i++) {
  		ParseFile(f,i);
  	}
  }
}

function ParseFile(file,num) {

	Output(
		"<p>"+(num+1)+". Nazwa pliku: <strong>" + file.name +
		"</strong> typ: <strong>" + file.type +
		"</strong> rozmiar: <strong>" + (Math.round(file.size / 1024)+1) +
		"</strong> KB</p>"
	);

}

</script>

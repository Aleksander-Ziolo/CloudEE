<?php
require_once("config.php");
require_once("addons.php");
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$password = $_POST['password'];
$password = secure_string($connect, $password);
$ver= $_POST['password2'];
$ver = secure_string($connect, $ver);
$spambot=$_POST['spambot'];
$spambot = secure_string($connect, $spambot);
$login=$_POST["login"];
$login = secure_string($connect, $login);
$date=date('Y-m-d H:i:s', time());
if(strcmp($password, $ver) != 0){
	header("Location: registerform.php?err=1"); //blad: hasla nie zgadzaja sie
	die();
}
else if(strlen($password)<8){
	header("Location: registerform.php?err=2"); //blad:za krotkie haslo
	die();
}
else if($spambot!=10){
	header("Location: registerform.php?err=3"); //blad: zly spambot
	die();
}
else if(strlen($login)<3 || strlen($login)>31){
	header("Location: registerform.php?err=5"); //blad: nieprawidlowa dlugosc loginu
	die();
}
else{
	if(!$connect->connect_error)
	{
		$result=$connect->query("SELECT * From users$dbprefix WHERE login='$login'");
		if(mysqli_num_rows($result) > 0 || $login=="Guest")
		{
					header("Location: registerform.php?err=4");  //blad: uzytkownik o tej nazwie juz istnieje
					die();
		}
		else{
			$passwd=password_hash($password, PASSWORD_DEFAULT);
			$connect->query("INSERT INTO users$dbprefix VALUES (NULL, '$login', '$passwd', '1', '$date', '$default_storage', '0', '1')");
			//przekierowanie do: dziekujemy za rejestracje a potem index.php
					header("Location: ../index.php"); //tymczasowo
			die();
		}
	}
	else{
		echo "Error in connection to the database";
	}
}
 ?>
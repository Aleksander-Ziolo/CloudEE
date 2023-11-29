<?php
require_once("config.php");
require_once("addons.php");
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['key'])){
    header("Location: ../index.php");
    die();
}
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$login = $_SESSION['login'];
$old_password=secure_string($connect, $_POST['old']);
$new_password=secure_string($connect, $_POST['new']);
$verify_password=secure_string($connect, $_POST['new2']);
if(strcmp($new_password, $verify_password) != 0){
	header("Location: form.php?err=1"); //blad: nowe hasla nie zgadzaja sie
	die();
}
else if(strlen($new_password)<8){
	header("Location: form.php?err=2"); //blad: za krotkie haslo
	die();
}
if(!$connect->connect_error){
    $result=$connect->query("SELECT * From users$dbprefix WHERE login='$login'");
    if(mysqli_num_rows($result) <= 0){
        header("Location: form.php?err=3"); //blad: sesja uszkodzona, uzytkownik nie istnieje. Nieznany blad
        die();
    }
    $row=$result->fetch_assoc();
    if(!password_verify($old_password, $row['password'])) {
        header("Location: form.php?err=4"); //blad: stare haslo jest nieprawidlowe
        die();
    } //teraz wszystko ok
    $encryption_mode = $row['encryption_mode']; //na przyszlosc, na razie tylko wartosc 1 - klucz jest haslem
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $result = $connect->query("UPDATE users$dbprefix SET password = '$hash' WHERE login = '$login'");
    if($encryption_mode !== '1'){ //jesli haslo konta nie jest kluczem szyfrujacym
        header("Location: form.php?err=0"); //sukces, zmieniono haslo.
        die();
    }
    $new_key = hash('sha256', $new_password);
    $result=$connect->query("SELECT * From files$dbprefix WHERE owner='$login'");
    while($row = $result->fetch_assoc()){
        $path = $row['path'];
        if(!empty($path) && file_exists($path)){ 
            decrypt($path, $path.".tmp", $_SESSION['key']);
            unlink($path);
            encrypt($path.".tmp", $path, $new_key);
            unlink($target_file.".tmp");
        }
    }
    header("Location: form.php?err=0"); //sukces, zmieniono haslo.
    die();
}

?>
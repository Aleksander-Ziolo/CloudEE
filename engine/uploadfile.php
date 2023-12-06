<?php
require_once("config.php");
require_once("addons.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function cleanArrayFiles(&$file_input) { //lepiej uklada tablice plikow
    $file_ary = array();
    $file_count = count($file_input['name']);
    $file_keys = array_keys($file_input);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_input[$key][$i];
        }
    }
    return $file_ary;
}

//source: https://medium.com/@antoine.lame/how-to-encrypt-files-with-php-f4adead297de

session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['sendfile']) && isset($_SESSION['login']) && isset($_SESSION['key']))//sprawdza czy plik zostal zamieszczony przez formularz
  {
    $file_arr = cleanArrayFiles($_FILES['file']);
    if(isset($_POST['pid'])) $pid = secure_string($connect, $_POST['pid']);
    else $pid = 0;
    settype($pid, "integer");
    $_SESSION['cpid'] = $pid; //dla redirecta: uploadfileform.php
    foreach ($file_arr as $file) { //wykonywanie wysylania plikow w petli
      $result = $connect->query("SELECT MAX(id) FROM files$dbprefix");
      $row = $result->fetch_assoc();
      $target_filename = intval($row['MAX(id)']) + 1; //ustawianie nazwy nowego pliku
      $target_file = $target_dir . $target_filename;
      $source_file_ext = pathinfo($file['name'], PATHINFO_EXTENSION); //ustalanie rozszerzenia pliku
      $source_filename = secure_string($connect, $file['name']); //nazwa wysylanego pliku
      $owner = $_SESSION['login'];
      $userId=$_SESSION['userId'];
      $date = date('Y-m-d H:i:s', time()); //aktualna data
      $file_size = intval($file['size']/1024); //rozmiar pliku (w KB)
      $file_size++; //zaokrąglanie rozmiaru w gore
      $result = $connect->query("SELECT storage,usedspace FROM users$dbprefix WHERE login='$owner'");
      $row = $result->fetch_assoc();
      $total_space = $row['storage'];
      $used_space = $row['usedspace']; //sprawdzanie dostepnej przestrzeni dyskowej dla uzytkownika
      $file_loc = $file['tmp_name']; //tymczasowa lokalizacja pliku
      if($used_space + $file_size <= $total_space && $file_size <= $max_file_size){
        if(move_uploaded_file($file_loc, $target_file.".tmp")){ //wysylanie pliku
          $checksum = hash_file('sha256', $target_file.".tmp"); //wyznaczanie sumy kontrolnej 
          encrypt($target_file.".tmp", $target_file, $_SESSION['key']); //szyfrowanie AES-256
          unlink($target_file.".tmp");
          $result = $connect->query("INSERT INTO files$dbprefix VALUES (NULL, '$pid', '$source_filename', '$source_file_ext', '$userId', 'FILE', '$date', '$file_size', '$target_file', '$checksum')");
          $postspace = $used_space + $file_size;
          $result = $connect->query("UPDATE users$dbprefix SET usedspace = '$postspace' WHERE id = '$userId'");
        }
        else{
          header("Location: uploadfileform.php?err=3"); //blad: wysylanie pliku nie powiodlo sie
          die();
        }
      }
    else{
      header("Location: uploadfileform.php?err=2"); //blad: brak dostepnej przestrzeni lub plik za duzy
      die();
      }
    }
    header("Location: uploadfileform.php?err=0"); //brak bledu (jesli wysla sie wszystkie)
    die();
  }
  else{
    header("Location: uploadfileform.php?err=1"); //blad: nie jestes zalogowany
    die();
  }
}
?>

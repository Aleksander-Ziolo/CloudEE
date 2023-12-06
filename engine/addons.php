<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//Zawiera dodatkowy zestaw funkcji uzywanych globalnie
require_once("config.php");

function secure_string($connect, $string){ //zabezpieczenie stringow do bazy danych
  $string = $connect->real_escape_string($string);
  $string = htmlspecialchars($string);
  return $string;
}

class Statistics{    //klasa dostawcy statystyk profilowych
  private $connect;
  private $userId;
  private $dbprefix;

  function __construct($connect, $userId, $dbprefix) {
    $this->connect = $connect;
    $this->userId = $userId;
    $this->dbprefix = $dbprefix;
  }

  function num_of_files(){ //ilosc plikow
    $result = $this->connect->query("SELECT count(id) AS num FROM files$this->dbprefix WHERE owner='$this->userId' AND type='FILE';");
    $row = $result->fetch_assoc();
    return $row['num'];
  }

  function size_profile(){ //rozmiar profilu (w KB)
    $result = $this->connect->query("SELECT usedspace FROM users$this->dbprefix WHERE id='$this->userId'");
    $row = $result->fetch_assoc();
    return $row['usedspace'];
  }

  function total_storage(){ //calkowita dostepna przestrzen (w KB)
    $result = $this->connect->query("SELECT storage FROM users$this->dbprefix WHERE id='$this->userId'");
    $row = $result->fetch_assoc();
    return $row['storage'];
  }

  function filesize_comparison(){ //zliczanie zajetego miejsca przez okreslone rozszerzenia plikow - zwraca tablice 2d
    $result = $this->connect->query("SELECT ext, SUM(size) AS size, COUNT(id) AS files FROM files$this->dbprefix WHERE owner='$this->userId' GROUP BY ext ORDER BY size DESC");
    while($row = $result->fetch_assoc()){
      if($row['size']!=0) $output[] = $row;
    }
    if(!isset($output)){
       $output[0]['ext']='';
       $output[0]['size']=0;
       $output[0]['files']=0;
    }
    return $output;
  }

  function local_filesInDir($id){ //liczba plikow w katalogu - przyjmuje id katalogu
    $result = $this->connect->query("SELECT count(id) AS num FROM files$this->dbprefix WHERE owner='$this->userId' AND type='FILE' AND pid='$id'");
    $row = $result->fetch_assoc();
    return $row['num'];
  }

  function local_sizeOfDir($id){ //rozmiar katalogu - przyjmuje id katalogu
    $result = $this->connect->query("SELECT id,type,size FROM files$this->dbprefix WHERE owner='$this->userId' AND pid='$id'");
    $count = 0; //w KB
    while($row = $result->fetch_assoc()){
      $data[] = $row;
    }
    if(!isset($data)) return 0;
    foreach ($data as $object){
      if($object['type']==="DIR") $count += $this->local_sizeOfDir($object['id']);
      else if($object['type']==="FILE") $count += $object['size'];
    }
    return $count;
  }
}

function responsive_filesize($size){ //automatyczna zmiana jednostek -> KB, MB, GB, TB x 1024
  $size = intval($size);
  $output = "";
  if($size<=1024){
    $output = $size."KB";
    return $output;
  }
  else if($size>1024 && $size<=1048576){
    $size = round($size/1024, 1);
    $output = $size."MB";
    return $output;
  }
  else if($size>1048576 && $size<=1073741824){
    $size = $size/1024;
    $size = round($size/1024, 1);
    $output = $size."GB";
    return $output;
  }
  else{
    $size = $size/1024;
    $size = $size/1024;
    $size = round($size/1024, 1);
    $output = $size."TB";
    return $output;
  }
}

function encrypt($source, $dest, $key)
{
    $encryption_cipher = 'aes-256-cbc';
    $ivLength = openssl_cipher_iv_length($encryption_cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $blocks = 10000;

    $error = false;
    if ($fpOut = fopen($dest, 'w')) {
        // Put the initialzation vector to the beginning of the file
        fwrite($fpOut, $iv);
        if ($fpIn = fopen($source, 'rb')) {
            while (!feof($fpIn)) {
                $plaintext = fread($fpIn, $ivLength * $blocks);
                $ciphertext = openssl_encrypt($plaintext, $encryption_cipher, $key, OPENSSL_RAW_DATA, $iv);
                // Use the first 16 bytes of the ciphertext as the next initialization vector
                $iv = substr($ciphertext, 0, $ivLength);
                fwrite($fpOut, $ciphertext);
            }
            fclose($fpIn);
        } else {
            $error = true;
        }
        fclose($fpOut);
    } else {
        $error = true;
    }

    return $error ? false : $dest;
}


function decrypt($source, $dest, $key)
{
    $encryption_cipher = 'aes-256-cbc';
    $ivLength = openssl_cipher_iv_length($encryption_cipher);
    $blocks = 10000;

    $error = false;
    if ($fpOut = fopen($dest, 'w')) {
        if ($fpIn = fopen($source, 'rb')) {
            // Get the initialzation vector from the beginning of the file
            $iv = fread($fpIn, $ivLength);
            while (!feof($fpIn)) {
                // we have to read one block more for decrypting than for encrypting
                $ciphertext = fread($fpIn, $ivLength * ($blocks + 1)); 
                $plaintext = openssl_decrypt($ciphertext, $encryption_cipher, $key, OPENSSL_RAW_DATA, $iv);
                // Use the first 16 bytes of the ciphertext as the next initialization vector
                $iv = substr($ciphertext, 0, $ivLength);
                fwrite($fpOut, $plaintext);
            }
            fclose($fpIn);
        } else {
            $error = true;
        }
        fclose($fpOut);
    } else {
        $error = true;
    }

    return $error ? false : $dest;
}


?>

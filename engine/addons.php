<?php
//Zawiera dodatkowy zestaw funkcji uzywanych globalnie
require_once("config.php");

function secure_string($connect, $string){ //zabezpieczenie stringow do bazy danych
  $string = $connect->real_escape_string($string);
  $string = htmlspecialchars($string);
  return $string;
}

class Statistics{    //klasa dostawcy statystyk profilowych
  private $connect;
  private $username;
  private $dbprefix;

  function __construct($connect, $username, $dbprefix) {
    $this->connect = $connect;
    $this->username = $username;
    $this->dbprefix = $dbprefix;
  }

  function num_of_files(){ //ilosc plikow
    $result = $this->connect->query("SELECT count(id) AS num FROM files$this->dbprefix WHERE owner='$this->username' AND type='FILE';");
    $row = $result->fetch_assoc();
    return $row['num'];
  }

  function size_profile(){ //rozmiar profilu (w KB)
    $result = $this->connect->query("SELECT usedspace FROM users$this->dbprefix WHERE login='$this->username'");
    $row = $result->fetch_assoc();
    return $row['usedspace'];
  }

  function total_storage(){ //calkowita dostepna przestrzen (w KB)
    $result = $this->connect->query("SELECT storage FROM users$this->dbprefix WHERE login='$this->username'");
    $row = $result->fetch_assoc();
    return $row['storage'];
  }

  function filesize_comparison(){ //zliczanie zajetego miejsca przez okreslone rozszerzenia plikow - zwraca tablice 2d
    $result = $this->connect->query("SELECT ext, SUM(size) AS size, COUNT(id) AS files FROM files$this->dbprefix WHERE owner='$this->username' GROUP BY ext ORDER BY size DESC");
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
    $result = $this->connect->query("SELECT count(id) AS num FROM files$this->dbprefix WHERE owner='$this->username' AND type='FILE' AND pid='$id'");
    $row = $result->fetch_assoc();
    return $row['num'];
  }

  function local_sizeOfDir($id){ //rozmiar katalogu - przyjmuje id katalogu
    $result = $this->connect->query("SELECT id,type,size FROM files$this->dbprefix WHERE owner='$this->username' AND pid='$id'");
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


?>

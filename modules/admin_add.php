<?php 
$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if(isset($_POST["dodaj"])) {
    $target_dir = "../public/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
    $naziv= $_POST["naziv"];
    $opis= $_POST["opis"];
    $cijena= $_POST["cijena"];
    $slika = basename($_FILES["fileToUpload"]["name"]);

    include_once('../includes/functions.php');

    if (emptyInputAdd($naziv, $opis, $cijena) !== false){
        header('Location: ../index.php?action=page&page=add&error=emptyinput');
        exit();
    }else (invalidInput($naziv, $opis) !== false){
        header('Location: ../index.php?action=page&page=add&error=wrongInput');
        exit();
    }

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
      header('Location: ../index.php?action=page&page=add&error=wrongFile');
      exit();
    }

    if (file_exists($target_file)) {
        $uploadOk = 0;
        header('Location: ../index.php?action=page&page=add&error=exist');
        exit();
      }

      if ($_FILES["fileToUpload"]["size"] > 300000) {
        $uploadOk = 0;
        header('Location: ../index.php?action=page&page=add&error=large');
        exit();
      }

      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
         $uploadOk = 0;
         header('Location: ../index.php?action=page&page=add&error=format');
         exit();
}

if ($uploadOk == 0) {
    header('Location: ../index.php?action=page&page=add&error=upload_error');
    exit();
  
  } else {
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //   header('Location: ../index.php?action=page&page=add&msg=upload_success');
    // } else {
      header('Location: ../index.php?action=page&page=add&error=upload_error');
      exit();
    }
  }

   createItem($db, $naziv, $opis, $cijena, $slika);
     

}else 

{
    header('Location: ../index.php?action=page&page=add');    
    exit();
}

?>
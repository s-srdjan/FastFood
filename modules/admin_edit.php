<?php 
$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if (isset($_POST['izmjeni'])){ 
    $id = $_POST["id"];
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $cijena = $_POST["cijena"];

    include_once('../includes/functions.php');

    if (emptyInputAdd($naziv, $opis, $cijena) !== false){
        header('Location: ../index.php?action=page&page=admin&error=emptyinput');
        exit();
    }

    if (invalidInput($naziv, $opis) !== false){
      header('Location: ../index.php?action=page&page=admin&error=wrongInput');
      exit();
   }

    $sql = "UPDATE jelovnik 
    SET naziv = '$naziv', opis = '$opis', cijena = '$cijena'
    WHERE id = $id ";
    $result = $db->query($sql);

if ($result) {
    header('Location: ../index.php?action=page&page=admin&error=no_error');
    exit();
  } else {
    header('Location: ../index.php?action=page&page=admin&error=error');
    exit();
  }
 
}

?>


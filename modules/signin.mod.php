<?php
include_once('../includes/functions.php');

$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');
 
if (isset($_POST['form_btn'])) {
  $email = $_POST["email"];
  $lozinka = $_POST["lozinka"];

  include_once('../includes/functions.php');  

  if (emptyInputSignIn($email, $lozinka) !== false){
    header('Location: ../index.php?action=page&page=sign_in&error=emptyinput');
    exit();
  }

  loginUser($db, $email, $lozinka);

}else {
  header('Location: ../index.php?action=page&page=sign_in');    
  exit();
}

?>
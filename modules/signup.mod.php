<?php
session_start();

$conn = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if (isset($_POST["submit"])){
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $email = $_POST["email"];
    $adresa = $_POST["adresa"];
    $br_tel = $_POST["br_tel"];
    $lozinka = $_POST["lozinka"];

include_once('../includes/functions.php');

if (emptyInputSignup($ime, $prezime, $email, $adresa, $br_tel, $lozinka) !== false){
    header('Location: ../index.php?action=page&page=sign_up&error=emptyinput');
    exit();
}

if (invalidEmail($email) !== false){
    header('Location: ../index.php?action=page&page=sign_up&error=invalidemail');
    exit();
}

if (invalidPhone($br_tel) !== false){
    header('Location: ../index.php?action=page&page=sign_up&error=invalidphone');
    exit();
}

if (emailphoneExist($conn, $email, $br_tel) !== false){
    header('Location: ../index.php?action=page&page=sign_up&error=taken');
    exit();
}

createUser($conn, $ime, $prezime, $email, $adresa, $br_tel, $lozinka);

}
else {
    header('Location: ../index.php?action=page&page=sign_up');    
    exit();
}

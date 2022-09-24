<?php 

define('DIR_MODULE','./modules/');
define('DIR_TEMPLATE','./template/');
define('DIR_INCLUDE','./includes/');

include_once('./db_mysqli.php');

$ime_kukija = 'korisnik';
session_start();
$session_id = session_id();
include_once(DIR_INCLUDE."functions.php");
proveri_sesiju();	

$action = @$_GET['action']; 
$name = @$_SESSION['ulogovan'];

if($name == ''){
    $user = "Gost";
}

if(@$_SESSION['ulogovan']){
foreach ($name as $key => $value) {
    $ime = $value;
} 
$user = $ime;
}

$db_konekcija = new db();

switch($action){
    case '' :
    case 'page' :
        $modul= 'page';
    break;
    case 'edit' :
        $modul = 'admin';
    break;
    default:
        $modul = '404';
     break;
}


$modul_filename = DIR_MODULE . "$modul.php";

include_once(DIR_TEMPLATE . "header.php");

if(file_exists($modul_filename)){
    include_once($modul_filename);
}else{
    die('Nepoznata stranica');
}

if(empty($_GET)){
        include_once(DIR_TEMPLATE ."pocetna.php");
    }

    include_once(DIR_TEMPLATE . "footer.php");

    unset($db_konekcija);

?>

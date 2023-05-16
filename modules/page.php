<?php
$sql = "SELECT *  FROM `jelovnik` ";
$jelovnik = $db_konekcija->citaj($sql);

 $page= @$_GET['page'];
 $id = (int)@$_GET['id'];

switch($page) {
    case '':
    case 'pocetna' :
        $page= 'pocetna';
    break;
    case 'jelovnik' :
        $page = 'jelovnik';
    break;
    case 'sign_in' :
        $page = 'sign_in';
    break;
    case 'sign_out' :
        $page= 'pocetna';
        break;
    case 'sign_up' :
        $page = 'sign_up';
    break;
    case 'admin' :
        $page = 'admin';
    break;
    case 'edit' :
        $page= 'edit';
        break;
    case 'add' :
         $page= 'add';
      break;
    case 'delete' :
        $page= 'delete';
    break;
    case 'narudzbe' :
        $page= 'narudzbe';
    break;
    case 'korpa' :
        $page= 'korpa';
    break;
    case 'blog' :
        $page= 'blog';
    break;
    default:
        $page = '404';
     break;
 }


$template_filename = DIR_TEMPLATE . "$page.php";

if(file_exists($template_filename))
    include_once($template_filename);
else
    die('Nepoznata stranica');

?>
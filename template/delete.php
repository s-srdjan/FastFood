<?php
$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if(isset($_GET["delete"])){
    $id = (int)$_GET["delete"];
    $slika = mysqli_query($db,"SELECT slika FROM jelovnik WHERE id = $id");
    $result = mysqli_fetch_assoc($slika);
    $file = "./public/img/".$result["slika"];
    unlink($file);
    $sql = "DELETE FROM jelovnik WHERE id = $id";
    mysqli_query($db,$sql);
    mysqli_close($db);
    header('Location: ./index.php?action=page&page=admin');
    exit();
}

?>
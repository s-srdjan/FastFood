<div class="edit">
<?php include_once('./includes/functions.php');?>

<h2>Dodavanje nove stavke u jelovnik</h2>

<form class="meni-edit" method="post" action="./modules/admin_add.php" enctype="multipart/form-data" >
    <label>Slika:</label>
    <input type="file"  name="fileToUpload" id="fileToUpload" required >
    <label> Naziv:</label>
    <input type="text" name="naziv" required >
    <label>Opis:</label>
    <input type="text" name="opis" required >
    <label>Cijena:</label>
    <input type="number" name="cijena" required step="0.01">   <label for="cijena"> KM</label>

    <button type="submit" class="btn" name="dodaj">Sačuvaj</button>

</form>

<?php

if(isset($_GET["error"])){
    
    if($_GET["error"] == "wrongFile"){
        echo "<p>Niste izabrali odgovarajući tip fajla !</p>";
    }
    else if($_GET["error"] == "exist"){
        echo "<p>Fajl već postoji !</p>";
    }
    else if($_GET["error"] == "large"){
        echo "<p>Veličina fajla prelazi ograničenje (300 kB) !</p>";
    }
    else if($_GET["error"] == "format"){
        echo "<p>Pogrešan format fajla !</p>";
    }
    else if($_GET["error"] == "upload_error"){
        echo "<p>Greška prilikom upload-a slike !</p>";
    }

    else if($_GET["error"] == "emptyinput"){
        echo "<p>Unesite sve potrebne podatke !</p>";
    }
    else if($_GET["error"] == "stmt_failed"){
        echo "<p>Greška prilikom dodavanja nove stavke u meni !</p>";
    }

    else if($_GET["error"] == "wrongInput"){
        echo "<p> Neispravno unešeni podaci (naziv,opis) !</p>";
    }
}

if (isset($_GET["msg"])) {
    if($_GET["msg"] == "success"){
        echo "<p>Uspješno dodavanje nove stavke u meni !</p>";
    }
}

?>
</div>
<?php 
$jelo = $jelovnik[$_GET["id"] - 1 ];
?>

<div class="edit">

    <form class="meni-edit" method="post" action="./modules/admin_edit.php" >
    <h1 class="form-heading">Izmjena podataka u jelovniku</h1>
        <img src="./public/img/<?=$jelo['slika']?>" alt="<?=$jelo['slika']?>" width="200">
        <input type="hidden" name="id" value="<?= (int)$_GET["id"]?>">
        <label>Naziv</label>
        <input name="naziv" value= "<?= $jelo['naziv'] ?>"> 
        <label>Opis</label>
        <input name="opis" value="<?= $jelo['opis'] ?>">
        <label>Cijena</label>
        <input type="number" required name="cijena" step="0.01" value="<?= $jelo['cijena'] ?>">  <label for="cijena"> KM</label>
        <button type="submit" class="btn" name="izmjeni">Sačuvaj izmjene</button>

</form>

</div>
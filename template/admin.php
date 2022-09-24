<?php 

if (isset($_GET["error"])) {
    if($_GET["error"] == "no_error"){
        echo "<p>Uspješno izvršena izmjena.</p>";
    }
    else if($_GET["error"] == "error"){
        echo "<p> Greška prilikom izmjene podataka !</p>";
    }
    else if($_GET["error"] == "emptyinput"){
      echo "<p> Unesite sve potrebne podatke !</p>";
    }
    else if($_GET["error"] == "wrongInput"){
      echo "<p> Neispravno unešeni podaci !</p>";
    }
   }

 if(!is_array($jelovnik) || empty($jelovnik)):?>
    <div class="info">Trenutno nema podataka u jelovniku</div>
 <?php else : ?>
<section class="card">

<?php foreach($jelovnik AS $j => $jelo): ?>

   <div>
    <img src="./public/img/<?=$jelo['slika']?>" alt="<?=$jelo['slika']?>">
    <h3><?= $jelo['naziv'] ?></h3>
    <p><?= $jelo['opis'] ?></p>
    <a href="./index.php?action=page&page=edit&id=<?= $jelo['id'] ?>" name="edit-btn" class="btn">Uredi   <i class="fas fa-edit" style="font-size:15px;color:white"></i></a>
    <a href="./index.php?action=page&page=delete&delete=<?= $jelo['id'] ?>" name="delete-btn" class="btn">Izbriši   <i class="fas fa-trash-alt" style="font-size:15px;color:white"></i></a>
  </div>
<?php endforeach; ?>
</section> 
<?php endif; ?>

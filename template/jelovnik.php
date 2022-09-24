<?php if(!is_array($jelovnik) || empty($jelovnik)): ?>
        <div class="info">Trenutno nema podataka u jelovniku</div>
<?php else : ?> 
 
<section class="card">
   <?php foreach($jelovnik AS $j => $jelo): ?>
       <div>
       <form method="post" action="./index.php?action=page&page=korpa">
        <img src="./public/img/<?=$jelo['slika']?>" alt="<?=$jelo['slika']?>">
        <h3><?= $jelo['naziv'] ?></h3>
        <p><?= $jelo['opis'] ?></p>
        <p class= "cijena"> Cijena: <?= $jelo['cijena'] ?> KM</p>
        <input type="number" class="product-quantity" name="quantity" value="1" size="2" />
        <input type="hidden" name="id" value="<?=$jelo['id']?>">
        <button type="submit" id = "naruci" class="btn" style="margin-left: 50px;">Naruči  <i class="fa fa-shopping-cart" style="font-size:15px;color:white"></i>
        </button>
       </form>
      </div>
    <?php endforeach; ?>
</section> 

 <?php endif; ?>
     
 

<?php if(!is_array($jelovnik) || empty($jelovnik)): ?>
        <div class="info">Trenutno nema podataka u jelovniku</div>
<?php else : ?> 
 
<section class="cards">
   <?php foreach($jelovnik AS $j => $jelo): ?>
       <div id="item">
       <form method="post" action="./index.php?action=page&page=korpa" id="order-form">
        <img src="./public/img/<?=$jelo['slika']?>" alt="<?=$jelo['slika']?>">
        <h3><?= $jelo['naziv'] ?></h3>
        <div id="desc">
          <p id="desc-text"><?= $jelo['opis'] ?></p>
        </div>
        <div id="price-qt">
          <p class= "cijena"> Cijena: <?= $jelo['cijena'] ?> KM</p>
          <input type="number" class="product-quantity" name="quantity" value="1" size="2" />
        </div>
        <input type="hidden" name="id" value="<?=$jelo['id']?>">
        <div id="order-submit">
          <button type="submit" class="btn">Naruči  <i class="fa fa-shopping-cart" style="font-size:15px;color:white"></i> </button>
        </div>
       </form>
      </div>
    <?php endforeach; ?>
</section> 

 <?php endif; ?>
     
 

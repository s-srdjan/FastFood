<div class="welcome">
  <a href="./index.php?action=page&page=pocetna"><p style="font-weight:bold">BN FAST FOOD <i class="fas fa-hamburger" style="font-size:50px;color:orange"></i> </p></a>
  <?php if($user === 'admin'): ?>
    <a href="./index.php?action=page&page=admin" class="meni-btn">Uređivanje Meni-a <i class="fas fa-cloud-meatball"  style="font-size:30px;color:orange" ></i></a>
    <a href="./index.php?action=page&page=narudzbe" class="meni-btn">Pregled narudžbi <i class="far fa-file-alt"  style="font-size:30px;color:orange" ></i></a>
  <?php else: ?>
    <p style="font-size:30px">Poruči <span style="font-style:italic; color:orange;">ONLINE</span> </p>
    <a href="./index.php?action=page&page=jelovnik" class="meni-btn">Meni <i class="fas fa-cloud-meatball"  style="font-size:30px;color:orange" ></i></a>
    <?php endif; ?>
  </div>
  
  <div class="slider">
    <div class="slide">
      <img src="./public/slideshow/slide1.jpg">
    </div>
    
    <div class="slide">
      <img src="./public/slideshow/slide2.jpg">
    </div>
    
    <div class="slide">
      <img src="./public/slideshow/slide3.jpg">
    </div>
    
    <div class="slide">
      <img src="./public/slideshow/slide4.jpg">
    </div>
  </div>
  <script type="text/javascript" src="public/js/script.js"></script>




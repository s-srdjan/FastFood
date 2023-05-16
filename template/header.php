<!DOCTYPE html>
<head> 
  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <?php $stranica = @$_GET['page'];
  switch($stranica){
    case '':
      case 'admin' :
        case 'edit' :
          case 'add' :
            case 'narudzbe' :
      $naslov = 'Admin';
      break;
    case 'pocetna':
      $naslov = 'Početna';
      break;
      case 'jelovnik':
      $naslov = 'Meni';
      break;
      case 'sign_in':
      $naslov = 'Ulogujte se';
      break;
      case 'sign_up':
      $naslov = 'Registrujte se';
      break;
      case 'korpa':
      $naslov = 'Vaša korpa';
      break;
      case 'blog':
        $naslov = 'Blog';
      break;
      default:
      $naslov = 'Nepostojeća stranica';
      break;
  } ?>
  
  <title><?=$naslov ?></title>
  <link rel="stylesheet" href="./public/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> 
</head>
<body>
<header>
  <nav class="navbar">
      <a class="logo nav-branding" href="./index.php?action=page&page=pocetna">BN Fast Food <i class="fas fa-hamburger" id="icon" ></i> </a>
      <?php if($user === 'admin'): ?>
        <a class="logo" href="./index.php?action=page&page=add">Dodaj u meni <i class="fas fa-plus-circle" id="icon"></i> </a>
        <a class="logo" href="./index.php?action=page&page=admin">Uredi meni <i class="fas fa-edit" id="icon"></i> </a>
        <a class="logo" href="./index.php?action=page&page=narudzbe">Narudžbe <i class="far fa-file-alt" id="icon"></i> </a>
        
      <?php endif; ?>
        <ul class="nav-menu">
            <li class="nav-item"> Dobro došli <?= $user  ?> </li>
            <?php if($user !== 'admin'): ?>
            <li class="nav-item"><a href="./index.php?action=page&page=blog" class="nav-link">Blog  <i class="fas fa-blog" id="icon" ></i></a></li>
            <li class="nav-item"><a href="./index.php?action=page&page=jelovnik" class="nav-link">Meni <i class="fas fa-cloud-meatball" id="icon"></i></a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['ulogovan']) && $_SESSION['ulogovan']) :?>
            <li class="nav-item"><a href="./modules/sign_out.php" class="nav-btn nav-link" style="color:orange;">ODJAVI SE</a></li>
            <?php else: ?>
            <li class="nav-item"><a href="./index.php?action=page&page=sign_in" class="nav-btn nav-link" style="color:orange;">PRIJAVI SE</a></li>
            <li class="nav-item"><a href="./index.php?action=page&page=sign_up" class="nav-btn nav-link">REGISTRUJ SE</a></li>
            <?php endif;?>
            <?php if($user !== 'admin'): ?>
            <?php $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ; ?>
            <li class="nav-item"><a href="./index.php?action=page&page=korpa" class="nav-link"><span id="cart-text">Vaša korpa</span> <i class="fa fa-shopping-cart" style="color:white"></i>  (<?= $num_items_in_cart;?>)</a></li>
            <?php endif;?>
        </ul>
      <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
  </nav>
</header>



<html>
<head> 
  <meta charset = "utf-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <?php $stranica = @$_GET['page'];
  switch($stranica){
    case '':
      case 'admin' :
        case 'edit' :
          case 'add' :
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
<nav>
    <a class="logo" href="./index.php?action=page&page=pocetna">BN Fast Food <i class="fas fa-hamburger" style="font-size:30px;color:orange"></i> </a>
    <?php if($user === 'admin'): ?>
      <a class="logo" href="./index.php?action=page&page=add">Dodaj u meni <i class="fas fa-plus-circle" style="font-size:30px;color:orange"></i> </a>
      <a class="logo" href="./index.php?action=page&page=admin">Uredi meni <i class="fas fa-edit" style="font-size:30px;color:orange"></i> </a>      
      <a href="./index.php?action=page&page=blog">Blog  <i class="fas fa-blog"  style="font-size:30px;color:orange;margin-right:10px;" ></i></a>
    <?php endif; ?>
    <ul>
    <li> Dobro došli <?= $user  ?> </li>
    <?php if($user !== 'admin'): ?>
    <a href="./index.php?action=page&page=blog">Blog  <i class="fas fa-blog"  style="font-size:20px;color:orange;margin-right:20px;" ></i></a>
    <a href="./index.php?action=page&page=jelovnik">Meni <i class="fas fa-cloud-meatball"  style="font-size:20px;color:orange;margin-right:20px;" ></i></a>
    <?php endif; ?>
    <?php if (isset($_SESSION['ulogovan']) && $_SESSION['ulogovan']) :?>
    <li><a href="./modules/sign_out.php" class="nav-btn" style="color:orange;">ODJAVI SE</a></li>
    <?php else: ?>
     <li><a href="./index.php?action=page&page=sign_in" class="nav-btn" style="color:orange;">PRIJAVI SE</a></li>
     <li><a href="./index.php?action=page&page=sign_up" class="nav-btn">REGISTRUJ SE</a></li>
    <?php endif;?>
    <?php if($user !== 'admin'): ?>
    <?php $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ; ?>
    <li><a href="./index.php?action=page&page=korpa">Vaša korpa <i class="fa fa-shopping-cart" style="font-size:17px;color:white"></i>  (<?= $num_items_in_cart;?>)</a></li>
    <?php endif;?>
    </ul>
</nav>

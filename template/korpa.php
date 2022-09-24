<?php
$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');
include_once('./includes/functions.php');

if (isset($_POST['id'], $_POST['quantity']) && is_numeric($_POST['id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['id'];
    $quantity = (int)$_POST['quantity'];
    
    $sql = "SELECT id,naziv, cijena 
    FROM jelovnik
    WHERE id = $product_id";

$result = mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)) {
    $resultset[] = $row;
}		

if ($resultset && $quantity > 0) {
    
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            
            $_SESSION['cart'][$product_id] = $quantity;
        }
    } else {
        
        $_SESSION['cart'] = array($product_id => $quantity);
    }
    header('location: ./index.php?action=page&page=jelovnik');
    exit;
}
    header('location: ./index.php?action=page&page=korpa');
    exit;
}


if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

if ($products_in_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $db->prepare('SELECT * FROM jelovnik WHERE id IN (' . $array_to_question_marks . ')');
    $arrayKeys = array_keys($products_in_cart);
    $stmt->bind_param(str_repeat("s", count($arrayKeys)), ...$arrayKeys);
    $stmt->execute();
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    foreach ($products as $product) {
        $subtotal += (float)$product['cijena'] * (int)$products_in_cart[$product['id']];
     }
 } 

 if(array_key_exists('narudzba', $_POST) && !empty($_SESSION['cart'])) {
     $num = count($products_in_cart); 
     foreach ($products as $product) {
          $name[] =  $product['naziv'];
          $qty[] = $products_in_cart[$product['id']];
        }
        // print_r($name);exit;

        createOrder($db, $name, $qty , key($_SESSION['ulogovan']), $num); 
}   
?>

<div class="cart content-wrapper">
    <h2>Vaša korpa</h2>
    <form  method="post">
        <table>
        <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Niste dodali proizvode u korpu!</td>
                </tr>
        <?php else: ?>
            <thead>
                <tr>
                    <td colspan="2">Prozivod</td>
                    <td>Jedinična cijena</td>
                    <td>Količina</td>
                    <td>Cijena</td>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <img src="./public/img/<?=$product['slika']?>" width="50" height="50" alt="<?=$product['naziv']?>">
                    </td>
                    <td>
                        <p><?=$product['naziv']?></p>                        
                        <a href="index.php?action=page&page=korpa&remove=<?=$product['id']?>" class="remove">Obriši</a>
                    </td>
                    <td class="price"><?=$product['cijena']?> KM</td>
                    <td class="quantity">
                        <p><?=$products_in_cart[$product['id']]?></p>
                    </td>
                    <td class="price"><?=$product['cijena'] * $products_in_cart[$product['id']]?>  KM</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Ukupno za plaćanje:</span>
            <span class="price"><?=$subtotal?>  KM</span>
        </div>
        <?php if (isset($_SESSION['ulogovan']) && $_SESSION['ulogovan']) :?>
        <div class="button">
            <input type="submit" value="Naruči" name="narudzba">
        </div>
        <?php else: ?>
            <p class ="error"> Prijavite se da biste izvršili narudžbu.</p>
        <?php endif;?>
    </form>
</div>
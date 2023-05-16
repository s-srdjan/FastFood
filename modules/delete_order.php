<?php

$db = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if(isset($_POST['delete'])){
   
$id_narudzba = $_POST['id_narudzba'];

$sql = "DELETE FROM narudzbe WHERE id_narudzba = ?";
$stmt = mysqli_prepare($db, $sql);

// Bind the id of the order to be deleted
mysqli_stmt_bind_param($stmt, 'i', $id_narudzba);

// Execute the delete statement
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($db);

// Redirect the user to the orders page
header('Location: ../index.php?action=page&page=narudzbe');
}
?>

<?php

$conn = mysqli_connect('localhost','root','','fast_food') or die('Greška pri povezivanju sa bazom.');

if ($user != 'admin') {
    header('Location: ./index.php?action=page&page=pocetna');
    exit();
}

$sql = "SELECT * FROM narudzbe";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class = 'orders-table'>";
    echo "<thead>
    <tr>
      <th>ID</th>
      <th>Naziv</th>
      <th>Količina</th>
      <th>Ime</th>
      <th>Prezime</th>
      <th>Adresa</th>
    </tr>
  </thead>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id_narudzba"] . "</td>";
        echo "<td>" . $row["naziv"] . "</td>";
        echo "<td>" . $row["kolicina"] . "</td>";
        echo "<td>" . $row["ime"] . "</td>";
        echo "<td>" . $row["prezime"] . "</td>";
        echo "<td>" . $row["adresa"] . "</td>";
        echo '<td><form method="post" action="./modules/delete_order.php">
        <input type="hidden" name="id_narudzba" value="' . $row["id_narudzba"] . '">
        <input class="delete-btn" type="submit" name="delete" value="Obriši">
        </form></td>';
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p class='empty-message'>Nema podataka o narudžbama.</p>";
}

mysqli_close($conn);
?>

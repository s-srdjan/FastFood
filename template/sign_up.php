<div class="wrapper">

    <form action="./modules/signup.mod.php" method="post" class="sign-form">
        <h2 class="form-heading">Unesite podatke za registraciju :</h2>
            <input type="text" name="ime" placeholder="Ime">
            <input type="text" name="prezime" placeholder="Prezime">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="adresa" placeholder="Adresa">
            <input type="text" name="br_tel" placeholder="Broj telefona (06x 123-456)">
            <input type="password" name="lozinka" placeholder="Lozinka">
            <button type="submit" name="submit" class="btn">Registruj se</button>
    </form>

<?php 

if (isset($_GET["error"])) {
    if($_GET["error"] == "emptyinput"){
        echo "<p>Popunite sva polja !</p>";
    }
    else if($_GET["error"] == "invalidemail"){
        echo "<p>Neispravna email adresa !</p>";
    }
    else if($_GET["error"] == "invalidphone"){
        echo "<p>Neispravan broj telefona !</p>";
    }
    else if($_GET["error"] == "stmtfailed"){
        echo "<p>Došlo je do greške, pokušajte ponovo !</p>";
    }
    else if($_GET["error"] == "taken"){
        echo "<p>Neispravni podaci (email ili telefon su vec u upotrebi) !</p>";
    }
}

?> 

</div>



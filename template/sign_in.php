
<div class ="wrapper">
<?php 

if (isset($_GET["error"])) {
    if($_GET["error"] == "emptyinput"){
        echo "<p>Popunite sva polja !</p>";
    }
    else if($_GET["error"] == "wrongLogin"){
        echo "<p>Neispravni podaci !</p>";
    }
}

?>
    <form action="./modules/signin.mod.php" method="post" class="sign-form">
    <h2 class="form-heading">Unesite vaš email i lozinku</h2>
            <input type="text" name="email" placeholder="Email" ><br>
            <input type="password" name="lozinka" placeholder="Lozinka" ><br>
            <button type="submit" name="form_btn" class="btn">Prijavi se</button>
    </form>



</div>





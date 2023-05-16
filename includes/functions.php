<?php


function proveri_sesiju()
{
	global $ime_kukija, $session_id;

	if (!isset($_COOKIE['PHPSESSID']))
	{
		zapocni_sesiju($session_id);
	}
}

function zapocni_sesiju($session_id)
{
	
	$_SESSION['id'] = $session_id;
	$_SESSION['server_name'] = $_SERVER['SERVER_NAME'];
	$_SESSION['server_addr'] = $_SERVER['SERVER_ADDR'];
	$_SESSION['server_port'] = $_SERVER['SERVER_PORT'];
	$_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'];

	$_SESSION['ulogovan'] ?? 'Gost';
}

function emptyInputSignup($ime, $prezime, $email, $adresa, $br_tel, $lozinka) {
	$result;
	if(empty($ime) || empty($prezime) || empty($email) || empty($adresa) || empty($br_tel) || empty($lozinka) ) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;  
}

function invalidPhone($br_tel) {
	$result;
	if (!preg_match("/^06[3-6][[:space:]]\d{3}\-\d{3}$/", $br_tel)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emailphoneExist($conn, $email, $br_tel) {
	$sql = "SELECT * FROM korisnici WHERE email = ? OR br_tel = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header('Location: ../index.php?action=page&page=sign_up&error=stmtfailed');
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss",$email,$br_tel);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else{
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn, $ime, $prezime, $email, $adresa, $br_tel, $lozinka){
	$new_user = "INSERT INTO korisnici (ime,prezime,email,adresa,br_tel,lozinka) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $new_user)) {
		header('Location: ../index.php?action=page&page=sign_up&error=stmtfailed');
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ssssss",  $ime, $prezime, $email, $adresa, $br_tel, $lozinka);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	$emailExists = emailphoneExist($conn, $email, $email);
	$_SESSION['ulogovan'] = array( $emailExists["id_korisnik"] =>  $emailExists["ime"]);

	header('Location: ../index.php?action=page&page=jelovnik');	
	exit();
}


function emptyInputSignIn($email, $lozinka) {
	$result;
	if(empty($email) || empty($lozinka) ) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function loginUser($db, $email, $lozinka){
	$emailExists = emailphoneExist($db, $email, $email);

	if($emailExists === false){
		header('Location: ../index.php?action=page&page=sign_in&error=wrongLogin');   
		exit();
	}

	$pwd = $emailExists["lozinka"];
	$checkPwd = strcmp($lozinka, $pwd);

	if($checkPwd != 0) {
		header('Location: ../index.php?action=page&page=sign_in&error=wrongLogin');    
		exit();
	}
	else if($checkPwd == 0) {
		session_start();
		$_SESSION['ulogovan'] = array( $emailExists["id_korisnik"] =>  $emailExists["ime"]);
		if($_SESSION['ulogovan'][$emailExists["id_korisnik"]] === 'admin'){
			header('Location: ../index.php');
		}else{
			header('Location: ../index.php?action=page&page=jelovnik');	
		}
		exit();
	}

}

function emptyInputAdd($naziv, $opis, $cijena) {
	$result;
	if(empty($naziv) || empty($opis) || empty($cijena)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

	function createItem($conn, $naziv, $opis, $cijena, $slika){
		$new_item = "INSERT INTO jelovnik (naziv,opis,cijena,slika) VALUES (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $new_item)) {
			header('Location: ../index.php?action=page&page=add&error=stmtfailed');
			exit();
		}
		mysqli_stmt_bind_param($stmt, "ssss",  $naziv, $opis, $cijena,$slika);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header('Location: ../index.php?action=page&page=add&msg=success');	
		exit();
	}

	function emptyInputEdit($naziv, $opis, $cijena) {
		$result;
		if(empty($naziv) || empty($opis) || empty($cijena)) {
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function invalidInput($naziv, $opis) {
		$result;
		if (((!preg_match("~^[\p{L}\p{Z}]+$~u", $naziv)) && 
		   ((!preg_match("~^[\p{L}\p{Z}\d\%]+$~u",$opis))))) {
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}


	function createOrder($connection, $naziv, $kolicina, $id, $num) {
		$podaci = "SELECT ime, prezime, adresa FROM korisnici WHERE id_korisnik = ?";
		$stmt = mysqli_prepare($connection, $podaci);
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$resultset = mysqli_fetch_assoc($result);
	
		$sql = "INSERT INTO narudzbe (naziv, kolicina, ime, prezime, adresa) VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($connection, $sql);
	
		for ($i = 0; $i < $num; $i++) {
			$naziv_item = $naziv[$i];
			$kolicina_item = $kolicina[$i];
			mysqli_stmt_bind_param($stmt, 'sisss', $naziv_item, $kolicina_item, $resultset['ime'], $resultset['prezime'], $resultset['adresa']);
			mysqli_stmt_execute($stmt);
		}
	
		mysqli_stmt_close($stmt);
		mysqli_close($connection);
	
		unset($_SESSION['cart']);
	
		header('Location: ./index.php?action=page&page=korpa&msg=success');
		exit();
	}

?>
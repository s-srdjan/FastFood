<?php 

class db {
    function __construct(){
        include_once('./config.php');

        $this->db_konekcija = false;
        $this->db_konekcija = new mysqli($server,$korisnicko_ime, $lozinka , $ime_baze_podataka);

        if($this->db_konekcija->connect_error){
            echo 'Došlo je do greške prilikom uspostavljanja veze sa bazom podataka.';
        exit;
        }
    }

    function citaj($sql){
        $podaci = [];
        $rezultat = $this->db_konekcija->query($sql);
        while($red = $rezultat->fetch_assoc()) {
            $podaci[] = $red;
        }
        return $podaci;
    }

    function __destruct(){
        $this->db_konekcija->close();
    }
}

?>
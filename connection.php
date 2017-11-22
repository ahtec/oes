<?php
define('DBSERVER', "localhost"); // de databaseserver
define('DBUSER', "root");        // de gebruikersnaam waarmee we inloggen op de database
define('DBPASS', "");            // het wachtwoord waarmee we inloggen op de database
define('DBASE', "oes");          // de database waar onze tabellen in staan




function connectToDb()
{
    $out;
    $out = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);
    return $out;
}
//CREATE TABLE `oes`.`item` ( `item` INT(8) NOT NULL , `description` VARCHAR(30) NOT NULL , `stock` INT(8) NOT NULL , `minStock` INT(8) NOT NULL , `maxStock` INT(8) NOT NULL , `warehouse` VARCHAR(10) NOT NULL , `delTime` INT(8) NOT NULL , PRIMARY KEY (`item`)) ENGINE = InnoDB;
  ?>

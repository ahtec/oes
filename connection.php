<?php

require_once './GDconnection.php';

function connectToDb() {
    $out;
    $out = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);
    return $out;
}

function geefOption($pWarehouse, $pSelectedWarehouse) {
    if ($pWarehouse != $pSelectedWarehouse) {
        $eruit = "<option          value=" . $pWarehouse . ">" . $pWarehouse . "</option>\n";
    } else {
        $eruit = "<option selected value=" . $pWarehouse . ">" . $pWarehouse . "</option>\n ";
    }
    return $eruit;
}

function oesLog($erinText) {
    $fh = fopen("oes.log", 'a+');
    fwrite($fh, date("F j, Y, g:i a"));
    fwrite($fh, $erinText . PHP_EOL);
    fclose($fh);
}
?>

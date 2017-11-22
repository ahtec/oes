<?php
session_start();
$item = $_SESSION['item'];
$desc = $_SESSION['desc'];
$stock = $_SESSION['stock'];
$minStock = $_SESSION['minStock'];
$maxStock = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];
require_once './connection.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Item</title>
        <script  src="commonFunctions.js"></script>  

    </head>
    <body>

        <table>
            <form name="insertItem" action="insertItemDB.php"   onsubmit="return validate(this)" method =POST>
                <!--<form name="insertItem"    onsubmit="return validate(this)" method =POST>-->

                <?php
                $conn = connectToDb();
                echo "Select artikel " . createTagSelect($conn, "item", $item);
                
echo <<<MYTAG
                        <tr> <td> item                  </td> <td><input type="text"   name="item" value=$item size="8" disabled="disabled" />
                        <tr> <td> item description      </td> <td><input type="text"   name="desc" value="$desc" size="30"  /> </td></tr>
                        <tr> <td> current stock         </td> <td><input type="number" name="stock" value=$stock size="30" /></td></tr>
                        <tr> <td> minimum stock allowed </td> <td><input type="number" name="minStock" value=$minStock size="30" /></td></tr>
                        <tr> <td> maximum stock         </td> <td><input type="number" name="maxStock" value=$maxStock size="30" /></td></tr>
                        <tr> <td> warehouse </td> <td>   
                                <select name="warehouse"> 
                                    <option value="west">Small items warehouse</option> 
                                    <option value="east">Bulk warehouse</option> 
                                    <option value="north">Temp controled</option> 
                                    <option value="south">Secured</option> 
                                </select>       
MYTAG;
                ?>    
                </tr> </td> 
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </table>



        <?php
        $conn = connectToDb();

        function createTagSelect($ParamConn, $selectidname, $p_item) {
            $sql = "SELECT `description` ,`item` FROM `item`;";
            $erinResultSet = $ParamConn->query($sql);

            $eruit = "<select id=$selectidname onChange=checkdouble(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
                $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
                if ($row['item'] == $p_item) {
                    $eruit .= "<option selected>";   // append new string information with .=
                } else {
                    $eruit .= "<option>";   // append new string information with .=
                }
                $eruit .= $row['description']; // make the option with only the naam out of the record set
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; // <select closing tag

            return $eruit; // return the result
        }
        ?>


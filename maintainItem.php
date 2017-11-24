<?php
session_start();
$item = $_SESSION['item'];
$desc = $_SESSION['desc'];
$stock = $_SESSION['stock'];
$minStock = $_SESSION['minStock'];
$maxStock = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];
require_once './connection.php';
require_once './item.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Item</title>
        <script  src="commonFunctions.js"></script>  
        <script>
            function verwerkWijzItem() {
                var searchString = document.getElementById("IDitem").selectedIndex;

//                console.log(searchString);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("xhttp.responseText"); 
                        console.log(xhttp.responseText); 
                        var jsonItemResponse = JSON.parse(xhttp.responseText)   ;
                        

//                            console.log("jsonItemResponse");
//                            console.log(jsonItemResponse);
                        document.getElementById("item").value      = jsonItemResponse.item;
                        document.getElementById("desc").value      = jsonItemResponse.description;
                        document.getElementById("stock").value     = jsonItemResponse.stock;
                        document.getElementById("minStock").value  = jsonItemResponse.minStock;
                        document.getElementById("maxStock").value  = jsonItemResponse.maxStock;
//                        document.getElementById("warehouse").value = jsonItemResponse.warehouse;
                    }
                };
                xhttp.open("GET", "searchItem.php?itemSearch=" + searchString, true);
                xhttp.send();


//                    item = 
//                }else
//                    insidetext();
            }

        </script>

    </head>
    <body>

        <table>
            <form name="insertItem" action="updateItemDB.php"   onsubmit="return validate(this)" method =POST>
                <!--<form name="insertItem"    onsubmit="return validate(this)" method =POST>-->

                <?php
                $conn = connectToDb();
                echo "Select artikel " . createTagSelect($conn, "IDitem", $item);
echo <<<MYTAG
                        <tr> <td> item                  </td> <td><input type="text"   name="item"     value=$item     id=item     size="8" disabled="disabled" /></td></tr>
                        <tr> <td> item description      </td> <td><input type="text"   name="desc"     value=$desc     id=desc     size="30"  /></td></tr>
                        <tr> <td> current stock         </td> <td><input type="number" name="stock"    value=$stock    id=stock    size="30"  /></td></tr>
                        <tr> <td> minimum stock allowed </td> <td><input type="number" name="minStock" value=$minStock id=minStock size="30"  /></td></tr>
                        <tr> <td> maximum stock         </td> <td><input type="number" name="maxStock" value=$maxStock id=maxStock size="30"  /></td></tr>
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

            $eruit = "<select id=$selectidname onChange=verwerkWijzItem(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
                $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
                if ($row['item'] == $p_item) {
                    $eruit .= "<option selected>";   // append new string information with .=
                } else {
                    $eruit .= "<option>";   // append new string information with .=
                }
                $eruit .= "[["; // make the option with only the naam out of the record set
                $eruit .= $row['item']; // make the option with only the naam out of the record set
                $eruit .= "]]  "; // make the option with only the naam out of the record set
                $eruit .= $row['description']; // make the option with only the naam out of the record set
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; // <select closing tag

            return $eruit; // return the result
        }
        ?>


<?php
session_start();
if (isset($_SESSION)){
//    
//    $item = $_SESSION['item'];
//    $desc = $_SESSION['desc'];
//    $stock = $_SESSION['stock'];
//    $minStock = $_SESSION['minStock'];
//    $maxStock = $_SESSION['maxStock'];
//    $warehouse = $_SESSION['warehouse'];
//    
    $item ="";
    $desc = "";
    $stock = 0;
    $minStock = 0;
    $maxStock =  0;
    $warehouse =  "west";
}
require_once './connection.php';
require_once './model.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Item</title>
        <script  src="commonFunctions.js"></script>  
        <script>
             function cansel() {
//                 alert()
                window.location.assign("orderMenu.html");
            }

            function verwerkWijzOrder() {
                var searchString = document.getElementById("IDorder").selectedIndex;
//                console.log(searchString);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
//                        console.log("xhttp.responseText"); 
//                        console.log(xhttp.responseText); 
                        var jsonItemResponse = JSON.parse(xhttp.responseText)   ;
//                            console.log("jsonItemResponse");
//                            console.log(jsonItemResponse);
                        document.getElementById("order").value     = jsonItemResponse.item;
                        document.getElementById("desc").value      = jsonItemResponse.description;
                        document.getElementById("orderDate").value = jsonItemResponse.stock;
                        document.getElementById("delDate").value   = jsonItemResponse.minStock;
                        document.getElementById("customer").value  = jsonItemResponse.maxStock;
                    }
                };
                xhttp.open("GET", "searchOrder.php?orderSearch=" + searchString, true);
                xhttp.send();
            }

        </script>

    </head>
    <body>

        <table>
            <form name="maintainOrderItem" action="updateOrderDB.php"   onsubmit="return validate(this)" method =POST>

                <?php
                $conn = connectToDb();
                echo "Select order " . createTagSelect($conn, "IDorder", $order);
                ?>    
                    <tr> <td> order                  </td> <td><input type="text"  name="item"      value=""   id=item      size="8"   /></td></tr>           
                    <tr> <td> order description      </td> <td><input type="text"  name="desc"      value=""   id=desc      size="50"  /></td></tr>
                    <tr> <td> Date Ordered           </td> <td><input type="date"  name="orderDate" value=0    id=orderDate size="30"  /></td></tr>
                    <tr> <td> Delivery date          </td> <td><input type="date"  name="delDate"   value=0    id=delDate   size="30"  /></td></tr>
                    <tr> <td> customer  </td> <td>   
                            <select name="customer" id="customer"> 
                            <option value="Schiphol">Schiphol</option> 
                            <option value="KLM">KLM</option> 
                            <option value="KCS">KCS</option> 
                            <option value="Meijn">Meijn</option> 
                        </select> 

                </tr> </td> 
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
            </form>
        </table>
        <button onclick="cansel()" >Ready</button>

        <?php
        if (isset($_REQUEST['errorTxt'])) {
            echo $_REQUEST['errorTxt'];
        }
        $conn = connectToDb();

        function createTagSelect($ParamConn, $selectidname, $p_order) {
            $sql = "SELECT `description` ,`order` FROM `order`;";
            $erinResultSet = $ParamConn->query($sql);

//            $eruit = "<select id=$selectidname onChange=verwerkWijzItem(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            $eruit = "<select id=$selectidname onClick=verwerkWijzOrderItem(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
                $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
//                if ($row['item'] == $p_item) {
//                    $eruit .= "<option selected>";   // append new string information with .=
//                } else {
                    $eruit .= "<option>";   // append new string information with .=
//                }
                $eruit .= "["; // make the option with only the naam out of the record set
                $eruit .= $row['item']; // make the option with only the naam out of the record set
                $eruit .= "]  "; // make the option with only the naam out of the record set
                $eruit .= $row['description']; // make the option with only the naam out of the record set
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; // <select closing tag

            return $eruit; // return the result
        }
        ?>




<?php
session_start();
require_once './connection.php';

if (isset($_SESSION)) {

    if (isset($_SESSION['item'])) {
        $item = $_SESSION['item'];
    } else {
        $item = vulSessieItemsGegevensMetEersteItem();
    }
    if (isset($_SESSION['desc'])) {
        $desc = $_SESSION['desc'];
    } else {
        $desc = "";
    }
    if (isset($_SESSION['stock'])) {
        $stock = $_SESSION['stock'];
    } else {
        $stock = 0;
    }
    if (isset($_SESSION['minStock'])) {
        $minStock = $_SESSION['minStock'];
    } else {
        $minStock = 0;
    }
    if (isset($_SESSION['maxStock'])) {
        $maxStock = $_SESSION['maxStock'];
    } else {
        $maxStock = 0;
    }
    if (isset($_SESSION['warehouse'])) {
        $warehouse = $_SESSION['warehouse'];
    } else {
        $warehouse = "";
    }
}
require_once './model.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Maintain Item</title>
        <link rel = "stylesheet" type = "text/css" href="oes.css"> 
        <script  src="commonFunctions.js"></script>  
        <script type="text/javascript">

//            var once = function () {
//                if (once.done)
//                    return;
//                console.log('Doing this once!');
//                once.done = true;
//            };
//
//            window.onload = once()
//


            function cansel() {
//                 alert()
                window.location.assign("itemMenu.html");
            }
            function verwerkWijzItem() {
                var searchString = document.getElementById("IDitem").selectedIndex;
                var clickedItem = document.getElementById("IDitem").selectedIndex;
//                console.log(searchString);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
//                        console.log("xhttp.responseText");
//                        console.log(xhttp.responseText);
                        var jsonItemResponse = JSON.parse(xhttp.responseText);
//                        console.log("jsonItemResponse");
//                        console.log(jsonItemResponse);
//                        document.getElementById("item").innerHTML      = jsonItemResponse.item;
                        document.getElementById("item").value = jsonItemResponse.item;
                        document.getElementById("desc").value = jsonItemResponse.description;
                        document.getElementById("stock").value = jsonItemResponse.stock;
                        document.getElementById("minStock").value = jsonItemResponse.minStock;
                        document.getElementById("maxStock").value = jsonItemResponse.maxStock;
                        document.getElementById("warehouse").value = jsonItemResponse.warehouse;
                    }
                };
                xhttp.open("GET", "searchItem.php?itemSearch=" + searchString, true);
                xhttp.send();
            }

        </script>

    </head>
    <body>
        <table>
            <form name="maintainItem" action="updateItemDB.php"   onsubmit="return validate(this)" method =GET>
                <!--<form name="insertItem"    onsubmit="return validate(this)" method =POST>-->

                <?php
                $conn = connectToDb();
                if ($item == 0) {
                    $item = vulSessieItemsGegevensMetEersteItem();
                }
                echo "<span id ='idselect'>Select artikel</span> " . createTagSelect($conn, "IDitem", $item);
                ?>    
                <tr> <td> item                  </td> <td><input type="text"    name="item"     value=<?php echo $item; ?>      id=item     size="8"   /></td></tr>           
                <tr> <td> item description      </td> <td><input type="text"    name="desc"     value=<?php echo $desc; ?>      id=desc     size="50"  /></td></tr>
                <tr> <td> current stock         </td> <td><input type="number"  name="stock"    value=<?php echo $stock; ?>     id=stock    size="30"  /></td></tr>
                <tr> <td> minimum stock allowed </td> <td><input type="number"  name="minStock" value=<?php echo $minStock; ?>  id=minStock size="30"  /></td></tr>
                <tr> <td> maximum stock         </td> <td><input type="number"  name="maxStock" value=<?php echo $maxStock; ?>  id=maxStock size="30"  /></td></tr>
                <tr> <td> warehouse </td> <td>   
                        <select name="warehouse" id=warehouse> 
                            <?php
                            echo geefOption("Small_items_warehouse", $warehouse);
                            echo geefOption("Bulk_warehouse", $warehouse);
                            echo geefOption("Temp_controled", $warehouse);
                            echo geefOption("Secured", $warehouse);
                            ?>
                        </select>       
<!--                <tr> <td> item                  </td> <td><input type="text"    name="item"     value=0          id=item     size="8"   /></td></tr>           
                <tr> <td> item description      </td> <td><input type="text"    name="desc"     value=""        id=desc     size="50"  /></td></tr>
                <tr> <td> current stock         </td> <td><input type="number"  name="stock"    value=0         id=stock    size="30"  /></td></tr>
                <tr> <td> minimum stock allowed </td> <td><input type="number"  name="minStock" value=0         id=minStock size="30"  /></td></tr>
                <tr> <td> maximum stock         </td> <td><input type="number"  name="maxStock" value=0         id=maxStock size="30"  /></td></tr>
                <tr> <td> warehouse </td> <td>   
                        <select name="warehouse" id=warehouse> 
                            <option value="Small_items_warehouse"> Small_items_warehouse</option> 
                            <option value="Bulk_warehouse"> Bulk_warehouse</option> 
                            <option value="Temp_controled">Temp_controled</option> 
                            <option value="Secured">Secured</option> 
                        </select>       -->

                </tr> </td> 
        </table>
        <br><br>   <input type="submit" value="OK" id=screenButtons">
    </form>

    <div class="backButton" >
        <a href="itemMenu.html" >Cancel</a>


        <?php
        if (isset($_REQUEST['errorTxt'])) {
            echo $_REQUEST['errorTxt'];
        }
        $conn = connectToDb();

        function createTagSelect($ParamConn, $selectidname, $p_item) {
            $sql = "SELECT `description` ,`item` FROM `item`;";
            $erinResultSet = $ParamConn->query($sql);

//            $eruit = "<select id=$selectidname onChange=verwerkWijzItem(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            $eruit = "<select id=$selectidname onClick=verwerkWijzItem(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
                $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
                if ($row['item'] == $p_item) {
                    $eruit .= "<option selected>";   // append new string information with .=
                } else {
                    $eruit .= "<option>";   // append new string information with .=
                }
                $eruit .= "["; // make the option with only the naam out of the record set
                $eruit .= $row['item']; // make the option with only the naam out of the record set
                $eruit .= "]  "; // make the option with only the naam out of the record set
                $eruit .= $row['description']; // make the option with only the naam out of the record set
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; // <select closing tag

            return $eruit; // return the result
        }

        function vulSessieItemsGegevensMetEersteItem() {
            $conn = connectToDb();
            $sql = "SELECT *  FROM `item`  WHERE 1 LIMIT 1 offset 1 ";
            $resultSet = $conn->query($sql);
            $row = $resultSet->fetch_assoc();
//            var_dump($row);
            $item = $row['item'];
            $desc = $row['description'];
            $stock = $row['stock'];
            $minStock = $row['minStock'];
            $maxStock = $row['maxStock'];
            $warehouse = $row['warehouse'];
            $_SESSION['item'] = $row['item'];
            $_SESSION['desc'] = $row['description'];
            $_SESSION['stock'] = $row['stock'];
            $_SESSION['minStock'] = $row['minStock'];
            $_SESSION['maxStock'] = $row['maxStock'];
            $_SESSION['warehouse'] = $row['warehouse'];


            return $item;
        }

       
        ?>




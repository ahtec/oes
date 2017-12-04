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
                <tr> <td> item description      </td> <td><input type="text"    name="desc"     value="<?php echo $desc; ?>"      id=desc     size="50"  /></td></tr>
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
            $sql           = "SELECT `description` ,`item` FROM `item`;";
            $erinResultSet = $ParamConn->query($sql);
            $eruit = "<select id=$selectidname onClick=verwerkWijzItem(); >";  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {
                $row = $erinResultSet->fetch_assoc();  
                if ($row['item'] == $p_item) {
                    $eruit .= "<option selected>";   
                } else {
                    $eruit .= "<option>";   
                }
                $eruit .= "["; 
                $eruit .= $row['item']; 
                $eruit .= "]  "; 
                $eruit .= $row['description'];
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; 

            return $eruit; 
        }

        function vulSessieItemsGegevensMetEersteItem() {
            $conn                  = connectToDb();
            $sql                   = "SELECT *  FROM `item`  WHERE 1 LIMIT 1 offset 1 ";
            $resultSet             = $conn->query($sql);
            $row                   = $resultSet->fetch_assoc();
//            var_dump($row);
            $item                  = $row['item'];
            $desc                  = $row['description'];
            $stock                 = $row['stock'];
            $minStock              = $row['minStock'];
            $maxStock              = $row['maxStock'];
            $warehouse             = $row['warehouse'];
            $_SESSION['item']      = $row['item'];
            $_SESSION['desc']      = $row['description'];
            $_SESSION['stock']     = $row['stock'];
            $_SESSION['minStock']  = $row['minStock'];
            $_SESSION['maxStock']  = $row['maxStock'];
            $_SESSION['warehouse'] = $row['warehouse'];

            return $item;
        }
        ?>




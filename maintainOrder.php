<?php
session_start();
require_once './connection.php';

if (isset($_SESSION)) {
    if (isset($_SESSION['order'])) {
        $order = $_SESSION['order'];
    } else {
        $order = vulSessieOrderGegevensMetEersteOrder();
    }
    if (isset($_SESSION['desc'])) {
        $desc = $_SESSION['desc'];
    } else {
        $desc = "";
    }
    if (isset($_SESSION['orderDate'])) {
        $orderDate = $_SESSION['orderDate'];
    } else {
        $orderDate = date("2017-12-4");
    }

    if (isset($_SESSION['delDate'])) {
        $delDate = $_SESSION['delDate'];
    } else {
        $delDate = date("2017-12-4");
    }
    if (isset($_SESSION['customer'])) {
        $customer = $_SESSION['customer'];
    } else {
        $customer = "";
    }



//    $order = 0;
//    $desc = "";
//    $orderDate = date("yyyy-MM-dd");
//    $delDate = date("yyyy-MM-dd");
//    $customer = "";
}
require_once './model.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Prder</title>
        <link rel = "stylesheet" type = "text/css" href="oes.css"> 
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
                        var jsonResponse = JSON.parse(xhttp.responseText);
//                        console.log("jsonResponse");
//                        console.log(jsonResponse);
                        document.getElementById("order").value = jsonResponse.order;
                        document.getElementById("desc").value = jsonResponse.description;
                        document.getElementById("orderDate").value = jsonResponse.orderDate;
                        document.getElementById("delDate").value = jsonResponse.delDate;
                        document.getElementById("customer").value = jsonResponse.customer;
                    }
                };
                xhttp.open("GET", "searchOrder.php?orderSearch=" + searchString, true);
                xhttp.send();
            }

        </script>

    </head>
    <body>
        <form name="maintainOrder" action="updateOrderDB.php"   onsubmit="return validate(this)" method =GET>

            <table>

                <?php
                $conn = connectToDb();
                if ($order == 0) {
                    $order = vulSessieOrderGegevensMetEersteOrder();
                }
//                echo "customerr";
//                echo $customer;
                echo "<span id ='idselect'>Select order</span> " . createTagSelect($conn, "IDorder", $order);
                ?>    
                <tr> <td> order                  </td> <td><input type="text"  name="order"     value=<?php echo $order; ?>   id="order"   size="8"   /></td></tr>           
                <tr> <td> order description      </td> <td><input type="text"  name="desc"      value="<?php echo $desc; ?>"   id="desc"    size="50"  /></td></tr>
                <tr> <td> Date Ordered           </td> <td><input type="date"  name="orderDate" value=<?php echo $orderDate; ?>   id=orderDate size="30"  /></td></tr>
                <tr> <td> Delivery date          </td> <td><input type="date"  name="delDate"   value=<?php echo $orderDate; ?>   id=delDate   size="30"  /></td></tr>
                <tr> <td> customer  </td> <td>   
                        <select name="customer" id="customer"> 
                            <?php
                            echo geefOption("Schiphol", $customer);
                            echo geefOption("KLM", $customer);
                            echo geefOption("KCS", $customer);
                            echo geefOption("Meijn", $customer);
                            ?>
                        </select> 
<!--                <tr> <td> order                  </td> <td><input type="text"  name="order"     value=""              id="order"   size="8"   /></td></tr>           
                <tr> <td> order description      </td> <td><input type="text"  name="desc"      value=""              id="desc"    size="50"  /></td></tr>
                <tr> <td> Date Ordered           </td> <td><input type="date"  name="orderDate" value="2017-11-27"    id=orderDate size="30"  /></td></tr>
                <tr> <td> Delivery date          </td> <td><input type="date"  name="delDate"   value="2017-11-28"    id=delDate   size="30"  /></td></tr>
                <tr> <td> customer  </td> <td>   
                        <select name="customer" id="customer"> 
                            <option value="Schiphol">Schiphol</option> 
                            <option value="KLM">KLM</option> 
                            <option value="KCS">KCS</option> 
                            <option value="Meijn">Meijn</option> 
                        </select> -->

                </tr> </td> 
            </table>
            <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </form>
        <button onclick="cansel()" >Ready</button>

        <?php
        if (isset($_REQUEST['errorTxt'])) {
            echo $_REQUEST['errorTxt'];
            if ($_REQUEST['errorTxt'] == "Changes are implemented") {


                echo "<div class=backButton ><a href=insertOrderLines.php >Insert Orderlines</a>";
            }
        }
        $conn = connectToDb();

        function createTagSelect($ParamConn, $selectidname, $p_order) {
            $sql = "SELECT `description` ,`order` FROM `order`;";
            $erinResultSet = $ParamConn->query($sql);
            $eruit = "<select id=$selectidname onClick=verwerkWijzOrder(); >";  // assign the <select> openings tag with id and event=functioncall as string  
            for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
                $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
                if ($row['order'] == $p_order) {
                    $eruit .= "<option selected>";   // append new string information with .=
                } else {
                    $eruit .= "<option>";   // append new string information with .=
                }
                $eruit .= "["; // make the option with only the naam out of the record set
                $eruit .= $row['order']; // make the option with only the naam out of the record set
                $eruit .= "]  "; // make the option with only the naam out of the record set
                $eruit .= $row['description']; // make the option with only the naam out of the record set
                $eruit .= "</option>";
            }
            $eruit .= "</select>"; // <select closing tag

            return $eruit; // return the result
        }

        function vulSessieOrderGegevensMetEersteOrder() {
            $conn = connectToDb();
            $sql = "SELECT *  FROM `order`  WHERE 1 LIMIT 1 offset 1 ";
            echo $sql;
            $resultSet = $conn->query($sql);
            $row = $resultSet->fetch_assoc();
            $order = $row['order'];
            $desc = $row['description'];
            $orderDate = $row['orderDate'];
            $delDate = $row['delDate'];
            $customer = $row['customer'];
            $_SESSION['order'] = $row['order'];
            $_SESSION['desc'] = $row['description'];
            $_SESSION['orderDate'] = $row['orderDate'];
            $_SESSION['delDate'] = $row['delDate'];
            $_SESSION['customer'] = $row['customer'];
//            echo $customer;

            return $order;
        }
        ?>




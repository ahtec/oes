<?php
session_start();
if (isset($_SESSION)) {
    $order = 0;
    $desc = "";
    $orderDate = date("yyyy-MM-dd");
    $delDate = date("yyyy-MM-dd");
    $customer = "";
}
require_once './connection.php';
require_once './model.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Prder</title>
        <script  src="commonFunctions.js"></script>  
        <script>
            function cansel() {
                window.location.assign("reportMenu.html");
            }
        </script> 
        <link rel = "stylesheet" type = "text/css" href="oesCss.css"> 


    </head>
    <body>


        <?php
//SELECT * FROM `orderlines` 
//JOIN  `order`   on `orderlines` .`order` = `order`.`order`;

        $sql = "SELECT * , `order`.`description` as orderDescription  ,  `item`.`description`  as itemDescription     FROM `orderlines` " .
                "JOIN  `order`  on  `orderlines` .`order` =  `order`.`order` " .
                "JOIN  `item`   on  `orderlines`.`item`   =  `item`.`item`" .
                "ORDER BY warehouse  ,  `order`.`order` ";


        $conn = connectToDb();
        $result = $conn->query($sql);
        $previousWarehouse = "zzzzzzzzzzzzzzzzzzzzzz";

        while ($row = mysqli_fetch_array($result)) {
            if ($previousWarehouse != $row['warehouse']) {
                echo "<table>";
                echo "<tr><td id=warehouse>";
                echo " Items for Warehouse: " . $row['warehouse'];
                echo "</tr></td>";
                echo "</table>";
                echo "<table id=t01>";
                echo "<tr> <th> Item   </th><th> Description </th><th> Amount </th> <th> Order </th><th> Description </th> ";
                $previousWarehouse = $row['warehouse'];
            }
            echo "<tr>";
            echo "<td id=colom >" . $row['item'] . "</td>";
            echo "<td>" . $row['itemDescription'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['order'] . "</td>";
            echo "<td>" . $row['orderDescription'] . "</td>";
            echo "</tr>\n";
        }
        echo "</table>";
        ?>      
        
        <div class="backButton" >
                <a href="reportMenu.html" >back</a>
        
    </body>


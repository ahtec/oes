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

    </head>
    <body>


        <?php
//SELECT * FROM `orderlines` 
//JOIN  `order`   on `orderlines` .`order` = `order`.`order`;

        $sql = "SELECT * , `order`.`description` as orderDescription  ,  `item`.`description`  as itemDescription     FROM `orderlines` " .
                "JOIN  `order`  on  `orderlines` .`order` =  `order`.`order` " .
                "JOIN  `item`   on  `orderlines`.`item`   =  `item`.`item`" .
                "ORDER BY warehouse  ,  `order`.`order` ";


//SELECT * FROM `orderlines` JOIN `order` on `orderlines` .`order` = `order`.`order` JOIN `item` on `orderlines`.`item` = `item`.`item`  ORDER BY warehouse  ,  `order`.`order` ;
echo $sql;
//    echo "<br>" . $sql . "<br>";
        $conn = connectToDb();
        $result = $conn->query($sql);
//    var_dump($result);
        $previousWarehouse = "zzzzzzzzzzzzzzzzzzzzzz";
        echo "<table>";
        while ($row = mysqli_fetch_array($result)) {



            if ($previousWarehouse != $row['warehouse']) {
                echo "<tr><td id=warehouse>";

                echo " Items for Warehouse: " . $row['warehouse'];
                echo "</tr></td>";
                $previousWarehouse = $row['warehouse'];
            }
            echo "<tr>";
            echo "<td>" . $row['order'] . "</td>";
            echo "<td>" . $row['orderDescription'] . "</td>";
            echo "<td>" . $row['item'] . "</td>";
            echo "<td>" . $row['itemDescription'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
//            echo "<td>" . $row['warehouse'] . "</td>";
            echo "</tr>\n";
        }
        echo "</table>";
        ?>       

    </body>

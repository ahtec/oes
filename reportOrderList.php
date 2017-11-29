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
        <title>Purchase Items list</title>
        <script  src="commonFunctions.js"></script>  
        <link rel = "stylesheet" type = "text/css" href="oesLijst.css"> 
    </head>
    <body>
        <?php
        $sql = "SELECT * FROM item";
        $conn = connectToDb();
        $result = $conn->query($sql);
        $items = array();

        while ($row = mysqli_fetch_array($result)) {
            $objItem = new item();
            $objItem->item = $row['item'];
            $objItem->description = $row['description'];
            $objItem->stock = $row['stock'];
            $objItem->minStock = $row['minStock'];
            $objItem->maxStock = $row['maxStock'];
            $objItem->warehouse = $row['warehouse'];
            $items[] = $objItem;
        }


        echo "<table>";
        echo "<tr><td id=warehouse>";
        echo " Purchase Items list ";
        echo "</tr></td>";
        echo "</table>";
        echo "<table id=orderlist>";
        echo "<tr> <th> Item   </th>"
        . "<th> Description </th>"
        . "<th> Stock </th> "
        . "<th> Amount to order </th> "
        . "<th> Minimum Stock </th>"
        . "<th> Maximum stock </th> "
        . "<th> Warehouse </th> ";

        for ($i = 0; $i < count($items); $i++) {
            $objItem = $items[$i];
            if ($objItem->isHetnoodzakelijkDeVoorraadAanTeVullen() == true) {
                echo "<tr id=colomAanvullen>";
            } else {
                echo "<tr id=colomn>";
            }
            echo "<td >" . $objItem->item . "</td>";
            echo "<td>" . $objItem->description . "</td>";
            echo "<td>" . $objItem->stock . "</td>";
            echo "<td>" . $objItem->aanvvulling() . "</td>";
            echo "<td>" . $objItem->minStock . "</td>";
            echo "<td>" . $objItem->maxStock . "</td>";
            echo "<td>" . $objItem->warehouse . "</td>";
            echo "</tr>\n";
        }
        echo "</table>";
        ?>     

        <div class="backButton" >
            <a href="reportMenu.html" >back</a>

    </body>


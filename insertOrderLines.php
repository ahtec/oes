<?php
session_start();
$order     = $_SESSION['order'];
$desc      = $_SESSION['desc'];
$orderDate = $_SESSION['orderDate'];
$delDate   = $_SESSION['delDate'];
$customer  = $_SESSION['customer'];
require_once './connection.php';

if (isset($_REQUEST)) {
    if (isset($_REQUEST['errorText'])) {
        echo $_REQUEST['errorText'];
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Maintain Orderlines</title>
        <link rel = "stylesheet" type = "text/css" href="oes.css"> 
        <script  src="commonFunctions.js"></script>  
        <script>
            function cansel() {
                window.location.assign("maintainOrder.php");
            }
        </script>
    </head>
    <body>
        <table>
            <?php
echo <<<MYTAG
                        <tr> <td> order             </td> <td> $order    </td></tr>
                        <tr> <td> order description </td> <td> $desc     </td></tr>
                        <tr> <td> order date        </td> <td> $orderDate </td></tr>
                        <tr> <td> delivery date     </td> <td> $delDate  </td></tr>
                        <tr> <td> customer          </td> <td> $customer </td></tr>
MYTAG;
            ?>
        </td></tr>
</table>  

<?php
$conn = connectToDb();
if (!$conn->connect_error) {
    $sql        = sprintf("SELECT * FROM  `orderlines`  where  `order` = %d", $order);
    $result     = mysqli_query($conn, $sql);
    $sql        = sprintf("SELECT * FROM  `item` ");
    $itemResult = mysqli_query($conn, $sql);
}

echo "<table> <th> Item in order  </th><th> Amount </th>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['item'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<form name=insertOrderLinesDB   action=insertOrderLinesDB.php   method =GET>";
echo "<table><th> All Avialable  Items </th><th> Amount </th><th> </th><th> </th><th> Description </th><th> Stock </th><th> Warehouse </th>";
$i   = 0;
while ($row = mysqli_fetch_array($itemResult)) {
    $aantal = geefAnntalVanItemInOrderLines($order, $row['item']);
    $i++;
    echo "<tr>";
    echo "<td>" . $row['item'] . "</td><td> <input type=text name=aantal" . $i . "  id=IDnaam  value =$aantal  > </td>";
    echo "<td>" . "</td><td> <input type=hidden name=hiddenaantal" . $i . "  id=IDnaam  value =$aantal   > </td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['stock'] . "</td>";
    echo "<td>" . $row['warehouse'] . "</td>";
    echo "</tr>";
}
?>

    </table>
<tr> <td>   </td> <td>    <input type=submit value=Ready >   </td> </tr>
</form>
<button onclick="cansel()" >Cancel</button>
</body>
</html>

<?php

function geefAnntalVanItemInOrderLines($pOrder, $pItem) {
    $aantalItemsInOrder = 0;
    $conn               = connectToDb();
    $sql                = sprintf("SELECT * FROM  `orderlines`  where  `order` = %d   and `item` = %d ", $pOrder, $pItem);
//    echo $sql;
    $result             = mysqli_query($conn, $sql);
    if (count($result) == 0) {
        return 0;
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $aantalItemsInOrder += $row['amount'];
        }
    }
    return $aantalItemsInOrder;
}
?>



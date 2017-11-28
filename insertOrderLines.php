<?php
session_start();
$order = $_SESSION['order'];
$desc = $_SESSION['desc'];
$orderDate = $_SESSION['orderDate'];
$delDate = $_SESSION['delDate'];
$customer = $_SESSION['customer'];
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
        <script  src="commonFunctions.js"></script>  
        <script>
            function cansel() {
                window.location.assign("orderMenu.html");
            }
        </script>
    </head>
    <body>
        <table>
            <form name="displayOrder" action="insertOrder.php"    method =POST>
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
            <!--<tr> <td> hours to get this <br>item delivered to the <br>warehouse</td> <td><input type="text" name="delTime" value="10" size="30" /></td></tr>-->
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons></td></tr>
        </table>  
    </form>

<?php
//lees orderlines 
$conn = connectToDb();
if (!$conn->connect_error) {
    $sql = sprintf("SELECT * FROM  `orderLines`  where  `order` = %d", $order);
//    echo $sql;
    $result = mysqli_query($conn, $sql);

    $sql = sprintf("SELECT * FROM  `item` ");
//    echo $sql;
    $itemResult = mysqli_query($conn, $sql);
}

echo "<table>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['order'] . "</td>";
    echo "<td>" . $row['item'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['lineText'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<form name=insertOrderLinesDB   action=insertOrderLinesDB.php   method =GET>";

echo "<table>";
$i = 0;
while ($row = mysqli_fetch_array($itemResult)) {
    $aantal = geefAnntalVanItemInOrderLines($order, $row['item']);
    $i++;
    echo "<tr>";
    echo "<td>" . $row['item'] . "</td><td> <input type=text name=aantal" . $i . "  id=IDnaam  value =$aantal  > </td>";
    echo "<td>" . $row['item'] . "</td><td> <input type=hidden name=hiddenaantal" . $i . "  id=IDnaam  value =$aantal   > </td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo " <tr> <td>   </td> <td>    <input type=submit value=Ready >   </td> </tr>";

echo "</form>";

//mysqli_close($conn);
?>

    <button onclick="cansel()" >Cancel</button>

</body>
</html>



<?php

function geefAnntalVanItemInOrderLines($pOrder, $pItem) {
    $aantalItemsInOrder = 0;
    $conn = connectToDb();
    $sql = sprintf("SELECT * FROM  `orderLines`  where  `order` = %d   and `item` = %d ", $pOrder, $pItem);
//    echo $sql;
    $result = mysqli_query($conn, $sql);
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



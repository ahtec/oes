<html>
    <head>
        <title>Order Entry Sytem</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel = "stylesheet" type = "text/css" href="oesCss.css"> 
         
         
           <script>
        function cansel() {
                window.location.assign("orderMenu.html");
            }

        </script>

    </head>
    <body>

<?php
session_start();
require_once './connection.php';
$returnText = "";

$conn = connectToDb();

if (!$conn->connect_error) {
    $sql="SELECT * FROM `order`";
    $result = $conn->query($sql);
    echo "<table>
            <tr>
                <th>Order</th>
                <th>Description</th>
                <th>order Date</th>
                <th>Delivery Date Stock</th>
                <th>Customer</th>
            </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['order'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['orderDate'] . "</td>";
        echo "<td>" . $row['delDate'] . "</td>";
        echo "<td>" . $row['customer'] . "</td>";
//        echo "<td>" . $row['item'] . "</td>";
//        echo "<td>" . $row['description'] . "</td>";
//        echo "<td>" . $row['stock'] . "</td>";
//        echo "<td>" . $row['minStock'] . "</td>";
//        echo "<td>" . $row['maxStock'] . "</td>";
//        echo "<td>" . $row['warehouse'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn);
}
    ?>


<button onclick="cansel()" >Ready</button>
</body>

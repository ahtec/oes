<html>
    <head>
        <title>Order Entry Sytem</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href="oes.css"> 
    </head>
    <body>

        <?php
        session_start();
        require_once './connection.php';
        $returnText = "";

        $conn = connectToDb();

        if (!$conn->connect_error) {
            $sql    = "SELECT * FROM `item`";
            $result = $conn->query($sql);
            echo "<table>";
            echo "<tr><td id=warehouse>";
            echo "Display  all Items      ";
            echo "</tr></td>";
            echo "</table>";
            echo "<table>
            <tr>
                <th>Item</th>
                <th>Descriptionww</th>
                <th>Stock</th>
                <th>Minnimum Stock</th>
                <th>Maximum Stock</th>
                <th>Warehouse</th>
            </tr>";
            while ($row    = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['item'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['minStock'] . "</td>";
                echo "<td>" . $row['maxStock'] . "</td>";
                echo "<td>" . $row['warehouse'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($conn);
        }
        ?>

        <div class="backButton" >
            <a href="itemMenu.html" >back</a>
    </body>

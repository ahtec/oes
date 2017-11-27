<?php
session_start();
$order = $_SESSION['order'];
$desc = $_SESSION['desc'];
$orderDate = $_SESSION['orderDate'];
$delDate = $_SESSION['delDate'];
$customer = $_SESSION['customer'];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Item</title>
        <script  src="commonFunctions.js"></script>  
        <script>
            function cansel() {
//                toCansel = true;
                window.location.assign("orderMenu.html");
//               alert("In de cansel")
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
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </table>  
    </form>
    <button onclick="cansel()" >Cansel</button>

    
    
    
</body>
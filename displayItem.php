<?php
session_start();
$item = $_SESSION['item'];
$desc = $_SESSION['desc'];
$stock = $_SESSION['stock'];
$minStock = $_SESSION['minStock'];
$maxStock = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Item</title>
        <script  src="commonFunctions.js"></script>  

    </head>
    <body>
        <table>
                    <form name="displayItem" action="insertItem.php"    method =POST>
                        <?php
echo <<<MYTAG
                        <tr> <td> item                  </td> <td> $item     </td></tr>
                        <tr> <td> item description      </td> <td> $desc     </td></tr>
                        <tr> <td> current stock         </td> <td> $stock    </td></tr>
                        <tr> <td> minimum stock allowed </td> <td> $minStock </td></tr>
                        <tr> <td> maximum stock         </td> <td> $maxStock </td></tr>
                        <tr> <td> warehouse             </td> <td> $warehouse</tr></td> 
MYTAG;
                        ?>
                </td></tr>
            <!--<tr> <td> hours to get this <br>item delivered to the <br>warehouse</td> <td><input type="text" name="delTime" value="10" size="30" /></td></tr>-->
            <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </table>  




    </body>
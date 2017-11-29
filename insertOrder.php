<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Order</title>
         <link rel = "stylesheet" type = "text/css" href="oes.css"> 
        

        <script  src="commonFunctions.js"></script>  
        <script>     function validate(form) {
                fail = validateContent(form.item.value, "Item")
                fail += validateContent(form.desc.value, "Description")

                if (fail == "")
                    return true
                else {
                    alert(fail);
                    return false
                }
            }
            function cansel() {
//                toCansel = true;
                window.location.assign("orderMenu.html");
//               alert("In de cansel")
            }
        </script>


    </head>
    <body>
        <?php
        if (isset($_REQUEST)) {
//            echo "<br>sadfds".$_REQUEST['errorText'];;
            if (isset($_REQUEST['errorTxt'])) {
                $errorTxt = $_REQUEST['errorTxt'];
                echo "<p id=errorTxt>";
                echo "<h2> " . $errorTxt . "</h2> ";
                echo "</p>";
            }
        }
        ?>

        <table>
            <form name="insertOrder" action="insertOrderDB.php"   onsubmit="return validate(this)" method =POST>
                <!--<form name="insertItem"    onsubmit="return validate(this)" method =POST>-->
                <tr> <td> order                 </td> <td><input type="text"   name="order" value="To be generated" size="8" disabled="disabled" />
                <tr> <td> description           </td> <td><input type="text"   name="desc" value="" size="30"  /> </td></tr>
                <tr> <td> order date            </td> <td><input type="date"   name="orderDate" value="0" size="30" /></td></tr>
                <tr> <td> delivery date         </td> <td><input type="date"   name="delDate" value="0" size="30" /></td></tr>
                <tr> <td> customer td>   
                        <select name="customer"> 
                            <option value="Schiphol">Schiphol</option> 
                            <option value="KLM">KLM</option> 
                            <option value="KCS">KCS</option> 
                            <option value="Meijn">Meijn</option> 
                        </select> 
                </tr> </td> 
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </table>
    </form>   
 <br><br>   <button onclick="cansel()" >Cansel</button>

</body>
</html>

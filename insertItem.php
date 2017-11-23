<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert Item</title>
        <script  src="commonFunctions.js"></script>  
        <script>
            var toCansel = false;
            function validate(form) {
                if (!toCansel) {
                    fail = validateContent(form.item.value, "Item")
                    fail += validateContent(form.desc.value, "Description")

                    if (fail == "")
                        return true
                    else {
                        alert(fail);
                        return false
                    }
                }
            }

            function deOk()
            {
                document.location = 'insertItemDB.php';

            }
            function cansel() {
//                toCansel = true;
                window.location.assign("itemMenu.html");
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
            <form name="insertItem" action="insertItemDB.php"   onsubmit="return validate(this)" method =POST>
            <!--<form name="insertItem"    method =POST>-->
            <!--<form name="insertItem"    onsubmit="return validate(this)" method =POST>-->
                <tr> <td> item                  </td> <td><input type="text"   name="item" value="To be generated" size="8" disabled="disabled" />
                <tr> <td> item description      </td> <td><input type="text"   name="desc" value="" size="30"  /> </td></tr>
                <tr> <td> current stock         </td> <td><input type="number" name="stock" value="0" size="30" /></td></tr>
                <tr> <td> minimum stock allowed </td> <td><input type="number" name="minStock" value="0" size="30" /></td></tr>
                <tr> <td> maximum stock         </td> <td><input type="number" name="maxStock" value="9999" size="30" /></td></tr>
                <tr> <td> warehouse </td> <td>   
                        <select name="warehouse"> 
                            <option value="west">Small items warehouse</option> 
                            <option value="east">Bulk warehouse</option> 
                            <option value="north">Temp controled</option> 
                            <option value="south">Secured</option> 
                        </select> 
                </tr> </td> 
                <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
        </table>

    </form>        

<button onclick="cansel()" >Cansel</button>

</body>
</html>

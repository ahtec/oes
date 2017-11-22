<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert Item</title>
        <script>
        function validate(form) {
            return true;
            fail = validateNaam(form.naam.value)
            fail = validateWW(form.ww.value)

            if (fail == "")
                return true
            else {
                alert(fail);
                return false
            }
        }

        function validateNaam(field)
        {
            var pattern = new RegExp(/[()~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
            if (pattern.test(field)) {
                return ("Gebruik alleen alpha en numerieke characters");
            }
            if (field == "") {
                return "Naam mag niet leeg zijn";
            }
            return "";
        }
        
        </script>
        
    </head>
    <body>

        <table><tr> <td>
                    <form name="insertItem" action="insertItem.php" onsubmit="return validate(this) method ="POST">
                         <!--<tr> <td> item description</td> <td><input type="text" name="item" value="" size="8" disabled="disabled" />-->
                          <tr> <td> item description</td> <td><input type="text" name="item" value="" size="8"  /> </td></tr>
                        <tr> <td> current stock</td> <td><input type="number" name="stock" value="" size="30" /></td></tr>
                        <tr> <td> minimum stock allowed</td> <td><input type="number" name="minStock" value="0" size="30" /></td></tr>
                        <tr> <td> maximum stock </td> <td><input type="number" name="maxStock" value="9999" size="30" /></td></tr>
                        <!--<tr> <td> warehouse</td> <td><input type="text" name="warehouse" value="" size="30" />-->

                            <tr> <td> warehouse </td> <td>   <select name="select"> 
                                    <option value="west">Small items warehouse</option> 
                                    <option value="east">Bulk warehouse</option> 
                                    <option value="north">Temp controled</option> 
                                    <option value="south">Secured</option> 
                                </select> </tr> </td> 



                            </td></tr>
                        <!--<tr> <td> hours to get this <br>item delivered to the <br>warehouse</td> <td><input type="text" name="delTime" value="10" size="30" /></td></tr>-->
                    <tr> <td>  <br><br>   <input type="submit" value="OK" id=screenButtons"></td></tr>
                    </form>        


                    <?php
                    // put your code here
                    ?>
                    </body>
                    </html>

function validateContent(field, subject)
{
    var pattern = new RegExp(/[()~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
    if (pattern.test(field)) {
        return ("\nUse only  alpha and numeric characters");
    }
    if (field == "") {
        return "\n" + subject + " can not be empty";
    }
    return "";
}

       
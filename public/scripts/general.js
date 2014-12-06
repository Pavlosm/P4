/**
 * Creates the required text boxes for the search
 */
function createNewTextBoxes() {

    var numOfPages = $( "#mySelect option:selected").text();
    var number = parseInt(numOfPages);

    if (number == 0) {
        document.getElementById("newForm").innerHTML = "";
        return;
    }

    var text = "<h3>Choose recipe ingredients</h3>";
    text += "(<i>if you do not want to specify any ingredients just leave the " +
            "text box empty and a random ingredient will be added)</i><br/>";

    for (i = 1; i <= number; i++) {
        text += "<div class=\"row\"><div class=\"col-md-2 form\">";
        text += "<label>Recipe " + i + ":</label></div><div class=\"col-md-10 form\">";
        text += "<input type=\"text\" name=\"ing" + i + "\" class=\"form-control\"";
        text += " placeholder=\"type comma separated ingredients to included in the recipe ingredients\">";
        text += "</div></div>"
    }
    text += "<div class=\"col-md-4\"></div>" +
    "<div class=\"col-md-4\">" +
    "<input type=\"submit\" class=\"btn btn-primary  btn-block\" value=\"Get those recipes\">" +
    "</div>";

    document.getElementById("newForm").innerHTML = text;

}
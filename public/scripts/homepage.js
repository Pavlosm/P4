function refreshRecipe(id)
{
    var xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var hidden_id = "hid" + id;
    var div_id = "div" + id;

    var div = document.getElementById(div_id).parentElement;

    var ingredients = document.getElementById(hidden_id).innerHTML;

    div.innerHTML = "loading ...";

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            div.innerHTML = xmlhttp.responseText;
        }
    }

    var query = "ajaxRefresh";

    if(ingredients.trim() != "") {
        query += "/" + ingredients;
    }

    xmlhttp.open("POST", query, true);
    xmlhttp.send();
}



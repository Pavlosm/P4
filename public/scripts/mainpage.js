function createXMLHttpRequest() {

    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }

}


function refreshRecipe(id)
{

    var xmlhttp = createXMLHttpRequest();

    var hidden_id = "hid" + id;
    var div_id = "div" + id;
    var div = document.getElementById(div_id).parentElement;

    var ingredients = document.getElementById(hidden_id).innerHTML;

    div.innerHTML = "loading ...";

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            div.innerHTML = xmlhttp.responseText;
        } else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "main/refresh/" + id;
    if(ingredients.trim() != "") {
        query += "/" + ingredients;
    }

    xmlhttp.open("POST", query, true);
    xmlhttp.send();
}


function saveRecipe(button) {

    var xmlhttp = createXMLHttpRequest();

    var div = button.parentElement;

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            div.innerHTML = xmlhttp.responseText;
        }
        else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "main/save/" + button.id.slice(2);
    xmlhttp.open("POST", query, true);
    xmlhttp.send();




}


function deleteRecipe(button_id) {

    var xmlhttp = createXMLHttpRequest();
    var id = "div" + button_id.slice(2);
    var div = document.getElementById(id).parentNode;

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            div.parentNode.removeChild(div);
        } else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "main/delete/" + button_id.slice(2);
    xmlhttp.open("POST", query, true);
    xmlhttp.send();
}




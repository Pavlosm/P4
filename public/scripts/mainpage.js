function refreshRecipe(id)
{
    var xmlhttp = createXMLHttpRequest();

    var container = document.getElementById('recipes-container');

    var hidden_id = "hid" + id;
    var div_id = "div" + id;
    var div = document.getElementById(div_id).parentElement;

    var ingredients = document.getElementById(hidden_id).innerHTML;

    alert( ingredients.trim() == "");

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


function actionToRecipe(button, id, value) {

    var xmlhttp = createXMLHttpRequest();
    var container = document.getElementById('recipes-container');

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var val = xmlhttp.responseText;
            button.innerHTML = val;
            button.id = val;
        }
        else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "main/refresh/" + id;
    if(ingredients.trim() != "")
    {
        query += "/" + ingredients;
    }
    xmlhttp.open("POST", query, true);
    xmlhttp.send();

}


function createXMLHttpRequest() {

    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }

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

function refreshRecipe(button_id) {

    var xmlhttp = createXMLHttpRequest();


    var hidden_id = "hid" + button_id;
    var div_id = "div" + button_id;
    var div = document.getElementById(div_id).parentElement;

    var ingredients = document.getElementById(hidden_id).innerHTML;

    div.innerHTML = "loading ...";

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            div.innerHTML = xmlhttp.responseText;
        }
        else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "main/refresh";

    if(ingredients.trim() != "") {
        query += "/" + ingredients;
    }

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




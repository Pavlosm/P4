

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
        else {
            div.innerHTML = xmlhttp.readyState + " || " + xmlhttp.status;
        }
    }

    var query = "ajaxRefresh";

    if(ingredients.trim() != "") {
        query += "/" + ingredients;
    }

    xmlhttp.open("POST", query, true);
    xmlhttp.send();
}


//function getNewForm()
//{
//    var xmlhttp;
//    if (window.XMLHttpRequest) {
//        xmlhttp=new XMLHttpRequest();
//    }
//    else {
//        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//    }
//    document.getElementById("newForm").innerHTML = "<i>Loading ...</i>";
//    xmlhttp.onreadystatechange = function()
//    {
//        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
//        {
//            document.getElementById("newForm").innerHTML = xmlhttp.responseText;
//        }
//    }
//    var numOfPages = "/ajax/" + $( "#mySelect option:selected" ).text();
//    xmlhttp.open("POST", numOfPages, true);
//    xmlhttp.send();
//}


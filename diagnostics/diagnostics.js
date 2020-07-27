var db_table = document.getElementById("db_table");
var table_dropdown = document.getElementById("tables");
var timer = null;
var current_show_table = null;

function setCrtShowTable(tableName){
    current_show_table = tableName;
}


function tableAutoUpdater(){
    ajaxGetDbTable();
    if (timer != null){
        clearInterval(timer);
    }
    timer = setInterval(ajaxGetDbTable, 1000);
}

function ajaxGetDbTable(){
    var xmlhttpShow = new XMLHttpRequest();
    xmlhttpShow.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){          
                updateTable(this.responseText);
        }
    }
    if (current_show_table != null){
        xmlhttpShow.open('GET', `getDbTable.php?q=${current_show_table}`, true);
        xmlhttpShow.send();
    }
}

function tableMaker(head_data, body_data){
    var i, j;

    //create table header
    var html_msg = "<thead>";
    html_msg += "<tr>";
    for(i of head_data){
        html_msg += ("<th scope=\"col\">" + i + "</th>");
    }
    html_msg += "</tr>";
    html_msg += "</thead>";

    //create table body
    html_msg += "<tbody>";
    for (i of body_data){
        html_msg += "<tr>";
        for(j of i){
            html_msg += ("<td>" + j + "</td>");
        }
        html_msg += "</tr>";
    }
    html_msg += "</tbody>";

    return html_msg;

}


function updateTable(result){
    var data = JSON.parse(result); 
    db_table.innerHTML = tableMaker(data['header'], data['body']);
}


function ajaxTableDropdown(callback){
    var xmlhttpShow = new XMLHttpRequest();
    xmlhttpShow.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if (typeof callback === 'function')
                callback(this.responseText);
        }
    }
    xmlhttpShow.open('GET', 'getTableName.php?q=null', true);
    xmlhttpShow.send();
}

function updateTableDropdown(result){
    var dropdown_msg = "<option value=\"null\"></option>";
    var item; 
    var array = JSON.parse(result);
    for(item of array){
        dropdown_msg += "<option value=" + "\'" + item + "\'" + ">" + item + "</option>";
    }
    table_dropdown.innerHTML = dropdown_msg;
}


document.addEventListener("DOMContentLoaded", function(){ajaxTableDropdown(updateTableDropdown)}, false);
table_dropdown.addEventListener("change", function(){setCrtShowTable(table_dropdown.value), tableAutoUpdater()}, false);

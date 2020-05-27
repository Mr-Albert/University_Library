<?php
//include auth.php file on all secure pages
include("app/controllers/auth.php");
if(!in_array("groups.php",$_SESSION['permissions'])){
header("Location: /UNIVERSITY_LIBRARY/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
function generateTableHead(table, data) {
  let thead = table.createTHead();
    thead.innerHTML="    <tr>\
      <th>Group Name</th>\
      <th>Description</th>\
      <th>Users</th>\
      <th>Permissions</th>\
    </tr>";

}

function remove_users_from_group(group_id,user_id)
{
    
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    //   if (this.readyState == 4 && this.status == 200) {
    //     // console.log(this.responseText);
    //     onLoad();
    //   }
    // };
    // xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/groups.php?srv_type=remove_user_from_group&user_id=" + user_id+"&group_id="+group_id, true);
    // xmlhttp.send();
}


function remove_permission_from_group(group_id,permission_id)
{
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    //   if (this.readyState == 4 && this.status == 200) {
    //     // console.log(this.responseText);
    //     onLoad();
    //   }
    // };
    // xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/groups.php?srv_type=remove_permission_from_group&permission_id=" + permission_id+"&group_id="+group_id, true);
    // xmlhttp.send();
}


function generateTable(table, data,functor) {
let tbody = table.createTBody();
  for (let element of data) {
      console.log(element[Object.keys(element)[0]]);
      var json_object=element[Object.keys(element)[0]];
      let row = tbody.insertRow();
      Object.keys(json_object).forEach(function(key) {

            let cell = row.insertCell();
            cell.setAttribute("scope","row");
            if (key=="users")
            {
                let users_panel="";
                for (let user of json_object[key]) {
                    users_panel+="<div style='display:inline-block;margin:0.25em' class='alert alert-success' role='alert'> \
                    <span style='cursor: pointer;position: absolute;top: 50%;right: 0%;padding: 2px 16px;transform: translate(0%, -50%);   width: 4px;\
                    ' class='close' onclick='remove_users_from_group("+Object.keys(element)[0]+","+user["user_id"]+")'>x</span>"+user["user_name"]+"</div>"

                }

                cell.innerHTML=users_panel;
            }
            else if (key=="permissions")
            {
                let permission_panel="";
                for (let permission of json_object[key]) {
                    permission_panel+="<div style='display:inline-block;margin:0.25em' class='alert alert-success' role='alert'>\
                    <span style='cursor: pointer;position: absolute;top: 50%;right: 0%;padding: 2px 16px;transform: translate(0%, -50%);   width: 4px;\
                    ' class='close' onclick='remove_permission_from_group("+Object.keys(element)[0]+","+permission["permission_id"]+")'>x</span>"+permission["permission_name"]+"</div>"
                }

                cell.innerHTML=permission_panel;
            }
            else{
                let text = document.createTextNode(json_object[key]);
                cell.appendChild(text);
            }
         })

    // let row = tbody.insertRow();
    // for (var key in element) {
    //   let cell = row.insertCell();
    //   cell.setAttribute("scope","row");
    //   let text = document.createTextNode(element[key]);
    //   cell.appendChild(text);
    // }
    // let extra_elements=functor(element);
    // extra_elements.forEach(element => {
    //     let cell = row.insertCell();
    //     cell.setAttribute("scope","row");
    //     cell.innerHTML=element;
    // });
  }
}

let table = document.querySelector("table");
//this is afunction that should generate buttons, it is still not complete
function functional_cell(element)
{
	let borrow_button="<div><button id='remove_user"+element["id"]+"' onclick='remove_user("+element["id"]+")'>Delete User</button></div>";
    return [borrow_button];
	
}

function remove_user(ID)
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);
        onLoad();
      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/users.php?srv_type=delete_user&user_id=" + ID, true);
    xmlhttp.send();
    
}


function onLoad()
{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(caller) {
       if (this.readyState == 4 && this.status == 200 &&this.responseText!=[]) {
           let json_data = JSON.parse(this.responseText);
           console.log(json_data);
           let table =document.getElementById("books_table");
           table.innerHTML="";
           generateTableHead(table,json_data);
           generateTable(table,json_data,functional_cell);

      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/groups.php?srv_type=get_groups", true);
    xmlhttp.send();
    
}

</script>


</head>
<body onload="onLoad()">
<?php require('public/views/top_navigation.php'); ?>
 

<div class="table-responsive">
<table id="books_table" class="table table-hover table-dark">
</table>
</div>

</body>
</html> 

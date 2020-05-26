<?php
//include auth.php file on all secure pages
include("app/controllers/auth.php");
if(!in_array("permissions.php",$_SESSION['permissions'])){
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
  let row = thead.insertRow();
//   console.log(data[0]);
  Object.keys(data[0]).forEach(function(key) {
    let th = document.createElement("th");
    th.setAttribute("scope","col");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
  });
}

function generateTable(table, data,functor) {
let tbody = table.createTBody();
  for (let element of data) {
    let row = tbody.insertRow();
    for (var key in element) {
      let cell = row.insertCell();
      cell.setAttribute("scope","row");
      let text = document.createTextNode(element[key]);
      cell.appendChild(text);
    }
    let extra_elements=functor(element);
    extra_elements.forEach(element => {
        let cell = row.insertCell();
        cell.setAttribute("scope","row");
        cell.innerHTML=element;
    });
  }
}

//this is afunction that should generate buttons, it is still not complete
function functional_cell(element)
{
	let remove_permission_button="<div><button class='btn btn-danger' id='delete_permission_"+element["id"]+"' onclick='remove_permission("+element["id"]+")'>Delete Permission</button></div>";
	// let submit_permission_button="<div><button id='submit_permission_"+element["id"]+"' onclick='submit_permission("+element["id"]+")'>Delete Permission</button></div>";
    return [remove_permission_button];
	
}

function remove_permission(ID)
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);
        document.getElementById("add_new_permission_button").remove();
        onLoad();
      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/permissions.php?srv_type=delete_permissions&permission_id=" + ID, true);
    xmlhttp.send();
    
}

function submit_new_permission()
{
  let permission_name = document.getElementById("permission_name").value ;
  let permission_description = document.getElementById("permission_description").value ;
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("add_new_permission_button").remove();
        onLoad();
      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/permissions.php?srv_type=add_permissions&permission_name=" + permission_name+"&permission_description="+permission_description, true);
    xmlhttp.send();
}


function add_new_permission (table)
{
  // console.log(caller);
  document.getElementById("add_new_permission_button").disabled = true;
  let trow = table.tBodies[0].insertRow();
  let cell = trow.insertCell();
  cell.setAttribute("scope","row");
  cell.innerHTML="";

  cell = trow.insertCell();
  cell.setAttribute("scope","row");
  cell.innerHTML="<input id='permission_name'/>";

  cell = trow.insertCell();
  cell.setAttribute("scope","row");
  cell.innerHTML="<input id='permission_description'/>";

  cell = trow.insertCell();
  cell.setAttribute("scope","row");
  console.log(document.getElementById("permission_name").value);
  cell.innerHTML="<button id='submit_new_permission' class='btn btn-primary' onclick=submit_new_permission()>Submit</button>";
  console.log(trow);

}


function onLoad()
{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(caller) {
       if (this.readyState == 4 && this.status == 200 &&this.responseText!=[]) {
           let json_data = JSON.parse(this.responseText);
           console.log(json_data);
           let table =document.getElementById("permissions_table");
           table.innerHTML="";
           generateTableHead(table,json_data);
           generateTable(table,json_data,functional_cell);
           var add_new_permission_element = document.createElement('button');
           add_new_permission_element.innerHTML="Add permission";
           add_new_permission_element.classList.add("btn");
           add_new_permission_element.classList.add("btn-primary");
           add_new_permission_element.id ="add_new_permission_button"; 
           add_new_permission_element.onclick =function() { add_new_permission(table); }; 
          table.after(add_new_permission_element);

      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/permissions.php?srv_type=get_permissions", true);
    xmlhttp.send();
    
}

</script>


</head>
<body onload="onLoad()">
<?php require('public/views/top_navigation.php'); ?>
<?php require('public/views/side_navigation.php'); ?>


<div class="table-responsive">
<table id="permissions_table" class="table table-hover">
</table>
</div>

</body>
</html> 

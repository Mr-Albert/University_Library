<?php
//include auth.php file on all secure pages
include("app/controllers/auth.php");
if(!in_array("users.php",$_SESSION['permissions'])){
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

let table = document.querySelector("table");
//this is afunction that should generate buttons, it is still not complete
function functional_cell(element)
{
	let borrow_button="<div><button class= 'btn btn-danger' id='remove_user"+element["id"]+"' onclick='remove_user("+element["id"]+")'>Delete User</button></div>";
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
           let table =document.getElementById("users_table");
           table.innerHTML="";
           generateTableHead(table,json_data);
           generateTable(table,json_data,functional_cell);

      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/users.php?srv_type=get_users", true);
    xmlhttp.send();
    
}

</script>


</head>
<body onload="onLoad()">
<?php require('public/views/top_navigation.php'); ?>
 

<div class="table-responsive">
<table id="users_table" class="table table-hover table-dark">
</table>
</div>

</body>
</html> 

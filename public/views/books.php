<?php
//include auth.php file on all secure pages
include("app/controllers/auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
    
function generateTableHead(table, data) {
  let thead = table.createTHead();
  let row = thead.insertRow();
  for (let key of data) {
    let th = document.createElement("th");
    th.setAttribute("scope","col");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
  }
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
    let elems=functor("2");
    console.log(elems);
  }
}

let table = document.querySelector("table");
let data = Object.keys(books[0]);

//this is afunction that should generate buttons, it is still not complete
function functional_cell(ID)
{
	let first_button="<button id='delete_user_"+ID+"' onclick='delete_user("+ID+")''>";
	let second_button="<select multipleselect id='change_groups_"+ID+"' onchange='changeGroups("+ID+")''>";
  return [first_button,second_button];
	
}

function onLoad()
{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(responseText);
      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/books.php?srv_type=get_books", true);
    xmlhttp.send();
    
}

</script>


</head>
<body onload="onLoad()">
<?php require('public/views/top_navigation.php'); ?>
<?php require('public/views/side_navigation.php'); ?>


<div class="table-responsive">
<table id="books_table" class="table table-hover">
</table>
</div>

</body>
</html> 

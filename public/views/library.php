<?php
//include auth.php file on all secure pages
include("app/controllers/auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
    
function searchbooks()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(caller) {
       if (this.readyState == 4 && this.status == 200 &&this.responseText!=[]) {
           let json_data = JSON.parse(this.responseText);
           let table =document.getElementById("books_table");
           table.innerHTML="";
           generateTableHead(table,json_data);
           generateTable(table,json_data,functional_cell);

      }
    };
    var search_condition="isbn="+document.getElementById("input_isbn").value+"&publication_year="+document.getElementById("input_publication_year").value;
    search_condition+="&author="+document.getElementById("input_author").value+"&name="+document.getElementById("input_name").value+"&description="+document.getElementById("input_description").value;
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/books.php?srv_type=unborrowed_books&"+search_condition, true);
    xmlhttp.send();
}


function generateTableHead(table, data) {
  let thead = table.createTHead();
  let row = thead.insertRow();
  let static_header=["id"	,"ISBN",	"publication_year"	,"author",	"name"	,"description"	,"available_copies"];
  for (let element of static_header)
  {
    let th = document.createElement("th");
    th.setAttribute("scope","col");
    let text = document.createTextNode(element);
    th.appendChild(text);
    row.appendChild(th);
  };

  let static_header_elements=[""	,"<input id='input_isbn'/>",	"<input id='input_publication_year'/>"	,"<input id='input_author'/>",	"<input id='input_name'/>"	,"<input id='input_description'/>"	,"","<button onclick='searchbooks()' class='btn btn-primary fa fa-search' aria-hidden='true'>'</button>"];
  let anotherRow = thead.insertRow();
  for (let element of static_header_elements)
  {
    let th = document.createElement("th");
    th.setAttribute("scope","col");
    th.innerHTML=element;
    anotherRow.appendChild(th);
  };

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
    let elems=functor(element["id"]);
    let cell = row.insertCell();
      cell.setAttribute("scope","row");
      cell.innerHTML=elems[0];
    console.log(elems);
  }
}

let table = document.querySelector("table");
//this is afunction that should generate buttons, it is still not complete
function functional_cell(ID)
{
	let first_button="<div><button class='btn btn-warning' id='borrow_book"+ID+"' onclick='confirm_borrow("+ID+")'>borrow</button></div>";
      return [first_button];
	
}


function confirm_borrow(ID)
{
    //let's first open a pop asking for a borrow period
  $("#borrow_period").modal('show');
  $("#confirm_borrow_button").click(function () {
    borrow_book(ID,$("#borrow_days").val()?$("#borrow_days").val():1);
    $("#borrow_period").modal('hide');

  });
}



function borrow_book(ID,period)
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        onLoad();
      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/books.php?srv_type=borrow_book&book_id=" + ID+"&borrow_period="+period, true);
    xmlhttp.send();
    
}
function onLoad()
{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(caller) {
       if (this.readyState == 4 && this.status == 200 &&this.responseText!=[]) {
           let json_data = JSON.parse(this.responseText);
           let table =document.getElementById("books_table");
           table.innerHTML="";
           generateTableHead(table,json_data);
           generateTable(table,json_data,functional_cell);

      }
    };
    xmlhttp.open("GET", "/UNIVERSITY_LIBRARY/app/controllers/books.php?srv_type=unborrowed_books", true);
    xmlhttp.send();
    
}

</script>


</head>
<body onload="onLoad()">
<?php require('public/views/top_navigation.php'); ?>
 

<div class="table-responsive">
<table id="books_table" class="table table-hover table-dark">
</table>
<!-- adding boostrap modal HTML, this is hidden by default -->
  <!-- Modal -->
  <div id="borrow_period" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Borrow period</h4>
        </div>
        <div class="modal-body">
          <label for="borrow_days">Number of days:</label>
          <input type="number" id="borrow_days" name="borrow_days"  value ="1" min="1" >
        </div>
        <div class="modal-footer">
        <button id="confirm_borrow_button" type="button" class="btn btn-primary" >Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html> 

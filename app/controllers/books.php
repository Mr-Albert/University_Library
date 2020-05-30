<?php 
//security
include("app/controllers/auth.php");
require('database/db.php');


 switch ($_GET["srv_type"])
 {
    case "borrowed_books":
        $query = "SELECT *
        FROM books
        inner JOIN (select * from users_borrow_books where users_borrow_books.user_id=".$_SESSION["userID"].") as own_books
        ON books.id = own_books.book_id;";
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    break;
    case "unborrowed_books":
        $where_condition="";
        if (isset($_GET["isbn"]) &&!empty($_GET["isbn"]))
            $where_condition .=" AND ISBN like '%".$_GET["isbn"]."%'";
        if (isset($_GET["publication_year"]) &&!empty($_GET["publication_year"]))
            $where_condition .=" AND publication_year like '%".$_GET["publication_year"]."%'";    
        if (isset($_GET["author"]) &&!empty($_GET["author"]))
            $where_condition .=" AND author like '%".$_GET["author"]."%'";
        if (isset($_GET["name"]) &&!empty($_GET["name"]))
            $where_condition .=" AND name like '%".$_GET["name"]."%'";    
        if (isset($_GET["description"]) &&!empty($_GET["description"]))
            $where_condition .=" AND description like '%".$_GET["description"]."%'"; 
        $query = "select * from books where id not in(
            select book_id from users_borrow_books where user_id=". $_SESSION["userID"]."
            )".$where_condition;
        // echo $query;
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    break;
    case "borrow_book":
        $query = "insert into users_borrow_books (user_id,book_id,borrow_period) values (".$_SESSION["userID"].",".$_GET["book_id"].",".$_GET["borrow_period"].");
        update books set available_copies = (select available_copies from books where id=".$_GET["book_id"].")-1 where id=".$_GET["book_id"];
        echo $query;
        try {
            $q_ptr = $conn->exec($query);
            echo "SUCCESS";
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
    break;
    case "return_book":
        $query = "delete from users_borrow_books where book_id =".$_GET["book_id"]." and user_id=".$_SESSION["userID"].";
        update books set available_copies = (select available_copies from books where id=".$_GET["book_id"].")+1 where id=".$_GET["book_id"];
        echo $query;
        try {
            $q_ptr = $conn->exec($query);
            echo "SUCCESS";
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
    break;
    case "extend_borrow":

        $query = "update users_borrow_books SET borrow_period = borrow_period+".$_GET["extend_period"]." where book_id=".$_GET["book_id"]." and user_id=".$_SESSION["userID"];
        try {
            $q_ptr = $conn->exec($query);
            echo "SUCCESS";
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
    break;
 }


?>
<?php 

//security
include("app/controllers/auth.php");
if(!in_array("expired_borrows.php",$_SESSION['permissions'])){
    echo "not authorized";
    return ;
    exit();
}
require('database/db.php');
 switch ($_GET["srv_type"])
 {
    case "get_users":
        $query = "  select user_id,user_name,email,ISBN,name,borrow_date,borrow_period,expiry_period from
        (SELECT   *, TIMESTAMPDIFF (day,DATE_ADD(borrow_date,interval borrow_period day),CURRENT_TIMESTAMP() ) as expiry_period FROM `users_borrow_books`
        WHERE  TIMESTAMPDIFF (second,CURRENT_TIMESTAMP(),DATE_ADD(borrow_date,interval borrow_period day) )<=0) expired_period_table
        left join books on book_id=books.id
        left join users on user_id=users.id";
        try {
            $q_ptr = $conn->query($query);
            $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($rows);
    
        }
        catch (PDOException $e)
        {
            return "Wrong input";
        }    break;
 }


?>
<?php


//returns array of users who have books borrow period that expired, 
//each index is a user and inside each users is the user name and email,
//and an array of books that has details of all books that expired that was borrowed by this user
function get_expired_borrows()
{
//     $dsn = "mysql:host=localhost;dbname=university_library";
// $user = "root";
// $passwd = "";
// $conn="";
try {
  $conn = new PDO($dsn, $user, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  echo "Failed to connect to DB";
}
    $query = "  select * from
    (SELECT   *, TIMESTAMPDIFF (day,DATE_ADD(borrow_date,interval borrow_period day),CURRENT_TIMESTAMP() ) as expiry_period FROM `users_borrow_books`
    WHERE  TIMESTAMPDIFF (second,CURRENT_TIMESTAMP(),DATE_ADD(borrow_date,interval borrow_period day) )<=0) expired_period_table
    left join books on book_id=books.id
    left join users on user_id=users.id";
    try {
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll();
        $associated_rows=array();
        $found_users=array();
        foreach($rows as $key=>$value)
        {
            if (!isset( $associated_rows[$value["user_id"]]))
                $associated_rows[$value["user_id"]]=array("user_name"=>$value["user_name"],"email"=>$value["email"],"books"=>array());
            $associated_rows[$value["user_id"]]["books"][]=array("book_id"=>$value["book_id"],"book_id"=>$value["book_id"]
            ,"ISBN"=>$value["ISBN"],"boook_name"=>$value["name"],"borrow_date"=>$value["borrow_date"],"borrow_period"=>$value["borrow_period"],"expiry_period"=>$value["expiry_period"]);

        }
        return $associated_rows;

    }
    catch (PDOException $e)
    {
        return "Wrong password";
    }
}

//test
print_r (get_expired_borrows());

?>
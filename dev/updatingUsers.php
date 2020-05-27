<?php


//return true on success and error message otherwise
function update_user_password($user_id,$old_pasword,$new_password)
{
//this commented block is just for testing please include this function in the appropriate page
//     $dsn = "mysql:host=localhost;dbname=university_library";
// $user = "root";
// $passwd = "";
// $conn="";
// try {
//   $conn = new PDO($dsn, $user, $passwd);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(Exception $e) {
//   echo "Failed to connect to DB";
// }
    $query = "select count(1) from users where id=".$user_id." and password=md5(".$old_pasword.");";
    try {
        $q_ptr = $conn->query($query);
        $count= $q_ptr->fetchAll()[0][0];
        if($count==1)
        {
            $query = "update users set password=md5(".$new_password.") where id=".$user_id.";";
            try{
                $q_ptr = $conn->query($query);
                return "success";

            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }
        else
            return "Wrong password";
    }
    catch (PDOException $e)
    {
        return "Wrong password";
    }
}
    echo update_user_password(10,1234567899,123456789);
    //update books set available_copies = (select available_copies from books where id=".$_GET["book_id"].")-1 where id=".$_GET["book_id"];

?>
<?php 

//security
include("app/controllers/auth.php");
if(!in_array("users.php",$_SESSION['permissions'])){
    echo "not authorized";
    return ;
    exit();
}
require('database/db.php');

 switch ($_GET["srv_type"])
 {
    case "get_users":
        $query = "SELECT user_name,first_name,last_name,created_at,last_login,email FROM `users` WHERE approved=1";
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    break;
    case "delete_user":
        $query = "DELETE FROM users WHERE id=".$_GET["user_id"];
        $q_ptr = $conn->query($query);
        echo "delete user: ".$_GET["user_id"];
    break;
    case "change_groups":
        $new_groups="";
        foreach($_GET["groups"] as $group)
        {
            $newgroups.="(".$_GET["user_id"].",".$group,"),";
        }
        trim($new_groups,",");
        $query = "delete from user_groups where user_id=".$_GET["user_id"];
        $q_ptr = $conn->query($query);
        $query = "insert into user_groups (user_id,group_id) VALUES ".$newgroups;
        $q_ptr = $conn->query($query);
        echo "change groups: ".$_GET["user_id"];
    break;
    case "approve_user":
        $query = "update users set approved=1 WHERE id=".$_GET["user_id"];
        $q_ptr = $conn->query($query);
        echo "approve user: ".$_GET["user_id"];
    break;
 }


?>
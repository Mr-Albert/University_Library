<?php 

//security
include("app/controllers/auth.php");
if(!in_array("groups.php",$_SESSION['permissions'])){
    echo "not authorized";
    return ;
    exit();
}
require('database/db.php');

 switch ($_GET["srv_type"])
 {
    case "get_groups":
        $query = "SELECT groups.id as group_id,groups.group_name, groups.description,users.id as user_id,users.user_name,permissions.id as permission_id,permissions.permission_name FROM groups
        LEFT JOIN users_groups ON users_groups.group_id = groups.id
        LEFT JOIN users ON users.id = users_groups.user_id
        LEFT JOIN groups_permissions on  groups_permissions.group_id=users_groups.group_id
        LEFT JOIN permissions on  permissions.id=groups_permissions.permission_id";
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
        $associated_rows=array();
        $found_users=array();
        $found_permissions=array();
        foreach($rows as $key=>$value)
        {
            if (!isset( $associated_rows[$value["group_id"]]))
                $associated_rows[$value["group_id"]]=array("group_name"=>$value["group_name"],"description"=>$value["description"],"users"=>array(),"permissions"=>array());
            
            if(!in_array($value["user_id"], $found_users) ){
                $associated_rows[$value["group_id"]]["users"][]=array("user_id"=>$value["user_id"],"user_name"=>$value["user_name"]);
                $found_users[]=$value["user_id"];
            }

            if(!in_array($value["permission_id"], $found_permissions) ){
                $associated_rows[$value["group_id"]]["permissions"][]=array("permission_id"=>$value["permission_id"],"permission_name"=>$value["permission_name"]);
                $found_permissions[]=$value["permission_id"];
            }
        }
        echo json_encode(array($associated_rows));

    break;
    case "remove_user_from_group":
        $query = "delete from users_groups where user_id=".$_GET["user_id"]." AND group_id=".$_GET["group_id"];
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



    // case "remove_group":
    //     $query = "SELECT user_name,first_name,last_name,created_at,last_login,email FROM `users` WHERE approved=1";
    //     $q_ptr = $conn->query($query);
    //     $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
    //     echo json_encode($rows);
    // break;
    // case "delete_user":
    //     $query = "DELETE FROM users WHERE id=".$_GET["user_id"];
    //     $q_ptr = $conn->query($query);
    //     echo "delete user: ".$_GET["user_id"];
    // break;
    // case "change_groups":
    //     $new_groups="";
    //     foreach($_GET["groups"] as $group)
    //     {
    //         $newgroups.="(".$_GET["user_id"].",".$group,"),";
    //     }
    //     trim($new_groups,",");
    //     $query = "delete from user_groups where user_id=".$_GET["user_id"];
    //     $q_ptr = $conn->query($query);
    //     $query = "insert into user_groups (user_id,group_id) VALUES ".$newgroups;
    //     $q_ptr = $conn->query($query);
    //     echo "change groups: ".$_GET["user_id"];
    // break;
    // case "approve_user":
    //     $query = "update users set approved=1 WHERE id=".$_GET["user_id"];
    //     $q_ptr = $conn->query($query);
    //     echo "approve user: ".$_GET["user_id"];
    // break;
 }


?>
<?php 

//security
include("app/controllers/auth.php");
if(!in_array("permissions.php",$_SESSION['permissions'])){
    echo "not authorized";
    return ;
    exit();
}
require('database/db.php');

 switch ($_GET["srv_type"])
 {
    case "get_permissions":
        $query = "SELECT * FROM `permissions`";
        $q_ptr = $conn->query($query);
        $rows= $q_ptr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    break;
    case "delete_permissions":
        $query = "DELETE FROM permissions WHERE id=".$_GET["permission_id"];
        $q_ptr = $conn->query($query);
        echo "delete permission: ".$_GET["permissions_id"];
    break;
    case "add_permissions":
        $query = "insert into permissions (permission_name,description) values ('".$_GET["permission_name"]."','".$_GET["permission_description"]."')";
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
 }


?>
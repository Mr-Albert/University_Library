<?php

    $dsn = "mysql:host=localhost;dbname=university_library";
    $user = "root";
    $passwd = "";
    $conn="";
try {
  $conn = new PDO($dsn, $user, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  echo "Failed to connect to DB";
}
  $conn = new PDO($dsn, $user, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insertQuery = "insert into groups (group_name,description) VALUES('user','People with normal users previleges') ";
    try {
        $q_ptr = $conn->query($insertQuery);
        $every_one_is_a_user_query="insert into users_groups (user_id,group_id) (select t1.id as user_id,groups.id as group_id from
        (select * from users where id not in (select user_id from users_groups)) t1
        join groups where groups.group_name='user')";
        $q_ptr = $conn->query($every_one_is_a_user_query);

    }
    catch (PDOException $e)
    {
        return "Wrong password";
    }


?>
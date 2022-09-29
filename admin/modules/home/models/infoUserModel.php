<?php
    function get_role()
    {
        // $result=db_fetch_row("select * from users INNER JOIN roles ON users.role_id=roles.id");
        $result=db_fetch_array("select * from roles");
        return $result;
    }

    function userInfo($where)
    {
        // $result=db_fetch_row("select * from users INNER JOIN roles ON users.role_id=roles.id");
        $result=db_fetch_row("select * from users where id=$where");
        return $result;
    }

    function checkUnique($field)
    {
        // $result=db_fetch_row("select * from users INNER JOIN roles ON users.role_id=roles.id");
        $result=db_fetch_row("select * from users where email='$field'");
        if($result!=0)
            return false;
        return true;
    }
    
    function get_list_users($start,$num_per_page,$trash,$search="")
    {
         $result=db_fetch_array("select users.id,`email`,`name`,`password`,`rolename`,`date_creating` from users INNER JOIN roles ON users.role_id=roles.id WHERE `trash`='$trash'&&`email` like '%$search%' limit $start,$num_per_page");
         return $result;
    }

    function get_num_row($trash)
    {
        $result=db_num_rows("select * from users where trash='$trash'");
        return $result;
    }

    function get_user_by_id($id)
    {
        $result=db_fetch_row("select * from users where id='$id'");
        return $result;
    }
?>
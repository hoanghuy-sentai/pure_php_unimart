<?php
    function get_pages($start,$num_page,$trash,$search="",$where="&&status like '%'")
    {
        $result=db_fetch_array("SELECT pages.id,`page_name`,`content`,`page_date`,users.name,`status`,`creating_time` FROM `pages` INNER JOIN users ON pages.user_id=users.id where pages.trash='$trash'&&`page_name` like '%$search%'$where limit $start,$num_page");
        return $result;
    }

    function get_num_row($trash,$where="&&status like '%'")
    {
        $result=db_num_rows("select * from pages where trash='$trash'$where");
        return $result;
    }

    function get_page_by_id($id)
    {
        $result=db_fetch_row("select * from pages where id='$id'");
        return $result;
    }
?>
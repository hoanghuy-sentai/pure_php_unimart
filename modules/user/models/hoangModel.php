<?php
    // echo "This is Hoang Model";
    function get_list_user($num_per_page,$num_page)
    {
        $result=db_fetch_array("SELECT * FROM `tbl_users` LIMIT $num_per_page,$num_page");
        return $result;
    }
    function get_total_tbl_users()
    {
        $result=db_num_rows("SELECT * FROM `tbl_users`");
        return $result;
    }
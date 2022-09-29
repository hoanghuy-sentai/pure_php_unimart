<?php
    function get_page_by_id($id)
    {
        $result=db_fetch_row("select * from pages where id='$id'");
        return $result;
    }
?>
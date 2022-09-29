<?php

function get_list_imgs($start,$num_page,$search="")
{
    $result=db_fetch_array("SELECT medias.id,thumb_name,`time`,users.name FROM `medias` INNER JOIN users on medias.user_id=users.id WHERE `thumb_name` like '%$search%'  LIMIT $start,$num_page");
    return $result;
}

function get_num_row()
{
    $result=db_num_rows("select * from medias");
    return $result;
}

function get_thumb_name($id)
{
    $result=db_fetch_array("SELECT thumb_name FROM `medias` INNER JOIN users on medias.user_id=users.id where medias.id=$id");
    return $result;
}

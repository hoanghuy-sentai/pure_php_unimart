<?php
    function get_list_slider($start,$num_page,$trash=0,$search="",$where="&&sliders.slider_status like '%'")
    {
        $result=db_fetch_array("SELECT sliders.id,sliders.slider_name,medias.thumb_name,sliders.slider_slug,sliders.slider_desc,sliders.slider_num_order,sliders.slider_status,sliders.slider_time,users.name FROM `sliders` INNER JOIN users on sliders.user_id=users.id INNER JOIN medias ON sliders.thumb_id=medias.id where sliders.trash='$trash'&&slider_name like '%$search%'$where LIMIT $start,$num_page");
        return $result;
    }
    function check_unique_num_order($subject)
    {
        $query_tr=db_num_rows("SELECT * FROM `sliders` WHERE `slider_num_order`='$subject'");
        
        if($query_tr>0)
        {
            return false;
        }
        return true;
       
    }

    function get_num_row()
    {
        $result=db_num_rows("select * from sliders");
        return $result;
    }

    function show_num_row($where)
    {
        $result=db_num_rows("select * from sliders where $where ");
        return $result;
    }

    function get_name_img($id)
    {
        $result=db_fetch_row("SELECT medias.thumb_name FROM `sliders` INNER JOIN users on sliders.user_id=users.id INNER JOIN medias ON sliders.thumb_id=medias.id where sliders.id='$id'");
        return $result;
    }

    function get_slider_by_id($id)
    {
        $result=db_fetch_row("SELECT sliders.id,sliders.slider_name,sliders.slider_slug,sliders.slider_desc,sliders.slider_num_order,sliders.thumb_id,sliders.slider_status,sliders.slider_time,sliders.user_id,sliders.trash,medias.thumb_name FROM `sliders` INNER JOIN users on sliders.user_id=users.id INNER JOIN medias ON sliders.thumb_id=medias.id where sliders.id='$id'");
        return $result;
    }

    function get_media_id($id)
    {
        $result=db_fetch_row("SELECT medias.id FROM `sliders` INNER JOIN users on sliders.user_id=users.id INNER JOIN medias ON sliders.thumb_id=medias.id where sliders.id='$id'");
        return $result;
    }
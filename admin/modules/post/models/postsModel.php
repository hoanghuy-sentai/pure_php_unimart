<?php 

    function get_list_post($start,$num_page,$trash=0,$search="",$where="&&posts.status like '%'")
    {
        $result=db_fetch_array("SELECT posts.id,medias.thumb_name,post_date,post_title,post_desc,slug,post_creating,post_cat.cat_name,posts.status,posts.trash,users.name FROM `posts` INNER JOIN medias on posts.thumb_id=medias.id INNER JOIN post_cat ON posts.cat_id=post_cat.id INNER JOIN users on posts.user_id=users.id where posts.trash='$trash'&&post_title like '%$search%'$where LIMIT $start,$num_page");
        return $result;
    }

    function get_num_row()
    {
        $result=db_num_rows("select * from posts");
        return $result;
    }

    function show_num_row($where)
    {
        $result=db_num_rows("select * from posts where $where ");
        return $result;
    }
  
    function get_name_img($id)
    {
        $result=db_fetch_row("select medias.thumb_name FROM `posts` INNER JOIN medias on posts.thumb_id=medias.id INNER JOIN post_cat ON posts.cat_id=post_cat.id INNER JOIN users on posts.user_id=users.id  where posts.id='$id'");
        return $result;
    }

    function get_post_by_id($id)
    {
        $result=db_fetch_row("SELECT posts.id,posts.cat_id,medias.thumb_name,post_date,post_title,post_desc,slug,post_creating,post_cat.cat_name,posts.status,posts.trash,users.name FROM `posts` INNER JOIN medias on posts.thumb_id=medias.id INNER JOIN post_cat ON posts.cat_id=post_cat.id INNER JOIN users on posts.user_id=users.id where posts.id='$id'");
        return $result;
    }
    
    function get_idOfMedia($id)
    {
        $result=db_fetch_row("SELECT medias.id FROM `posts` INNER JOIN medias on posts.thumb_id=medias.id INNER JOIN post_cat ON posts.cat_id=post_cat.id INNER JOIN users on posts.user_id=users.id where posts.id='$id'");
        return $result;
    }

    function get_list_postscat_notLimit($trash,$search="")
    {
        $result=db_fetch_array("select * from post_cat  WHERE `trash`='$trash'&&`cat_name` like '%$search%'");
        return $result;
    }

?>
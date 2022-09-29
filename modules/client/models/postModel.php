<?php 
    function get_list_post($start,$num_page,$search="",$where="&&id IN(3,4)")
    {
        $result=db_fetch_array("SELECT posts.id,medias.thumb_name,posts.post_title,posts.post_creating,posts.post_desc,posts.cat_id,posts.status,post_cat.cat_name ,post_cat.parent_id FROM `posts` INNER JOIN medias ON medias.id=posts.thumb_id INNER JOIN post_cat ON post_cat.id=posts.cat_id  where posts.status='active'&&post_title like '%$search%'$where LIMIT $start,$num_page");
        return $result;
    }

    function get_list_posts_one_postCat_show_one_record($start,$num_page,$search="",$where=null)
    {
        $result=db_fetch_array("SELECT posts.id,medias.thumb_name,posts.post_title,posts.post_creating,posts.post_desc,posts.cat_id,posts.status,post_cat.cat_name,post_cat.parent_id FROM `posts` INNER JOIN medias ON medias.id=posts.thumb_id INNER JOIN post_cat ON post_cat.id=posts.cat_id WHERE posts.status='active'&&post_title like '%$search%'$where  GROUP BY `cat_id` LIMIT $start,$num_page");
        return $result;
    }
    
    function get_num_row($where)
    {
        $result=db_num_rows("select * from posts WHERE $where");
        return $result;
    }

    function get_num_row2($where=null)
    {
        $result=db_num_rows("select * from posts $where");
        return $result;
    }


    function get_list_posts()
    {
        $result=db_fetch_array("SELECT posts.id,medias.thumb_name,posts.post_title,posts.post_creating,posts.post_desc,posts.cat_id,posts.status,post_cat.cat_name,post_cat.parent_id FROM `posts` INNER JOIN medias ON medias.id=posts.thumb_id INNER JOIN post_cat ON post_cat.id=posts.cat_id WHERE posts.status='active'");
        return $result;
    }

    function get_post_detail($id)
    {
        $result=db_fetch_row("SELECT posts.id,medias.thumb_name,posts.post_title,posts.post_creating,posts.post_desc,posts.cat_id,posts.status,post_cat.cat_name,post_cat.parent_id FROM `posts` INNER JOIN medias ON medias.id=posts.thumb_id INNER JOIN post_cat ON post_cat.id=posts.cat_id WHERE posts.status='active'&&posts.id=$id");
        return $result;
    }

?>
<?php
    function get_list_products($start,$num_per_page,$trash,$search="",$where="&&products.product_status like '%'")
    {
        $result=db_fetch_array("SELECT products.id,products.product_name,medias.thumb_name,products.product_code,products.product_price,product_cats.cat_name,products.product_status,products.time,users.name FROM `products` INNER JOIN medias ON products.thumb_id=medias.id INNER JOIN users ON products.user_id=users.id INNER JOIN product_cats ON product_cats.id=products.product_cat  WHERE products.`trash`='$trash'&&`product_name` like '%$search%'$where limit $start,$num_per_page");
        return $result;
    }

     function get_list_products_cat_notLimit($trash,$search="")
     {
         $result=db_fetch_array("select * from product_cats  WHERE `trash`='$trash'&&`cat_name` like '%$search%'");
         return $result;
     }

     function check_product_code($where)
     {
        $query_str=db_fetch_row("select * from products where product_code='$where'");
        if($query_str>0)
        {
            return false;
        }
        return true;
     }

     function get_num_row($trash)
     {
          $result=db_num_rows("select * from products where trash='$trash'");
          return $result;
     }

    function show_num_row($where)
    {
        $result=db_num_rows("select * from products where $where ");
        return $result;
    }

    function get_name_img($id)
    {
        $result=db_fetch_row("SELECT medias.thumb_name FROM `products` INNER JOIN medias ON products.thumb_id=medias.id INNER JOIN users ON products.user_id=users.id INNER JOIN product_cats ON product_cats.id=products.product_cat where products.id='$id'");
        return $result;
    }

    function get_product_by_id($id)
    {
        $result=db_fetch_row("SELECT products.id,products.product_qty,products.product_short_desc,products.product_detail_desc,products.product_cat,products.product_name,medias.thumb_name,products.product_code,products.product_price,product_cats.cat_name,products.product_status,products.time,users.name,products.productFeature FROM `products` INNER JOIN medias ON products.thumb_id=medias.id INNER JOIN users ON products.user_id=users.id INNER JOIN product_cats ON product_cats.id=products.product_cat where products.id='$id'");
        return $result;
    }

    function get_media_id($id)
    {
        $result=db_fetch_row("SELECT medias.id FROM `products` INNER JOIN medias ON products.thumb_id=medias.id INNER JOIN users ON products.user_id=users.id INNER JOIN product_cats ON product_cats.id=products.product_cat where products.id='$id'");
        return $result;
    }
?>
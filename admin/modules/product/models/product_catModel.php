<?php
    function get_list_products_cat($start,$num_per_page,$trash,$search="")
    {
        $result=db_fetch_array("select * from product_cats  WHERE `trash`='$trash'&&`cat_name` like '%$search%' limit $start,$num_per_page");
        return $result;
    }

     function get_list_products_cat_notLimit()
     {
         $result=db_fetch_array("SELECT * FROM `product_cats`");
         return $result;
     }

     function get_num_row($trash)
     {
          $result=db_num_rows("select * from product_cats where trash='$trash'");
          return $result;
     }

     function get_product_cat_by_id($id)
     {
        $result=db_fetch_row("select * from product_cats where id='$id'");
        return $result;
     }
?>
<?php
     function get_list_order($start,$num_page,$search="",$where="&&status like '%'")
     {
         $result=db_fetch_array("SELECT id,cus_name,cus_order_code,cus_email,cus_add,cus_phone,cus_note,`status`,cus_total,`date` from cus_order where cus_name like '%$search%'$where LIMIT $start,$num_page");
         return $result;
     }
 
     function get_num_row()
     {
         $result=db_num_rows("select * from cus_order");
         return $result;
     }

     function get_list_cus_order_side_pro($id)
     {
        $result=db_fetch_array("SELECT cus_product.id,cus_product.idOfProduct,cus_product.product_code,cus_product.thumb_name,cus_product.product_name,cus_product.product_price,cus_product.product_qty,cus_product.sub_total,cus_product.cus_order_id FROM `cus_order` INNER JOIN cus_product ON cus_order.id=cus_product.cus_order_id where cus_order.id='$id'");
        return $result;
     }

     function num_status($status)
     {
        $result=db_fetch_array("SELECT status,COUNT(status) as num FROM `cus_order` WHERE status='$status' GROUP BY STATUS");
        return $result;
     }
?>
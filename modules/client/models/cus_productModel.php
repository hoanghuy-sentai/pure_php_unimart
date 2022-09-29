<?php
    function get_most_saling()
    {
        $result=db_fetch_array("SELECT idOfProduct as id,product_name,SUM(product_qty) as qty,thumb_name,product_price  FROM `cus_product`   GROUP BY product_name LIMIT 0,6");
        return $result;
    }
?>
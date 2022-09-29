<?php
    function get_product_by_id()
    {
        $result=db_fetch_array("SELECT * FROM `products` ");
        return $result;
    }
?>
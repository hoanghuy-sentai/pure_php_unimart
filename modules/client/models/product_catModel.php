<?php
function get_productsCat($where="")
{
    $result=db_fetch_array("SELECT * FROM `product_cats` $where");
    return $result;
} 

function get_product_cat_by_id($id)
{
    $result=db_fetch_row("SELECT * FROM `product_cats` where id='$id'");
    return $result;
}

?>
<?php 
function get_list_product($start,$num_page,$search="",$where="&&id IN(3,4)")
{
    $result=db_fetch_array("SELECT products.id,medias.thumb_name,products.product_name,products.product_code,products.product_short_desc,products.product_price,products.product_detail_desc,products.product_cat,products.product_status,products.productFeature FROM `products` INNER JOIN medias ON medias.id=products.thumb_id where product_name like '%$search%'$where LIMIT $start,$num_page");
    return $result;
}

function get_num_row($where)
{
    $result=db_num_rows("select * from products where $where");
    return $result;
}

function get_featureProducts()
{
    $result=db_fetch_array("SELECT products.id,products.thumb_id,products.product_name,products.product_price,medias.thumb_name FROM `products` INNER JOIN medias ON medias.id=products.thumb_id  WHERE `product_status`='active' and `productFeature`=0");
    return $result;
}

function get_products($parrent_id)
{
    $result=db_fetch_array("SELECT products.id,product_short_desc, products.thumb_id,products.product_name,products.product_price,medias.thumb_name,product_cats.cat_name,product_cats.parent_id FROM `products` INNER JOIN medias ON medias.id=products.thumb_id INNER JOIN product_cats ON product_cats.id=products.product_cat WHERE product_cats.parent_id='$parrent_id' && products.product_status='active' limit 0,8");
    return $result;
}

function get_list_products()
{
    $result=db_fetch_array("SELECT products.id, products.product_cat,products.thumb_id,products.product_name,products.product_price,medias.thumb_name,product_cats.cat_name,product_cats.parent_id FROM `products` INNER JOIN medias ON medias.id=products.thumb_id INNER JOIN product_cats ON product_cats.id=products.product_cat WHERE  products.product_status='active'");
    return $result;
}

function get_product_by_id($id)
{
    $result=db_fetch_row("SELECT products.id,medias.thumb_name,products.product_name,products.product_code,products.product_short_desc,products.product_price,products.product_qty,products.product_detail_desc,products.product_cat,products.product_status,products.productFeature FROM `products` INNER JOIN medias ON medias.id=products.thumb_id WHERE products.id=$id");
    return $result;
}

function get_product_catInProductTbl($id)
{
    $result=db_fetch_row("select product_cat from products where id='$id'");
    return $result;
}

function count_record_by_cat_id($product_cat)
{
    $result=db_num_rows("select * from products where product_cat='$product_cat'");
}
//-----------------searching part
function get_num_products_forSearching($search)
{
    $result=db_num_rows("SELECT products.id,product_short_desc, products.thumb_id,products.product_name,products.product_price,medias.thumb_name,product_cats.cat_name,product_cats.parent_id FROM `products` INNER JOIN medias ON medias.id=products.thumb_id INNER JOIN product_cats ON product_cats.id=products.product_cat WHERE products.product_name LIKE '%$search%'");
    return $result;
}
function get_list_product2($start,$num_page,$search="",$where=" order by product_name desc")
{
    $result=db_fetch_array("SELECT products.id,medias.thumb_name,products.product_name,products.product_code,products.product_price,products.product_short_desc,products.product_detail_desc,products.product_cat,products.product_status,products.productFeature FROM `products` INNER JOIN medias ON medias.id=products.thumb_id where product_name like '%$search%'$where LIMIT $start,$num_page");
    return $result;
}
?>
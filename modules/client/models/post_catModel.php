<?php 
function get_postsCat($where="")
{
    $result=db_fetch_array("SELECT * FROM `post_cat` $where");
    return $result;
} 


?>
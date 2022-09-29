<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

    function list_post_of_id_of_cat($listPostCat_ById,$posts,$idOfCat=0)
    {
        if(!empty($listProductCat_ById))
        {
            $rs=array();
            foreach($listPostCat_ById as $item)
            {
                foreach($posts as $post){
                    if($item['id']==$post['cat_id'])
                    {
                        $rs[]=$post;
                    }
                }
            }
            return $rs;
        }
        else{
            $rs=array();
            foreach($posts as $post){
                if($post['cat_id']==$idOfCat)
                {
                    $rs[]=$post;
                }
            }
            return $rs;
        }
    }
?>
<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

    function list_product_of_id_of_cat($listProductCat_ById,$products,$idOfCat=0)
    {
        if(!empty($listProductCat_ById))
        {
            $rs=array();
            foreach($listProductCat_ById as $item)
            {
                foreach($products as $product){
                    if($item['id']==$product['product_cat'])
                    {
                        $rs[]=$product;
                    }
                }
            }
            return $rs;
        }
        else{
            $rs=array();
            foreach($products as $product){
                if($product['product_cat']==$idOfCat)
                {
                    $rs[]=$product;
                }
            }
            return $rs;
        }
    }
?>
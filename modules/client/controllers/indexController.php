<?php

function construct() {
    
}
function indexAction()
{
    // load("helper","url");
    load_model("slider");
    load_model("product");
    load_model("product_cat");
    load("helper","productCategories");
    load_model("cus_product");
    
    $sliders=get_sliders();
    $productsCat=get_productsCat();
    $featureProducts=get_featureProducts();
    $phone_products=get_products(1);
    $laptop_products=get_products(2);

    /*most saling */
    $rs=array();
    $mostSaling=get_most_saling();
    foreach($mostSaling as $item)
    {
        if($item['qty']>5)
        {
            $rs[]=$item;
        }
    }
    $data['mostSaling']=$rs;
    /**/

    $data['sliders']=$sliders;
    $data['productsCat']=$productsCat;
    $data['featureProducts']= $featureProducts;
    $data['phone_products']=$phone_products;
    $data['laptop_products']=$laptop_products;

    load_view("showHomePage",$data);
}


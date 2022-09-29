<?php
    function construct()
    {

    }
    function listProductByCatIdAction()
    {
        load("helper","productCategories");
        load_model("product_cat");
        load("helper","listProductCat_ById");
        load_model("product");
        load("helper","list_product_of_id_of_cat");

        $id= isset($_GET['id'])?(int)$_GET['id']:null;

        /*break cump part*/
        $break_cump=array();
        $product_cat=get_product_catInProductTbl($id)['product_cat'];
        $product_cat_info_by_id=get_product_cat_by_id($product_cat);
        $break_cump['destination']= $product_cat_info_by_id['cat_name'];
        $parentId_of_product_cat= $product_cat_info_by_id['parent_id'];
        $list_product_cat=get_productsCat();
        foreach($list_product_cat as $item)
        {
            if($item['id']==$parentId_of_product_cat)
            {
                $break_cump['dad_cat_name']=$item['cat_name'];
            }
        }
        $data['break_cump']=$break_cump;
        /**/

        $product=get_product_by_id($id);
        // show_array($product);
        /*the same category part */
        $products=get_list_products();
        $show_product_by_product_cat= $product['product_cat'];
        $show_product_id=$product['id'];
        // echo $show_product_id;
        $rs=array();
        foreach($products as $value)
        {
            if($value['product_cat']==$show_product_by_product_cat)
            {
                $rs[]=$value;
            }
        }
        foreach($rs as $k=> $val)
        {
            if($val['id']==$show_product_id)
            {
                unset($rs[$k]);
            }
        }
        $data['theSamCategoryProducts']=$rs;
        /* */


        $productsCats=get_productsCat();


        $data['productsCats']=$productsCats;
        $data['product']=$product;
        load_view("ClientProductDetailProductByCatId",$data);
    }
?>
<?php
     function construct()
     {
  
     }

    function list_productsAction()
    {
        load_model("product_cat");
        load_model("product");
        load("helper","productCategories");
        
        $product_cat=get_productsCat();

        /*get all cat name*/
        $list_product_cat=get_productsCat();
        $products=get_list_products();
    

        function list_cat_and_list_product($list_product_cat,$products)
        {
            $rs=array();
            foreach($list_product_cat as $val)
            {
                if($val['parent_id']==0)
                {
                    $id=$val['id'];
                    foreach($list_product_cat as $ite)
                    {
                        if($ite['parent_id']==$id)
                        {     
                            $id2=$ite['id'];
                            foreach($products as $product)
                            {
                                if($product['product_cat']==$id2)
                                {
                                     $rs[$val['cat_name']][]=$product;
                                     $count_num=$id2;
                                     for($i=4;$i<$count_num;$i++)
                                     {  
                                         unset($rs[$val['cat_name']][$i]);
                                     }
                                }
                            }
                        }
                    }
                }
            }
            return $rs;  
        }       

        // show_array(list_cat_and_list_product($list_product_cat,$products,0));
        $products= list_cat_and_list_product($list_product_cat,$products,0);
        $data['products']=$products;

        $data['product_cat']=$product_cat;
        /**/
        load_view("ClientListProductShow_list_product",$data);
    }
?>
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
        load("helper","pagination");

        $id= isset($_GET['id'])?(int)$_GET['id']:null;
        $data['id']=$id;

        
        $productsCats=get_productsCat();
        $products=get_list_products();
        $listProductCat_ById=listProductCat_ById($id,$productsCats);

        $products2=list_product_of_id_of_cat($listProductCat_ById,$products,$id);
        $get_ids=array();
        if(count($products2)>0){
            foreach($products2 as $item)
            {
                $get_ids[]=$item['id'];
            }
            $list_id= implode(',',$get_ids);
            $where="&&products.id IN($list_id)";
            $where2="products.id IN($list_id)";
        }
        else{
            $where="&&products.product_cat=$id";
            $where2="products.product_cat=$id";
        }
       /* pagination*/
       $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
       $num_page=8;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
       $num_row=get_num_row($where2);//cần
       $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

       $pagination=pagination($page,$num_page,$num_row,$num_per_page);

       $start=$pagination['start'];


       $products=get_list_product($start,$num_page,"",$where);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

       $data['num_per_page']=$num_per_page;
       $data['page']=$pagination['page'];
       /*  end pagination */

       /*order */
        if(isset($_POST["filter"]))
        {
            $where3=$where."order by product_name ASC";
            $where4=$where."order by product_name DESC";
            $where5=$where."order by product_price DESC";
            $where6=$where."order by product_price ASC";
            switch($_POST['select']){
                case '0':return false;
                break;
                case '1': $products=get_list_product($start,$num_page,"",$where3);
                break;
                case '2': $products=get_list_product($start,$num_page,"",$where4);
                break;
                case '3': $products=get_list_product($start,$num_page,"",$where5);
                break;
                case '4': $products=get_list_product($start,$num_page,"",$where6);
                break;
                default:0;
            }
        }
       /**/
       /*Name of product cat*/
       $name_product_cat=get_productsCat("where id=$id");
       /**/

       /*price filter */
       if(isset($_POST['r-price']))
       {
            $filter1=$where."&& product_price <50000";
            $filter2=$where."&& product_price >500000&& product_price <1000000";
            $filter3=$where."&& product_price >1000000 && product_price <5000000";
            $filter4=$where."&& product_price >5000000 && product_price <10000000";
            $filter5=$where."&& product_price >10000000";
            switch($_POST['r-price'])
            {
                case 'r-price-under500t':
                    $products=get_list_product($start,$num_page,"",$filter1);;
                break;
                case 'r-price-between500t-1m':
                    $products=get_list_product($start,$num_page,"",$filter2);;
                break;
                case 'r-price-between1m-5m':
                    $products=get_list_product($start,$num_page,"",$filter3);;
                break;
                case 'r-price-between5m-10m':
                    $products=get_list_product($start,$num_page,"",$filter4);;
                break;
                case 'r-price-below10m':
                    $products=get_list_product($start,$num_page,"",$filter5);;
                break;
                default:0;
            }
       }
       /**/

       $count_product=get_num_row($where2);

        $data['name_product_cat']=$name_product_cat;
        $data['productsCats']=$productsCats;
        $data['products2']=$products2;
        $data['products']=$products;
        $data['id']=$id;
        $data['count_product']=$count_product;

        load_view("ClientProductListProductByCatId",$data);
    }
?>
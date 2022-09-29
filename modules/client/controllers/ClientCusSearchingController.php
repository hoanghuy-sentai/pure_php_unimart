<?php
    function construct()
    {

    }

    function show_search_rsAction()
    {
        load("helper","productCategories");
        load_model("product");
        load("helper","pagination");
        load_model("product_cat");


        $key_word=isset($_POST['s'])?$_POST['s']:$_GET['s'];
        $productsCats=get_productsCat();
       /* pagination*/
       $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
       $num_page=5;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
       $num_row=get_num_products_forSearching($key_word);//cần
       $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

       $pagination=pagination($page,$num_page,$num_row,$num_per_page);

       $start=$pagination['start'];


       $products=get_list_product2($start,$num_page,$key_word);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

       $data['num_per_page']=$num_per_page;
       $data['page']=$pagination['page'];
       /*  end pagination */
       /*order */
            if(isset($_POST["filter"]))
            {
                $where3=" order by product_name ASC";
                $where4=" order by product_name DESC";
                $where5=" order by product_price DESC";
                $where6=" order by product_price ASC";
                switch($_POST['select']){
                    case '0':return false;
                    break;
                    case '1': $products=get_list_product2($start,$num_page,$key_word,$where3);
                    break;
                    case '2':  $products=get_list_product2($start,$num_page,$key_word,$where4);
                    break;
                    case '3': $products=get_list_product2($start,$num_page,$key_word,$where5);
                    break;
                    case '4': $products=get_list_product2($start,$num_page,$key_word,$where6);
                    break;
                    default:0;
                }
            }
       /**/
       $data['key_word']=$key_word;
       $data['products']=$products;
       $data['total_record']=$num_row;
       $data['productsCats']=$productsCats;
       load_view("ClientCusSearchingShow_search_rs",$data);
    }
?>
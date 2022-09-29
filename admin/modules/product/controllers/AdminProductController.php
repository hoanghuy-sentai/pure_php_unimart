<?php
    function construct() {
        function data($data,$parent_id=0,$level=0)
        {
                $rs=array();
                foreach($data as $item)
                {
                        if($item['parent_id']==$parent_id)
                        {
                                $item['level']=$level;
                                $rs[]=$item;
                                $id=$item['id'];
                                $child= data($data,$id,$level+1);

                                $rs=array_merge($rs,$child);

                        }
                }
                return $rs;
        }
    }
    function indexAction(){
        
    }

    function showListProductAction()
    {
        load("helper","redirecting");
        load("helper","format");//format number
        load("helper","pagination");//to get paginate
        load_model("product");//load model of product
        load("helper","checkVarEmpty");//to echo data in view

        $data['name']=$_SESSION['info_user_login']['name'];
         /* pagination*/
         $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
         $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
         $num_row=get_num_row(0);//cần
         $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

         $pagination=pagination($page,$num_page,$num_row,$num_per_page);

         $start=$pagination['start'];


         $products=get_list_products($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

         $data['num_per_page']=$num_per_page;
         $data['page']=$pagination['page'];
         /*  end pagination */

       
        /*task*/
         //task

         if(isset($_POST['sm_action']))
         {
             global $data,$error;

             $list_check=isset($_POST['checkItem'])?$_POST['checkItem']:null;
             if(isset($list_check))
             {

                 // show_array($_POST['checkItem']);

                 $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;

                 // show_array($_POST);
                 $actions=$_POST['actions'];
                 global $data,$error;
                 switch($actions)
                 {
                     case 'choose': $error['wrong_task']="Hãy chọn vào tác vụ nào đó để thực thi";
                     break;
                     case 'delete':
                         // show_array($_POST['checkItem']);
                         foreach($_POST['checkItem'] as $item)
                         {
                             $data=[
                                 'trash'=>1,
                             ];
                             $where='id='.$item;
                             db_update('products',$data,$where);
                         }
                         $info['ok']='Đã bỏ bản ghi vào thùng rác';
                     break;
                     case 'restore':
                         foreach($_POST['checkItem'] as $item)
                         {
                             $data=[
                                 'trash'=>0,
                             ];
                             $where='id='.$item;
                             db_update('products',$data,$where);
                         }
                         $info['ok']='Đã khôi phục bản ghi';
                         ;
                     break;
                     case 'deletePern':
                         foreach($_POST['checkItem'] as $item)
                         {     
                             $where='id='.$item;
                             $get_post_thumb=get_name_img($item);
                             $destination_path=getcwd().DIRECTORY_SEPARATOR;
                             $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$get_post_thumb['thumb_name'];
                             if(unlink($target_path))
                             {
                                db_delete("products","products.id=$item");
                             }
                         }
                         redirect("?mod=product&controller=AdminProduct&action=showListProduct&ok=ok");
                         ;
                     break;
                         
                     default:0;
                 }

             }
             else{
                 $error['wrong_task']="Bạn chưa chọn tác vụ nào cả";
             }
         }
         //end task
        /**/

        /*show num record*/
        //show num of record
        $show_record=array();
        $all=show_num_row("products.trash=0");
        $active=show_num_row("products.product_status='active'&&products.trash=0");
        $not_active=show_num_row("products.product_status='not_active'&&products.trash=0");
        $trash=show_num_row("products.trash=1");
        $show_record=[$all,$active,$not_active,$trash];
        //end show num of record
        /**/

        /*when click each status record*/
        if(isset($_GET['status'])&&$_GET['status']=='notTrash')
        {
           $products=get_list_products($start,$num_page,0);
           $actions=['delete'=>'Bỏ vào thùng rác'];
        }

        if(isset($_GET['sts'])&&$_GET['sts']=="active")
        {
            $products=get_list_products($start,$num_page,0,"","&&products.product_status = 'active'");
        }

        if(isset($_GET['status'])&&$_GET['status']=="Trash")
        {
           $products=get_list_products($start,$num_page,1);
           $actions=['restore'=>'Khôi phục','deletePern'=>'Xóa'];
        }

        if(isset($_GET['sts'])&&$_GET['sts']=="not_active")
        {
            $products=get_list_products($start,$num_page,0,"","&&products.product_status = 'not_active'");
        }
        /**/

         /*search */
         if(isset($_POST['sm_s']))
         {
               $search=$_POST['s'];
               $products=get_list_products($start,$num_page,0,$search);
         }
         /**/
        $data['info']=isset($info['ok'])?$info['ok']:null;//show notification

        $data['actions']=isset($actions)?$actions:null;////get action in the each status

        $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
        $data['ok']=isset($_GET['ok'])?'Đã thao tác thành công':null;

        $data['show_record']=$show_record;//show record

        $data['num_per_page']=$num_per_page;//call again

        $data['products']=$products;//pass list product into view

        load_view("AdminProductProductShowListProduct",$data);
    }

    function addAction()
    {
        load_model("product");//load model product
        load("helper","stringValidation");//use it to check correct rules
        load("helper","intValidation");//use it to check correct rules
        load("helper","checkVarEmpty");//to check variable is empty or not
        load("helper","redirecting");//use redirect because when btn_add fall down.It will run redirect and not happnen any errors

        $productCats=data(get_list_products_cat_notLimit(0),0,0);//Load Danh mục sản phẩm
        $data['productCats']=$productCats;//load product cat in view
        $data['name']=$_SESSION['info_user_login']['name'];//to show name user on header
        /*show data when it has error and if it not error is null */
        $data['empty_product_name']=isset($error['empty_product_name'])?$error['empty_product_name']:null;
        $data['empty_product_code']=isset($error['empty_product_code'])?$error['empty_product_code']:null;
        $data['empty_product_price']=isset($error['empty_product_price'])?$error['empty_product_price']:null;
        $data['empty_product_qty']=isset($error['empty_product_qty'])?$error['empty_product_qty']:null;
        $data['empty_product_short_desc']=isset($error['empty_product_short_desc'])?$error['empty_product_short_descs']:null;
        $data['empty_product_detail_desc']=isset($error['empty_product_detail_desc'])?$error['empty_product_detail_descs']:null;
        $data['empty_product_thumb']=isset($error['empty_product_thumb'])?$error['empty_product_thumb']:null;
        $data['empty_product_cat']=isset($error['empty_product_cat'])?$error['empty_product_cat']:null;
        $data['empty_product_status']=isset($error['empty_product_status'])?$error['empty_product_status']:null;
        /* */
        $data['ok']=null;//to give info to user
        if(isset($_POST['btn-submit']))
        {
            $data['name']=$_SESSION['info_user_login']['name'];//to show name user on header
            /* prepart data for actions below*/
            $product_name=isset($_POST['product_name'])?$_POST['product_name']:null;//
            $product_code=isset($_POST['product_code'])?$_POST['product_code']:null;
            $product_price=isset($_POST['product_price'])?$_POST['product_price']:null;
            $product_qty=isset($_POST['product_qty'])?$_POST['product_qty']:null;
            $product_short_desc=isset($_POST['product_short_desc'])?$_POST['product_short_desc']:null;
            $product_detail_desc=isset($_POST['product_detail_desc'])?$_POST['product_detail_desc']:null;
            $product_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:null;
            $product_cat=isset($_POST['product_cat'])?$_POST['product_cat']:null;
            $product_status=isset($_POST['product_status'])?$_POST['product_status']:null;
            /**/
            $error=array();//initial array flag

            if(empty($product_name))//check product name
            {
                $error['empty_product_name']="Tên sản phẩm không được để trống" ;//lowering the flag
            }
            else
            {
                if(!stringValidation($product_name)) //check rules of product name
                {
                    $error['empty_product_name']="Tên sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
                }
            }

            if(empty($product_code))//check product code
            {
                $error['empty_product_code']="Mã sản phẩm không được để trống" ;//lowering the flag
            }
            else{
                if(!check_product_code($product_code))
                {
                    $error['empty_product_code']="Mã sản phẩm này đã được sử dụng.Hãy tạo một mã khác." ;//lowering the flag
                }
            }

            if(empty($product_price))//chekc product price
            {
                $error['empty_product_price']="Mã sản phẩm không được để trống" ;//lowering the flag
            }
            else
            {
                if(!intValidation($product_price))
                {
                    $error['empty_product_price']="Giá sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
                }
            }

            if(empty($product_qty))//chekc product price
            {
                $error['empty_product_qty']="Số lượng sản phẩm không được để trống" ;//lowering the flag
            }
            else
            {
                if(!intValidation($product_qty))
                {
                    $error['empty_product_price']="Số lượng sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
                }
            }

            if(empty($product_short_desc))//check product short desc
            {
                $error['empty_product_short_desc']="Mô tả ngắn về sản phẩm không được để trống" ;//lowering the flag
            }

            if(empty($product_detail_desc))//check product detail desc
            {
                $error['empty_product_detail_desc']="Mô tả về sản phẩm không được để trống" ;//lowering the flag
            }

            if(empty($product_thumb))//check product picture
            {
                $error['empty_product_thumb']="Hãy chọn một hình ảnh về sản phẩm nhé" ;//lowering the flag
            }
            else
            {
                /* check extention của ảnh */
                $fileImageExtension=['png','jpeg','jpg','gif'];
                if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
                {
                    $error['empty_product_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
                }
                /*end check extention của ảnh */
                if($_FILES['file']['size']>200000)//20.0000MB
                {
                    $error['empty_product_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
                }
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\products\ ").basename($_FILES['file']['name']);
                if(file_exists($target_path))
                {
                    $error['empty_product_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
                }
            }

            if(empty($product_cat))//check product cat
            {
                $error['empty_product_cat']="Hãy chọn danh mục sản phẩm" ;//lowering the flag
            }

            if(empty($product_status))//check product status
            {
                $error['empty_product_status']="Hãy một trạng thái" ;//lowering the flag
            }

            if(!empty($error))//when any lowering the flag,it will do
            {
                /*load data again when data just enter is wrong */
                $data['product_name']=isset($product_name)?$product_name:null;
                $data['product_code']=isset($product_code)?$product_code:null;
                $data['product_price']=isset($product_price)?$product_price:null;
                $data['product_qty']=isset($product_qty)?$product_qty:null;
                $data['product_short_desc']=isset($product_short_desc)?$product_short_desc:null;
                $data['product_detail_desc']=isset($product_detail_desc)?$product_detail_desc:null;
                $data['product_thumb']=isset($product_thumb)?$product_thumb:null;
                $data['product_cat']=isset($product_cat)?$product_cat:null;
                $data['product_status']=isset($product_status)?$product_status:null;
                /**/
                /*show data when it has error and if it not error is null */
                $data['empty_product_name']=isset($error['empty_product_name'])?$error['empty_product_name']:null;
                $data['empty_product_code']=isset($error['empty_product_code'])?$error['empty_product_code']:null;
                $data['empty_product_price']=isset($error['empty_product_price'])?$error['empty_product_price']:null;
                $data['empty_product_qty']=isset($error['empty_product_qty'])?$error['empty_product_qty']:null;
                $data['empty_product_short_desc']=isset($error['empty_product_short_desc'])?$error['empty_product_short_desc']:null;
                $data['empty_product_detail_desc']=isset($error['empty_product_detail_desc'])?$error['empty_product_detail_desc']:null;
                $data['empty_product_thumb']=isset($error['empty_product_thumb'])?$error['empty_product_thumb']:null;
                $data['empty_product_cat']=isset($error['empty_product_cat'])?$error['empty_product_cat']:null;
                $data['empty_product_status']=isset($error['empty_product_status'])?$error['empty_product_status']:null;
                /* */
            }
            if(empty($error))
            {
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\products\ ").basename($_FILES['file']['name']);
                if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
                {
                    $data1=[
                        'thumb_name'=>'/products/'.$product_thumb,
                        'time'=>date('d/m/Y'),
                        'user_id'=>$_SESSION['info_user_login']['id'],
                    ];
                    $thumb_id=db_insert('medias',$data1);
                    $data=[
                        'product_name'=>$product_name,
                        'product_code'=>$product_code,
                        'product_price'=>$product_price,
                        'product_qty'=>$product_qty,
                        'product_short_desc'=>$product_short_desc,
                        'product_detail_desc'=>$product_detail_desc,
                        'thumb_id'=>$thumb_id,
                        'user_id'=>$_SESSION['info_user_login']['id'],
                        'product_cat'=>$product_cat,
                        'product_status'=>$product_status,
                        'productFeature'=>$_POST['productFeature'],
                        'time'=>date("m/d/Y"),
                    ];
                    db_insert("products",$data);
                    redirect("?mod=product&controller=AdminProduct&action=showListProduct&page=1&status=notTrash&ok=ok");
                }
            }
            $data['ok']=isset($_GET['ok'])?$_GET['ok']:null;//to give info to user
        }
        /* prepart data for actions below*///cause If haven't click btn-sumit.Subjects are left in view and error will happen
        $data['product_name']=isset($product_name)?$product_name:null;
        $data['product_code']=isset($product_code)?$product_code:null;
        $data['product_price']=isset($product_price)?$product_price:null;
        $data['product_qty']=isset($product_qty)?$product_qty:null;
        $data['product_short_desc']=isset($product_short_desc)?$product_short_desc:null;
        $data['product_detail_desc']=isset($product_detail_desc)?$product_detail_desc:null;
        $data['product_thumb']=isset($product_thumb)?$product_thumb:null;
        $data['product_cat']=isset($product_cat)?$product_cat:null;
        $data['product_status']=isset($product_status)?$product_status:null;
        /**/

        load_view("AdminProductProductAddProduct",$data);
    }

    function deleteAction()
    {
        load("helper","redirecting");
        load_model("product");

         $id=(int)$_GET['id'];
         $get_post_thumb=get_name_img($id);
         $destination_path=getcwd().DIRECTORY_SEPARATOR;
         $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$get_post_thumb['thumb_name'];
         if(unlink($target_path))
         {
            db_delete("products","products.id=$id");
         }
      
         redirect("?mod=product&controller=AdminProduct&action=showListProduct&ok=ok");
    }

    function editAction()
    {
        load_model("product");//load model product
        load("helper","stringValidation");//use it to check correct rules
        load("helper","intValidation");//use it to check correct rules
        load("helper","checkVarEmpty");//to check variable is empty or not
        load("helper","redirecting");//use redirect because when btn_add fall down.It will run redirect and not happnen any errors

        $id=(int)$_GET['id'];//get id on url address
        $data['name']=$_SESSION['info_user_login']['name'];//to show name user on header

        $product=get_product_by_id($id);//get data
        /*prepare for data to to edit */
        $data['ok']=null;
        $data['id']=$product['id'];
        $product_name=isset($_POST['product_name'])?$_POST['product_name']:$product['product_name'];
        $product_code=isset($_POST['product_code'])?$_POST['product_code']:$product['product_code'];
        $product_code_=$product['product_code'];
        $product_price=isset($_POST['product_price'])?$_POST['product_price']:$product['product_price'];
        $product_qty=isset($_POST['product_qty'])?$_POST['product_qty']:$product['product_qty'];
        $product_short_desc=isset($_POST['product_short_desc'])?$_POST['product_short_desc']:$product['product_short_desc'];
        $product_detail_desc=isset($_POST['product_detail_desc'])?$_POST['product_detail_desc']:$product['product_detail_desc'];
        $product_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:$product['thumb_name'];
        $product_thumb_=isset($_POST['file_']['name'])?$_POST['file_']['name']:$product['thumb_name'];
        $product_cat=isset($_POST['product_cat'])?$_POST['product_cat']:$product['product_cat'];
        $product_status=isset($_POST['product_status'])?$_POST['product_status']:$product['product_status'];
        $product_feature=isset($_POST['productFeature'])?$_POST['productFeature']:$product['productFeature'];
        /**/
         /*load data again when data just enter is wrong */
         $data['product_name']=isset($product_name)?$product_name:null;
         $data['product_code']=isset($product_code)?$product_code:null;
         $data['product_price']=isset($product_price)?$product_price:null;
         $data['product_qty']=isset($product_qty)?$product_qty:null;
         $data['product_short_desc']=isset($product_short_desc)?$product_short_desc:null;
         $data['product_detail_desc']=isset($product_detail_desc)?$product_detail_desc:null;
         $data['product_thumb']=isset($product_thumb)?$product_thumb:null;
         $data['product_cat']=isset($product_cat)?$product_cat:null;
         $data['product_status']=isset($product_status)?$product_status:null;
         $data['product_feature']=isset($product_feature)?$product_feature:null;
         /**/
         /*show data when it has error and if it not error is null */
         $data['empty_product_name']=isset($error['empty_product_name'])?$error['empty_product_name']:null;
         $data['empty_product_code']=isset($error['empty_product_code'])?$error['empty_product_code']:null;
         $data['empty_product_price']=isset($error['empty_product_price'])?$error['empty_product_price']:null;
         $data['empty_product_qty']=isset($error['empty_product_qty'])?$error['empty_product_qty']:null;
         $data['empty_product_short_desc']=isset($error['empty_product_short_desc'])?$error['empty_product_short_desc']:null;
         $data['empty_product_detail_desc']=isset($error['empty_product_detail_desc'])?$error['empty_product_detail_desc']:null;
         $data['empty_product_thumb']=isset($error['empty_product_thumb'])?$error['empty_product_thumb']:null;
         $data['empty_product_cat']=isset($error['empty_product_cat'])?$error['empty_product_cat']:null;
         $data['empty_product_status']=isset($error['empty_product_status'])?$error['empty_product_status']:null;
         /* */
        if(isset($_POST["btn-submit"]))
        {
             /*coppy add*/
        /* prepare data for actions below*/
        
        /**/
        $error=array();//initial array flag

        if(empty($product_name))//check product name
        {
            $error['empty_product_name']="Tên sản phẩm không được để trống" ;//lowering the flag
        }
        else
        {
            if(!stringValidation($product_name)) //check rules of product name
            {
                $error['empty_product_name']="Tên sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
            }
        }

        if(empty($product_code))//check product code
        {
            $error['empty_product_code']="Mã sản phẩm không được để trống" ;//lowering the flag
        }
        else{
            if($product_code_!=$product_code)
            {
                if(!check_product_code($product_code))
                {
                    $error['empty_product_code']="Mã sản phẩm này đã được sử dụng.Hãy tạo một mã khác." ;//lowering the flag
                }
            }
        }

        if(empty($product_price))//chekc product price
        {
            $error['empty_product_price']="Mã sản phẩm không được để trống" ;//lowering the flag
        }
        else
        {
            if(!intValidation($product_price))
            {
                $error['empty_product_price']="Giá sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
            }
        }

        if(empty($product_qty))//chekc product price
        {
            $error['empty_product_qty']="Số lượng sản phẩm không được để trống" ;//lowering the flag
        }
        else
        {
            if(!intValidation($product_price))
            {
                $error['empty_product_qty']="Số lượng sản phẩm không đúng định dạng.Hãy kiểm tra lại" ;//lowering the flag
            }
        }

        if(empty($product_short_desc))//check product short desc
        {
            $error['empty_product_short_desc']="Mô tả ngắn về sản phẩm không được để trống" ;//lowering the flag
        }

        if(empty($product_detail_desc))//check product detail desc
        {
            $error['empty_product_detail_desc']="Mô tả về sản phẩm không được để trống" ;//lowering the flag
        }

        if(empty($product_thumb_))//check product picture
        {
            $error['empty_product_thumb']="Hãy chọn một hình ảnh về sản phẩm nhé" ;//lowering the flag
        }
        else
        {
            /* check extention của ảnh */
            $fileImageExtension=['png','jpeg','jpg','gif'];
            if(!empty($_FILES['file']['name']))
            {
                if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
                {
                    $error['empty_product_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
                }
                /*end check extention của ảnh */
                if($_FILES['file']['size']>200000)//20.0000MB
                {
                    $error['empty_product_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
                }
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\products\ ").basename($_FILES['file']['name']);
                if(file_exists($target_path))
                {
                    $error['empty_product_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
                }
            }
        }

        if(empty($product_cat))//check product cat
        {
            $error['empty_product_cat']="Hãy chọn danh mục sản phẩm" ;//lowering the flag
        }

        if(empty($product_status))//check product status
        {
            $error['empty_product_status']="Hãy một trạng thái" ;//lowering the flag
        }

        if(!empty($error))//when any lowering the flag,it will do
        {
            /*load data again when data just enter is wrong */
            $data['product_name']=isset($product_name)?$product_name:null;
            $data['product_code']=isset($product_code)?$product_code:null;
            $data['product_price']=isset($product_price)?$product_price:null;
            $data['product_qty']=isset($product_qty)?$product_qty:null;
            $data['product_short_desc']=isset($product_short_desc)?$product_short_desc:null;
            $data['product_detail_desc']=isset($product_detail_desc)?$product_detail_desc:null;
            $data['product_thumb']=isset($product_thumb)?$product_thumb:null;
            $data['product_cat']=isset($product_cat)?$product_cat:null;
            $data['product_status']=isset($product_status)?$product_status:null;
            /**/
            /*show data when it has error and if it not error is null */
            $data['empty_product_name']=isset($error['empty_product_name'])?$error['empty_product_name']:null;
            $data['empty_product_code']=isset($error['empty_product_code'])?$error['empty_product_code']:null;
            $data['empty_product_price']=isset($error['empty_product_price'])?$error['empty_product_price']:null;
            $data['empty_product_qty']=isset($error['empty_product_qty'])?$error['empty_product_qty']:null;
            $data['empty_product_short_desc']=isset($error['empty_product_short_desc'])?$error['empty_product_short_desc']:null;
            $data['empty_product_detail_desc']=isset($error['empty_product_detail_desc'])?$error['empty_product_detail_desc']:null;
            $data['empty_product_thumb']=isset($error['empty_product_thumb'])?$error['empty_product_thumb']:null;
            $data['empty_product_cat']=isset($error['empty_product_cat'])?$error['empty_product_cat']:null;
            $data['empty_product_status']=isset($error['empty_product_status'])?$error['empty_product_status']:null;
            /* */
        }
        if(empty($error))
        {
            if(!empty($_FILES['file']['name']))
            {
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\products\ ").basename($_FILES['file']['name']);
                if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
                {
                    $destination_path=getcwd().DIRECTORY_SEPARATOR;
                    $target_path_old=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$product_thumb_;
                    unlink($target_path_old);

                    $data1=[
                        'thumb_name'=>'/products/'.$product_thumb,
                        'time'=>date('d/m/Y'),
                        'user_id'=>$_SESSION['info_user_login']['id'],
                      ];
                    $id_media=get_media_id($id)['id'];
                    db_update("medias",$data1,"id=$id_media");
                    $data=[
                        'product_name'=>$product_name,
                        'product_code'=>$product_code,
                        'product_price'=>$product_price,
                        'product_qty'=>$product_qty,
                        'product_short_desc'=>$product_short_desc,
                        'product_detail_desc'=>$product_detail_desc,
                        'thumb_id'=>$id_media,
                        'product_cat'=>$product_cat,
                        'product_status'=>$product_status,
                        'productFeature'=> $product_feature,
                        'time'=>date('d/m/Y'),
                    ];
                    db_update("products",$data,"id='$id'");
                    redirect("?mod=product&controller=AdminProduct&action=showListProduct&page=1&status=notTrash&ok=ok");
                }
            }
            else{

                $data1=[
                    'thumb_name'=>$product_thumb_,
                    'time'=>date('d/m/Y'),
                    'user_id'=>$_SESSION['info_user_login']['id'],
                  ];
                $id_media=get_media_id($id)['id'];
                db_update("medias",$data1,"id=$id_media");
                $data=[
                    'product_name'=>$product_name,
                    'product_code'=>$product_code,
                    'product_price'=>$product_price,
                    'product_qty'=>$product_qty,
                    'product_short_desc'=>$product_short_desc,
                    'product_detail_desc'=>$product_detail_desc,
                    'thumb_id'=>$id_media,
                    'product_cat'=>$product_cat,
                    'product_status'=>$product_status,
                    'productFeature'=> $product_feature,
                    'time'=>date('d/m/Y'),
                ];
                db_update("products",$data,"id='$id'");
                redirect("?mod=product&controller=AdminProduct&action=showListProduct&page=1&status=notTrash&ok=ok");
            }
        }
        $data['ok']=isset($_GET['ok'])?$_GET['ok']:null;//to give info to user
        /**/
        }
       
        

        $productCats=data(get_list_products_cat_notLimit(0),0,0);//Load Danh mục sản phẩm
        $data['productCats']=$productCats;//load product cat in view
        load_view('AdminProductProductEditProduct',$data);
    }
    
 
?>
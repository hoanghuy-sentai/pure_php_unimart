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
        function showListProductCatAction()
        {
            load("helper","checkVarEmpty");
            load_model("product_cat");
            load("helper","pagination");

            /* pagination*/
           $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
           $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
           $num_row=get_num_row(0);//cần
           $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

           $pagination=pagination($page,$num_page,$num_row,$num_per_page);

           $start=$pagination['start'];


           $product_cats=get_list_products_cat($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

           $data['num_per_page']=$num_per_page;
           $data['page']=$pagination['page'];
           /*  end pagination */


            $productCats=data(get_list_products_cat_notLimit(),0,0);

            $data['productCats']=$productCats;

            $data['name']=$_SESSION['info_user_login']['name'];

            $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;
            $data['notOk']=isset($_GET['notOk'])?"Tên danh mục không được để trống":null;

            $data['product_cats']=$product_cats;

            load_view("AdminProductProductCatShowListProductCat",$data);
        }

        function  addCatAction()
        {
            load("helper","redirecting");

            if(isset($_POST["sm_i"]))
            {
            //    $error=array();

               $cat_name=$_POST['i'];
               $cat_id=$_POST['cat_id'];

               if(empty($cat_name))
               {
                  redirect("?mod=product&&controller=AdminProductCat&&action=showListProductCat&status=notTrash&notOk=ok");
               }
               
               if(!empty($cat_name))
               {
                    $data=[
                        'cat_name'=>$cat_name,
                        'product_cat_creating'=>date("d/m/Y"),
                        'status'=>'not_active',
                        'time'=>date("d/m/Y"),
                        'parent_id'=>$cat_id,
                        'trash'=>0,
                    ];
                    db_insert("product_cats",$data);
                    redirect("?mod=product&&controller=AdminProductCat&action=showListProductCat&status=notTrash&ok=ok");
               }
               
            }
        }

        function deleteAction()
        {
           load("helper","checkVarEmpty");
           load("helper","redirecting");  
                
           $id=(int)$_GET['id'];
           db_delete('product_cats',"id=$id");
           redirect("?mod=product&&controller=AdminProductCat&action=showListProductCat&page=1status=notTrash&ok=ok");
        }

        function editAction()
        {
           load_model("product_cat");
           load("helper","redirecting");

           $data['name']=$_SESSION['info_user_login']['name'];


           $id=(int)$_GET['id'];

           $data['id']=$id;

           $postCats=data(get_list_products_cat_notLimit(0),0,0);
           $post_cat=get_product_cat_by_id($id);


           $id=$post_cat['id'];
           $cat_name=$post_cat['cat_name'];
           $status=$post_cat['status'];
           $parent_id=$post_cat['cat_name'];
           $id_of_old_parentId=$post_cat['id'];

           $data['cat_name']=$cat_name;
           $data['status']=$status;
           $data['parent_id']=$parent_id;
           $data['id_of_old_parentId']= $id_of_old_parentId;

           $data['postCats']=$postCats;
           if(isset($_POST["btn-submit"]))
           {
                $id=(int)$_GET['id'];
                $error=array();

                $cat_name=isset($_POST['cat_name'])?$_POST['cat_name']:null;
                $status=isset($_POST['status'])?$_POST['status']:null;
                $parent_id=isset($_POST['parent_id'])?$_POST['parent_id']:0;
                
                if(empty($cat_name))
                {
                   $error['empty_cat_name']="Tên danh mục không được để trống";
                }
 
                if(!empty($error))
                {
                   $data['empty_cat_name']=$error['empty_cat_name'];
                }
 
                if(empty($error))
                {
                  if($parent_id==$id_of_old_parentId)
                  {
                     $parent_id_old=$post_cat['parent_id'];
                     $data=[
                           'cat_name'=>$cat_name,
                           'product_cat_creating'=>date("d/m/Y"),
                           'status'=>$status,
                           'time'=>date("d/m/Y"),
                           'parent_id'=>$parent_id_old,
                           'trash'=>0,
                     ];
                     db_update('product_cats',$data,"id=$id");
                     redirect("?mod=product&controller=AdminProductCat&action=showListProductCat&page=1status=notTrash&ok=ok");
                  }
                  else{
                        $data=[
                           'cat_name'=>$cat_name,
                           'product_cat_creating'=>date("d/m/Y"),
                           'status'=>$status,
                           'time'=>date("d/m/Y"),
                           'parent_id'=>$parent_id,
                           'trash'=>0,
                     ];
                     db_update('product_cats',$data,"id=$id");
                     redirect("?mod=product&controller=AdminProductCat&action=showListProductCat&page=1status=notTrash&ok=ok");
                  }
                }
           }

        
           

           load_view("AdminProductProductCatShowEditProductCat",$data);
        }
?>
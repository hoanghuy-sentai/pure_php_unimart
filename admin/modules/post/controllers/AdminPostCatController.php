<?php

use LDAP\Result;

        function construct() {
        //    echo "DÙng chung, load đầu tiên";
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
        
        function indexAction()
        {
           
        }

        function listPostCatAction()
        {
           load("helper","pagination");
           load("helper","checkVarEmpty");
           load("helper","redirecting");
           load_model("post_cat");
        
           $data['name']=$_SESSION['info_user_login']['name'];

           /* Phần thêm danh mục */
           if(isset($_POST['sm_i']))
           {
               $error=array();

               $cat_name=isset($_POST['i'])?$_POST['i']:null;
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
                  $data=[
                        'cat_name'=>$cat_name,
                        'post_cat_creating'=>date("d/m/Y"),
                        'status'=>'not_active',
                        'time'=>date("d/m/Y"),
                        'parent_id'=>$parent_id,
                        'trash'=>0,
                  ];
                  db_insert('post_cat',$data);
                  redirect("?mod=post&controller=AdminPostCat&action=listPostCat&ok=ok");
               }


               $data['ok']=isset($ok)?$ok:null;
               $data['empty_cat_name']=isset($error['empty_cat_name'])?$error['empty_cat_name']:null;
           }
           $data['ok']=isset($ok)?$ok:null;
           $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;
           $data['empty_cat_name']=isset($error['empty_cat_name'])?$error['empty_cat_name']:null;
           /*Kết thúc phần thêm danh mục */

           /* pagination*/
           $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
           $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
           $num_row=get_num_row(0);//cần
           $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

           $pagination=pagination($page,$num_page,$num_row,$num_per_page);

           $start=$pagination['start'];


           $posts_cat=get_list_postscat($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

           $data['num_per_page']=$num_per_page;
           $data['page']=$pagination['page'];
           /*  end pagination */
        
           $postCats=data(get_list_postscat_notLimit(0),0,0);

           $data['postCats']=$postCats;
           $data['posts_cat']=$posts_cat;

        //    show_array($postCats);

           load_view("AdminPostPostListPostsCat",$data);
        }

        function deleteAction()
        {
           load("helper","checkVarEmpty");
           load("helper","redirecting");  
                
           $id=(int)$_GET['id'];
           db_delete('post_cat',"id=$id");
           redirect("?mod=post&controller=AdminPostCat&action=listPostCat&ok=ok");
        }

        function editAction()
        {
           load_model("post_cat");
           load("helper","redirecting");

           $data['name']=$_SESSION['info_user_login']['name'];

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
                   $data=[
                         'cat_name'=>$cat_name,
                         'post_cat_creating'=>date("d/m/Y"),
                         'status'=>'not_active',
                         'time'=>date("d/m/Y"),
                         'parent_id'=>$parent_id,
                         'trash'=>0,
                   ];
                   db_update('post_cat',$data,"id=$id");
                   redirect("?mod=post&controller=AdminPostCat&action=listPostCat&ok=ok");
                }
           }

           $id=(int)$_GET['id'];

           $data['id']=$id;

           $postCats=data(get_list_postscat_notLimit(0),0,0);
           $post_cat=get_post_cat_by_id($id);

           $id=$post_cat['id'];
           $cat_name=$post_cat['cat_name'];
           $status=$post_cat['status'];
           $parent_id=$post_cat['cat_name'];

           $data['cat_name']=$cat_name;
           $data['status']=$status;
           $data['parent_id']=$parent_id;

           $data['postCats']=$postCats;
           

           load_view("AdminPostPostEditPostsCat",$data);
        }
?>
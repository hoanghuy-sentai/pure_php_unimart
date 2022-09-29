<?php 
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
        function listPostAction()
        {
            load("helper","redirecting");
            load("helper",'pagination');
            load_model("posts");
            load("helper","checkVarEmpty");

            $data['name']=$_SESSION['info_user_login']['name'];
            
             /* pagination */
             $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
             $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
             $num_row=get_num_row();//cần
             $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang
 
             $pagination=pagination($page,$num_page,$num_row,$num_per_page);
 
             $start=$pagination['start'];
 
 
             $posts=get_list_post($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại
 
             $data['num_per_page']=$num_per_page;
             $data['pag']=$pagination['page'];//Bây giờ tôi mới biết key không phân biệt s và ko có s và coi là 1
 
             /* end pagination*/

            //search part
            if(isset($_POST['sm_s']))
            {
              $search=$_POST['s'];
              $posts=get_list_post($start,$num_page,0,$search);
            }
            //end search part

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
                                db_update('posts',$data,$where);
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
                                db_update('posts',$data,$where);
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
                                  db_delete("posts","$where");
                                }
                            }
                            redirect("?mod=post&controller=AdminPost&action=listPost&ok=ok");
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

             //show num of record
             $show_record=array();
             $all=show_num_row("posts.trash=0");
             $active=show_num_row("posts.status='active'&&posts.trash=0");
             $not_active=show_num_row("posts.status='not_active'&&posts.trash=0");
             $trash=show_num_row("posts.trash=1");
             $show_record=[$all,$active,$not_active,$trash];
             //end show num of record

             $data['show_record']=$show_record;

             if(isset($_GET['status'])&&$_GET['status']=='notTrash')
             {
                $posts=get_list_post($start,$num_page,0);
                $actions=['delete'=>'Bỏ vào thùng rác'];
             }

             if(isset($_GET['sts'])&&$_GET['sts']=="active")
             {
                $posts=get_list_post($start,$num_page,0,"","&&posts.status = 'active'");
             }

             if(isset($_GET['sts'])&&$_GET['sts']=="not_active")
             {
                $posts=get_list_post($start,$num_page,0,"","&&posts.status = 'not_active'");
             }

             if(isset($_GET['status'])&&$_GET['status']=="Trash")
             {
                $posts=get_list_post($start,$num_page,1);
                $actions=['restore'=>'Khôi phục','deletePern'=>'Xóa'];
             }
            
             $data['info']=isset($info['ok'])?$info['ok']:null;
             $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;

             $data['actions']=isset($actions)?$actions:null;
             $data['posts']=$posts;

             $data['num_per_page']=$num_per_page;

             $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;

           load_view("AdminPostPostListPosts",$data);
        }

        function addAction()
        {
         // show_array($_FILES);

          load("helper","checkVarEmpty");
          load("helper",'stringValidation');
          load("helper","usernameValidation");
          load("helper","redirecting");
          // load_model("posts");
          load_model("post_cat");

          $data['name']=$_SESSION['info_user_login']['name'];

          $error=array();

          $post_title=isset($_POST['post_title'])?$_POST['post_title']:null;
          $post_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:null;
          $post_date=date("d/m/Y");
          $post_desc=isset($_POST['post_desc'])?$_POST['post_desc']:null;
          $slug=isset($_POST['slug'])?$_POST['slug']:null;
          $post_creating=date("d/m/Y");
          $cat_id=isset($_POST['cat-id'])?$_POST['cat-id']:null;
          $status=isset($_POST['status'])?$_POST['status']:null;
          $trash=0;

          $postCats=data(get_list_postscat_notLimit(0),0);

          $data['postCats']=$postCats;

          if(empty($post_title))
          {
             $error['emtpy_post_title']="Tiêu đề không được để trống";
          }
          else{
              if(!stringValidation($post_title))
              {
               $error['emtpy_post_title']="Tiêu đề không hợp lệ";
              }
          }

          if(empty($post_thumb))
          {
            $error['empty_post_thumb']="Hình ảnh không được để trống";
          }
          else
          {
            /* check extention của ảnh */
             $fileImageExtension=['png','jpeg','jpg','gif'];
             if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
             {
               $error['empty_post_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
             }
             /*end check extention của ảnh */
             if($_FILES['file']['size']>200000)//20.0000MB
             {
               $error['empty_post_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
             }
             $destination_path=getcwd().DIRECTORY_SEPARATOR;
             $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\posts\ ").basename($_FILES['file']['name']);
             if(file_exists($target_path))
             {
                $error['empty_post_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
             }
          }

          if(empty($post_desc))
          {
            $error['empty_post_desc']="Mô tả không được để trống";
          }

          if(empty($slug))
          {
            $error['empty_slug']="Slug bài viết không được để trống";
          }
          else{
             if(!usernameValidation($slug))
             {
               $error['empty_slug']="Slug không hợp lệ,hãy thử lại";
             }
          }

          if(empty($cat_id))
          {
            $error['empty_cat_id']="Danh mục bài viết không được để trống,hãy chọn 1 danh mục";
          }

          if(empty($status))
          {
            $error['empty_status']="Trạng thái bài viết không được để trống";
          }

          if(!empty($error))
          {
            
            /*load wrong and prepare for add after upload click*/
            $data['post_title']=isset($post_title)?$post_title:null;
            $data['post_thumb']=isset($post_thumb)?$post_thumb:null;
            $data['post_desc']=isset($post_desc)?$post_desc:null;
            $data['slug']=isset($slug)?$slug:null;
            $data['cat_id']=isset($cat_id)?$cat_id:null;
            $data['status']=isset($status)?$status:null;
            /**/
            
            $data['empty_post_title']=isset($error['emtpy_post_title'])?$error['emtpy_post_title']:null;
            $data['empty_post_thumb']=isset($error['empty_post_thumb'])?$error['empty_post_thumb']:null;
            $data['empty_post_desc']=isset($error['empty_post_desc'])?$error['empty_post_desc']:null;
            $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
            $data['empty_cat_id']=isset($error['empty_cat_id'])?$error['empty_cat_id']:null;
            $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;
          }
          $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;

          if(empty($error))
          {
            /*load wrong and prepare for add after upload click*/
            $data['post_title']=isset($post_title)?$post_title:null;
            $data['post_thumb']=isset($post_thumb)?$post_thumb:null;
            $data['post_desc']=isset($post_desc)?$post_desc:null;
            $data['slug']=isset($slug)?$slug:null;
            $data['cat_id']=isset($cat_id)?$cat_id:null;
            $data['status']=isset($status)?$status:null;
            /**/
            //  show_array($_POST);
            $destination_path=getcwd().DIRECTORY_SEPARATOR;
            $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\posts\ ").basename($_FILES['file']['name']);
            // echo $target_path;
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
            {
               //  Add
               $data1=[
                'thumb_name'=>'/posts/'.$post_thumb,
                'time'=>date('d/m/Y'),
                'user_id'=>$_SESSION['info_user_login']['id'],
              ];
               $id_img=db_insert("medias",$data1);
               $data=[
                  'post_title'=>$post_title,
                  'thumb_id'=>$id_img,
                  'post_date'=>$post_date,
                  'post_desc'=>$post_desc,
                  'slug'=>$slug,
                  'post_creating'=>$post_creating,
                  'cat_id'=>$cat_id,
                  'status'=>$status,
                  'user_id'=>$_SESSION['info_user_login']['id'],
                  'trash'=>0,
               ];
               db_insert("posts",$data);
            }
            redirect("?mod=post&controller=AdminPost&action=listPost&ok=ok");
             
          }
           load_view("AdminPostPostAdd",$data);

        }

        function deleteAction()
        {
          load("helper","redirecting");
          load_model("posts");

           $id=(int)$_GET['id'];
           $get_post_thumb=get_name_img($id);
           $destination_path=getcwd().DIRECTORY_SEPARATOR;
           $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$get_post_thumb['thumb_name'];
           if(unlink($target_path))
           {
             db_delete("posts","id=$id");
           }
        
           redirect("?mod=post&controller=AdminPost&action=listPost&ok=ok");
        }

        function editAction()
        {
          load_model("posts");
          load("helper","checkVarEmpty");
          load("helper",'stringValidation');
          load("helper","usernameValidation");
          load("helper","redirecting");
           $id=(int)$_GET['id'];
           
           $post=get_post_by_id($id);
           /*step load data*/
           $id=$post['id'];
           $post_title=$post['post_title'];
           $post_thumb_=$post['thumb_name'];
           $post_date=$post['post_date'];
           $post_desc=$post['post_desc'];
           $slug=$post['slug'];
           $post_creating=$post['post_creating'];
           $cat_id=$post['cat_id'];
           $status=$post['status'];
           $trash=$post['trash'];
           //--
           $data['id']=$id;
           $data['post_title']=$post_title;
           $data['post_thumb']=$post_thumb_;
           $data['post_date']=$post_date;
           $data['post_desc']=$post_desc;
           $data['slug']=$slug;
           $data['cat_id']=$cat_id;
           $data['status']=$status;
           /*end step load data*/

           /*case appear error because show var is null.So I had below solotion to solve this problem*/
              $data['ok']=isset($error['ok'])?$error['ok']:null;
              $data['empty_post_title']=isset($error['emtpy_post_title'])?$error['emtpy_post_title']:null;
              $data['empty_post_thumb']=isset($error['empty_post_thumb'])?$error['empty_post_thumb']:null;
              $data['empty_post_desc']=isset($error['empty_post_desc'])?$error['empty_post_desc']:null;
              $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
              $data['empty_cat_id']=isset($error['empty_cat_id'])?$error['empty_cat_id']:null;
              $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;
           /**/
           $postCats=data(get_list_postscat_notLimit(0),0);

           $data['postCats']=$postCats;
           if(isset($_POST['btn-submit']))
           {
            $data['name']=$_SESSION['info_user_login']['name'];

            $error=array();
  
            $post_title=isset($_POST['post_title'])?$_POST['post_title']:null;
            $post_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:null;
            $post_thumb_=isset($_POST['file_'])?$_POST['file_']:null;
            $post_date=date("d/m/Y");
            $post_desc=isset($_POST['post_desc'])?$_POST['post_desc']:null;
            $slug=isset($_POST['slug'])?$_POST['slug']:null;
            $post_creating=date("d/m/Y");
            $cat_id=isset($_POST['cat-id'])?$_POST['cat-id']:null;
            $status=isset($_POST['status'])?$_POST['status']:null;
            $trash=0;
  
            $postCats=data(get_list_postscat_notLimit(0),0);
  
            $data['postCats']=$postCats;
  
            if(empty($post_title))
            {
               $error['emtpy_post_title']="Tiêu đề không được để trống";
            }
            else{
                if(!stringValidation($post_title))
                {
                 $error['emtpy_post_title']="Tiêu đề không hợp lệ";
                }
            }
  
            if(empty($post_thumb_))
            {
              $error['empty_post_thumb']="Hình ảnh không được để trống";
            }
            else
            {
              /* check extention của ảnh */
               $fileImageExtension=['png','jpeg','jpg','gif'];
               if(!empty($_FILES['file']['name']))
               {
                if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
                {
                  $error['empty_post_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
                }
                /*end check extention của ảnh */
                if($_FILES['file']['size']>200000)//20.0000MB
                {
                  $error['empty_post_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
                }
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\posts\ ").basename($_FILES['file']['name']);
                if(file_exists($target_path))
                {
                   $error['empty_post_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
                }
               }
            }
  
            if(empty($post_desc))
            {
              $error['empty_post_desc']="Mô tả không được để trống";
            }
  
            if(empty($slug))
            {
              $error['empty_slug']="Slug bài viết không được để trống";
            }
            else{
               if(!usernameValidation($slug))
               {
                 $error['empty_slug']="Slug không hợp lệ,hãy thử lại";
               }
            }
  
            if(empty($cat_id))
            {
              $error['empty_cat_id']="Danh mục bài viết không được để trống,hãy chọn 1 danh mục";
            }
  
            if(empty($status))
            {
              $error['empty_status']="Trạng thái bài viết không được để trống";
            }
  
            if(!empty($error))
            {
              
              /*load wrong and prepare for add after upload click*/
              $data['post_title']=isset($post_title)?$post_title:null;
              $data['post_thumb']=isset($post_thumb)?$post_thumb:null;
              $data['post_desc']=isset($post_desc)?$post_desc:null;
              $data['slug']=isset($slug)?$slug:null;
              $data['cat_id']=isset($cat_id)?$cat_id:null;
              $data['status']=isset($status)?$status:null;
              /**/
              
              $data['empty_post_title']=isset($error['emtpy_post_title'])?$error['emtpy_post_title']:null;
              $data['empty_post_thumb']=isset($error['empty_post_thumb'])?$error['empty_post_thumb']:null;
              $data['empty_post_desc']=isset($error['empty_post_desc'])?$error['empty_post_desc']:null;
              $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
              $data['empty_cat_id']=isset($error['empty_cat_id'])?$error['empty_cat_id']:null;
              $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;
            }
            $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;
  
            if(empty($error))
            {
              /*load wrong and prepare for add after upload click*/
              $data['post_title']=isset($post_title)?$post_title:null;
              $data['post_thumb']=isset($post_thumb)?$post_thumb:null;
              $data['post_desc']=isset($post_desc)?$post_desc:null;
              $data['slug']=isset($slug)?$slug:null;
              $data['cat_id']=isset($cat_id)?$cat_id:null;
              $data['status']=isset($status)?$status:null;
              /**/
              //  show_array($_POST);
              // echo $target_path;
              if(!empty($_FILES['file']['name']))
              {
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\posts\ ").basename($_FILES['file']['name']);
                if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
                {
                  $target_path_post_thumb_old=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$post_thumb_;
                  unlink($target_path_post_thumb_old);
                  $media_id=get_idOfMedia($id)['id'];
                   //  update contain new post_thumb
                    $data1=[
                      'thumb_name'=>'/posts/'.$post_thumb,
                      'time'=>date('d/m/Y'),
                      'user_id'=>$_SESSION['info_user_login']['id'],
                    ];
                   db_update("medias",$data1,"id=$media_id");
                   $data=[
                      'post_title'=>$post_title,
                      'thumb_id'=>$media_id,
                      'post_date'=>$post_date,
                      'post_desc'=>$post_desc,
                      'slug'=>$slug,
                      'user_id'=>$_SESSION['info_user_login']['id'],
                      'post_creating'=>$post_creating,
                      'cat_id'=>$cat_id,
                      'status'=>$status,
                      'trash'=>0,
                   ];
                   db_update("posts",$data,"id=$id");
                }
              }
              else{
                 $media_id=get_idOfMedia($id)['id'];
                 $data1=[
                  'thumb_name'=>$post_thumb_,
                  'time'=>date('d/m/Y'),
                  'user_id'=>$_SESSION['info_user_login']['id'],
                ];
                 db_update("medias",$data1,"id=$media_id");
                  $data=[
                    'post_title'=>$post_title,
                    'thumb_id'=>$media_id,
                    'post_date'=>$post_date,
                    'post_desc'=>$post_desc,
                    'slug'=>$slug,
                    'post_creating'=>$post_creating,
                    'cat_id'=>$cat_id,
                    'status'=>$status,
                    'trash'=>0,
                ];
                db_update("posts",$data,"id=$id");
              }
              redirect("?mod=post&controller=AdminPost&action=listPost&ok=ok");
               
            } 
           }
           $data['post_thumb']=$post_thumb_;
           load_view("AdminPostPostEdit",$data);

        }
?>
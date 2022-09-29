<?php
    function construct() {
        //    echo "DÙng chung, load đầu tiên";
            
        }
        
        function indexAction()
        {
           
        }
        function showListPageAction()
        {
           load_model("pages");
           load("helper","pagination");
           load("helper",'checkVarEmpty');

            $error=array();

            $info=array();
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
                                db_update('pages',$data,$where);
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
                                db_update('pages',$data,$where);
                            }
                            $info['ok']='Đã khôi phục bản ghi';
                            ;
                        break;
                        case 'deletePern':
                            foreach($_POST['checkItem'] as $item)
                            {     
                                $where='id='.$item;
                                db_delete('pages',$where);
                            }
                            $info['ok']='Đã xóa bản ghi';
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

            /* pagination */
            $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
            $num_page=3;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
            $num_row=get_num_row(0);//cần
            $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

            $pagination=pagination($page,$num_page,$num_row,$num_per_page);

            $start=$pagination['start'];


            $pages=get_pages($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

            $data['num_per_page']=$num_per_page;
            $data['pag']=$pagination['page'];//Bây giờ tôi mới biết key không phân biệt s và ko có s và coi là 1

            /* end pagination*/
    
            //tìm kiếm

            if(isset($_POST['sm_s']))
            {
                $search= $_POST['s'];
                $pages=get_pages($start,$num_page,0,$search,"ORDER BY id ASC");
            }

            if(isset($_GET['status'])&&$_GET['status']=='notTrash')//nếu status trên url là .. thì..
            {
                global $data,$error;

                
                $pages=get_pages($start,$num_page,0);

                $acts=[
                    'delete'=>'Bỏ vào thùng rác',
                ];
            }
            if(isset($_GET['status'])&&$_GET['status']=='Trash'){
                global $data,$error;

                $pages=get_pages($start,$num_page,1);


                $acts=[
                    'restore'=>'khôi phục',
                    'deletePern'=>'Xóa',
                ];

               
            }
            if(isset($_GET['sts'])&&$_GET['sts']=='not_active')
            {
                global $data,$error;

                $pages=get_pages($start,$num_page,0,"","&&status = 'not_active'");

                $acts=[
                    'restore'=>'khôi phục',
                    'deletePern'=>'Xóa',
                ];

               
            }
            if(isset($_GET['sts'])&&$_GET['sts']=='active')
            {
                global $data,$error;

                $pages=get_pages($start,$num_page,0,"","&&status = 'active'");

                $acts=[
                    'restore'=>'khôi phục',
                    'deletePern'=>'Xóa',
                ];

            }

           $count_not_trash_record=get_num_row(0);
           $count_trash_record=get_num_row(1);
           $count_not_active_record=get_num_row(0,"&&status = 'not_active'");
           $count_active_record=get_num_row(0,"&&status = 'active'");

           $data['count_record']=["$count_not_trash_record","$count_trash_record","$count_not_active_record","$count_active_record"];

           $data['acts']=isset($acts)? $acts:$acts=['delete'=>'Bỏ vào thùng rác'];

           $data['pages']=$pages;

           $data['num_per_page']=$num_per_page;
           $data['pag']=$pagination['page'];

           $data['name']=$_SESSION['info_user_login']['name'];
           $data['announce']="Đã xử lý thành công";

           $data['info']=isset($_GET['info'])?"Đã xử lý thành công":null;
           $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
           $data['ok']=isset($info['ok'])?$info['ok']:null;

           load_view("AdminPageListPageShowListPage",$data);
        }

        function deleteAction()
        {
            load("helper","redirecting");

            $id=(int)$_GET['id'];
            $table='pages';
            db_delete("$table","id=$id");

            redirect("?mod=page&controller=AdminListPage&action=showListPage&status=notTrash&info=info");
        }

        function addAction()
        {
            load("helper","redirecting");
            load("helper","checkVarEmpty");
            load("helper","usernameValidation");
            load("helper","stringValidation");

            $data['name']=$_SESSION['info_user_login']['name'];
            $data['email']=$_SESSION['info_user_login']['email'];

            // show_array($_POST);
            $page_name=isset($_POST['title'])?$_POST['title']:null;
            $slug=isset($_POST['slug'])?$_POST['slug']:null;
            $page_date=date("d/m/Y");
            $content=isset($_POST['desc'])?$_POST['desc']:null;
            $user_id=$_SESSION['info_user_login']['id'];
            $status=isset($_POST['status'])?$_POST['status']:null;
            $creating_time=date("d/m/Y");
            $trash=0;

            $error=array();

            if(empty($page_name))
            {
                $error['empty_title']='Tên trang không được để trống';
            }
            else
            {
                if(!stringValidation($page_name))
                {
                    $error['empty_title']="Tiêu đề chứa các ký tự A đến Z,a đến z,0-9 dấu. ,dấu gạch dưới và dấu cách.Và độ dài từ 6-32 ký tự";
                }
            }

            if(empty($slug))
            {
                $error['empty_slug']='Slug không được để trống';
            }
            else
            {
                if(!usernameValidation($slug))
                {
                    $error['empty_slug']="Slug chứa các ký tự A đến Z,a đến z,0-9 dấu. và dấu gạch dưới.Và độ dài từ 6-32 ký tự";
                }
            }

            if(empty($content))
            {
                $error['empty_desc']='Mô tả không được để trống';
            }
            
            if(empty($status))
            {
                $error['empty_status']="Trạng thái không được để trống";
            }

            if(!empty($error))
            {
                
                $data['page_name']=isset($page_name)?$page_name:null;
                $data['slug']=isset($slug)?$slug:null;
                $data['content']=isset($content)?$content:null;
                $data['status']=isset($status)?$status:null;
            }

            $info=array();

            if(empty($error))//ko lỗi
            {
                
                $data=[
                    'page_name'=>$page_name,
                    'slug'=>$slug,
                    'page_date'=>date("d/m/Y"),
                    'content'=>$content,
                    'user_id'=>$_SESSION['info_user_login']['id'],
                    'status'=>$status,
                    'creating_time'=>date("d/m/Y"),
                    'trash'=>0,
                ];
                db_insert('pages',$data);
                $info['announce']="Đã thêm thành công";
            }

            $data['announce']=isset($info['announce'])?$info['announce']:null;

            $data['empty_title']=isset($error['empty_title'])?$error['empty_title']:null;
            $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
            $data['empty_desc']=isset($error['empty_desc'])?$error['empty_desc']:null;
            $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;

            load_view("AdminPageListPageAdd",$data);
        }

        function editAction()
        {
            load_model("pages");
            load("helper","checkVarEmpty");
            $id=isset($_GET['id'])?(int)$_GET['id']:null;
            $page=get_page_by_id($id);

            if(!empty($page))
            {
                $data['id']=$page['id'];
                $data['page_name']=$page['page_name'];
                $data['slug']=$page['slug'];
                $data['content']=$page['content'];
                $data['status']=$page['status'];

                $data['announce']=isset($info['announce'])?$info['announce']:null;
                
                $data['empty_title']=isset($error['empty_title'])?$error['empty_title']:null;
                $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
                $data['empty_desc']=isset($error['empty_desc'])?$error['empty_desc']:null;
                $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;

            }

            // ---tôi coppy AddAction here
             if(isset($_POST['btn-submit']))
             {
                 load("helper","redirecting");
                 load("helper","usernameValidation");
                 load("helper","stringValidation");
 
                 $data['name']=$_SESSION['info_user_login']['name'];
                 $data['email']=$_SESSION['info_user_login']['email'];
 
                 // show_array($_POST);
                 $page_name=isset($_POST['title'])?$_POST['title']:null;
                 $slug=isset($_POST['slug'])?$_POST['slug']:null;
                 $page_date=date("d/m/Y");
                 $content=isset($_POST['desc'])?$_POST['desc']:null;
                 $user_id=$_SESSION['info_user_login']['id'];
                 $status=isset($_POST['status'])?$_POST['status']:null;
                 $creating_time=date("d/m/Y");
                 $trash=0;
 
                 $error=array();
 
                 if(empty($page_name))
                 {
                     $error['empty_title']='Tên trang không được để trống';
                 }
                 else
                 {
                     if(!stringValidation($page_name))
                     {
                         $error['empty_title']="Tiêu đề chứa các ký tự A đến Z,a đến z,0-9 dấu. ,dấu gạch dưới và dấu cách.Và độ dài từ 6-32 ký tự";
                     }
                 }
 
                 if(empty($slug))
                 {
                     $error['empty_slug']='Slug không được để trống';
                 }
                 else
                 {
                     if(!usernameValidation($slug))
                     {
                         $error['empty_slug']="Slug chứa các ký tự A đến Z,a đến z,0-9 dấu. và dấu gạch dưới.Và độ dài từ 6-32 ký tự";
                     }
                 }
 
                 if(empty($content))
                 {
                     $error['empty_desc']='Mô tả không được để trống';
                 }
                 
                 if(empty($status))
                 {
                     $error['empty_status']="Trạng thái không được để trống";
                 }
 
                 if(!empty($error))
                 {
                     
                     $data['page_name']=isset($page_name)?$page_name:null;
                     $data['slug']=isset($slug)?$slug:null;
                     $data['content']=isset($content)?$content:null;
                     $data['status']=isset($status)?$status:null;
                 }
 
                 $info=array();
 
                 if(empty($error))//ko lỗi
                 {
                     
                     $data=[
                         'page_name'=>$page_name,
                         'slug'=>$slug,
                         'page_date'=>date("d/m/Y"),
                         'content'=>$content,
                         'user_id'=>$_SESSION['info_user_login']['id'],
                         'status'=>$status,
                         'creating_time'=>date("d/m/Y"),
                         'trash'=>0,
                     ];
                     db_update('pages',$data,"id=$id");
                     redirect("?mod=page&controller=AdminListPage&action=showListPage&status=notTrash&info=info");
                 }
 
                 $data['announce']=isset($info['announce'])?$info['announce']:null;
 
                 $data['empty_title']=isset($error['empty_title'])?$error['empty_title']:null;
                 $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
                 $data['empty_desc']=isset($error['empty_desc'])?$error['empty_desc']:null;
                 $data['empty_status']=isset($error['empty_status'])?$error['empty_status']:null;

             }
             //---kết thúc coppy AddAction here

             load_view("AdminPageListPageEdit",$data);
        }

?>
<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    
}
function indexAction()
{
    echo "OK";
}

function add_sliderAction()
{
    load("helper","checkVarEmpty");
    load("helper","usernameValidation");
    load("helper","intValidation");
    load("helper","redirecting");
    load_model("slider");

    $name= $_SESSION['info_user_login']['name'];
    $data['name']=$name;
    /*input*/
    $slider_name=isset($_POST['slider_name'])?$_POST['slider_name']:null;
    $slider_slug=isset($_POST['slider_slug'])?$_POST['slider_slug']:null;
    $slider_desc=isset($_POST['slider_desc'])?$_POST['slider_desc']:null;
    $slider_num_order=isset($_POST['slider_num_order'])?$_POST['slider_num_order']:null;
    $slider_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:null;
    $slider_status=isset($_POST['slider_status'])?$_POST['slider_status']:null;
    $slider_time=date("d/m/Y");
    $slider_trash=0;
    /**/
    if(isset($_POST['btn-submit']))
    {
        /*Checking */
        $error=array();
        if(empty($slider_name))
        {
            $error['empty_slider_name']="Tên slider không được để trống";
        }
        if(empty($slider_slug))
        {
            $error['empty_slider_slug']="Tên slider không được để trống";
        }
        else{
            if(!usernameValidation($slider_slug))
            {
                $error['empty_slider_slug']="Tên slider không hợp lệ";
            }
        }
        if(empty($slider_desc))
        {
            $error['empty_slider_desc']="Mô tả không được để trống";
        }
        if(empty($slider_num_order))
        {
            $error['empty_slider_num_order']='Trường thứ tự không được để trống';
        }
        else{
            if(!intValidation($slider_num_order))
            {
                $error['empty_slider_num_order']='Thông tin bạn nhập không đúng định dạng';
            }
            if(!check_unique_num_order($slider_num_order))
            {
                $error['empty_slider_num_order']='Thứ tự này đã tồn tại';
            }
        }
        if(empty($slider_thumb))
        {
            $error['empty_slider_thumb']='Trường ảnh không được để trống';
        }
        else{
                $fileImageExtension=['png','jpeg','jpg','gif'];
                if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
                {
                  $error['empty_slider_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
                }
                /*end check extention của ảnh */
                if($_FILES['file']['size']>200000)//200.0000MB
                {
                  $error['empty_slider_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
                }
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\sliders\ ").$_FILES['file']['name'];
                if(file_exists($target_path))
                {
                   $error['empty_slider_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
                }
        }
        if(empty($slider_status))
        {
            $error['empty_slider_status']='Trường trạng thái không được để trống';
        }
        /**/
        if(!empty($error))
        {
            $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
            $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
            $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
            $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
            $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
            $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
        }
        else{
            /*load lai data sai*/
            $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
            $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
            $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
            $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
            $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
            $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
            /**/
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
            {
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$_FILES['file']['name'];
               //  Add
               $data1=[
                'thumb_name'=>'/sliders/'.$slider_thumb,
                'time'=>date('d/m/Y'),
                'user_id'=>$_SESSION['info_user_login']['id'],
                ];
                $thumb_id=db_insert('medias',$data1);
               $data=[
                  'slider_name'=>$slider_name,
                  'slider_slug'=>$slider_slug,
                  'slider_desc'=>$slider_desc,
                  'slider_num_order'=>$slider_num_order,
                  'thumb_id'=>$thumb_id,
                  'slider_status'=>$slider_status,
                  'slider_time'=>$slider_time,
                  'user_id'=>$_SESSION['info_user_login']['id'],
                  'trash'=>0,
               ];
               db_insert("sliders",$data);
            }
            redirect("?mod=slider&controller=AdminSlider&action=show_slider&trash=notTrash&ok=ok");
        }
    }
    /*output*/
     /*load lai data sai*/
     $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
     $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
     $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
     $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
     $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
     $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
     /**/
    $data['slider_name']=$slider_name;
    $data['slider_slug']=$slider_slug;
    $data['slider_desc']=$slider_desc;
    $data['slider_num_order']=$slider_num_order;
    $data['slider_thumb']=$slider_thumb;
    $data['slider_status']=$slider_status;
    /**/
    load_view("AdminSliderAdd_slider",$data);
}

function update()
{
    // $id=(int)
}

function show_sliderAction()
{
    // show_array($_POST);
    load("helper","redirecting");
    load("helper","pagination");
    load_model("slider");
    load("helper","checkVarEmpty");

    $data['name']=$_SESSION['info_user_login']['name'];


     /* pagination */
     $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
     $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
     $num_row=get_num_row();//cần
     $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

     $pagination=pagination($page,$num_page,$num_row,$num_per_page);

     $start=$pagination['start'];


     $sliders=get_list_slider($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

     $data['num_per_page']=$num_per_page;
     $data['pag']=$pagination['page'];//Bây giờ tôi mới biết key không phân biệt s và ko có s và coi là 1

     /* end pagination*/

      //search part
      if(isset($_POST['sm_s']))
      {
        $search=$_POST['s'];
        $sliders=get_list_slider($start,$num_page,0,$search);
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
                           db_update('sliders',$data,$where);
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
                           db_update('sliders',$data,$where);
                       }
                       $info['ok']='Đã khôi phục bản ghi';
                       ;
                   break;
                   case 'deletePern':
                       foreach($_POST['checkItem'] as $item)
                       {     
                            $where='id='.$item;
                            $get_slider_thumb=get_name_img($item)['thumb_name'];
                            $destination_path=getcwd().DIRECTORY_SEPARATOR;
                            $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$get_slider_thumb;
                            if(unlink($target_path))
                            {
                                 db_delete("sliders","$where");
                            }
                       }
                       redirect("?mod=slider&controller=AdminSlider&action=show_slider&status=notTrash&ok=ok");
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
     $all=show_num_row("sliders.trash=0");
     $active=show_num_row("sliders.slider_status='active'&&trash=0");
     $not_active=show_num_row("sliders.slider_status='not_active'&&trash=0");
     $trash=show_num_row("trash=1");
     $show_record=[$all,$active,$not_active,$trash];
     //end show num of record

     $data['show_record']=$show_record;

     if(isset($_GET['status'])&&$_GET['status']=='notTrash')
     {
         $sliders=get_list_slider($start,$num_page,0);
         $actions=['delete'=>'Bỏ vào thùng rác'];
      }

      if(isset($_GET['sts'])&&$_GET['sts']=="active")
      {
        $sliders=get_list_slider($start,$num_page,0,"","&&sliders.slider_status = 'active'");
      }

      if(isset($_GET['sts'])&&$_GET['sts']=="not_active")
      {
        $sliders=get_list_slider($start,$num_page,0,"","&&sliders.slider_status = 'not_active'");
      }

      if(isset($_GET['status'])&&$_GET['status']=="Trash")
      {
         $sliders=get_list_slider($start,$num_page,1);
         $actions=['restore'=>'Khôi phục','deletePern'=>'Xóa'];
      }

  $data['actions']=isset($actions)?$actions:null;   
  $data['ok']=isset($info['ok'])?$info['ok']:null;
  $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;
  $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
  $data['num_per_page']=$num_per_page;
  $data['sliders']=$sliders;

   load_view("AdminSliderShow_slider",$data);
}

function deleteAction()
{
    load("helper","redirecting");
    load_model("slider");

     $id=(int)$_GET['id'];
     $get_slider_thumb=get_name_img($id)['thumb_name'];
     $destination_path=getcwd().DIRECTORY_SEPARATOR;
     $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$get_slider_thumb;
     if(unlink($target_path))
     {
       db_delete("sliders","id=$id");
     }
  
     redirect("?mod=slider&controller=AdminSlider&action=show_slider&ok=ok");
  }

  function editAction()
  {
    load("helper","checkVarEmpty");
    load("helper","usernameValidation");
    load("helper","intValidation");
    load("helper","redirecting");
    load_model("slider");

     $id=(int)$_GET['id'];
     $slider=get_slider_by_id($id);
     
     $slider_name=isset($_POST['slider_name'])?$_POST['slider_name']:$slider['slider_name'];
     $slider_slug=isset($_POST['slider_slug'])?$_POST['slider_slug']:$slider['slider_slug'];
     $slider_desc=isset($_POST['slider_desc'])?$_POST['slider_desc']:$slider['slider_desc'];
     $slider_num_order=isset($_POST['slider_num_order'])?$_POST['slider_num_order']:$slider['slider_num_order'];
     $slider_num_order_=isset($_POST['slider_num_order_'])?$_POST['slider_num_order_']:$slider['slider_num_order'];
     $slider_thumb=isset($_FILES['file']['name'])?$_FILES['file']['name']:$slider['thumb_name'];
     $slider_thumb_=isset($_POST['files_'])?$_POST['files_']:$slider['thumb_name'];
     $slider_status=isset($_POST['slider_status'])?$_POST['slider_status']:$slider['slider_status'];

     $data['slider_name']=$slider_name;
     $data['slider_slug']=$slider_slug;
     $data['slider_desc']=$slider_desc;
     $data['slider_num_order']=$slider_num_order;
     $data['slider_thumb']=$slider_thumb;
     $data['slider_status']=$slider_status;
 
     $data['name']= $_SESSION['info_user_login']['name'];

     $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
     $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
     $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
     $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
     $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
     $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
     if(isset($_POST['btn-submit']))
     {
       /*Checking */
       $error=array();
       if(empty($slider_name))
       {
           $error['empty_slider_name']="Tên slider không được để trống";
       }
       if(empty($slider_slug))
       {
           $error['empty_slider_slug']="Tên slider không được để trống";
       }
       else{
           if(!usernameValidation($slider_slug))
           {
               $error['empty_slider_slug']="Tên slider không hợp lệ";
           }
       }
       if(empty($slider_desc))
       {
           $error['empty_slider_desc']="Mô tả không được để trống";
       }
       if(empty($slider_num_order))
       {
           $error['empty_slider_num_order']='Trường thứ tự không được để trống';
       }
       else{
            if($slider_num_order!=$slider_num_order_)
            {
                if(!intValidation($slider_num_order))
                {
                    $error['empty_slider_num_order']='Thông tin bạn nhập không đúng định dạng';
                }
                if(!check_unique_num_order($slider_num_order))
                {
                    $error['empty_slider_num_order']='Thứ tự này đã tồn tại';
                }
            }
       }
       if(empty($slider_thumb_))
       {
           $error['empty_slider_thumb']='Trường ảnh không được để trống';
       }
       else{
            if(!empty($_File['file']['name']))
            {
                $fileImageExtension=['png','jpeg','jpg','gif'];
               if(!in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),$fileImageExtension))
               {
                 $error['empty_slider_thumb']="File ảnh không hợp lệ, hãy chọn ảnh có đuôi là png, jpeg, jpg, gif.";
               }
               /*end check extention của ảnh */
               if($_FILES['file']['size']>200000)//200.0000MB
               {
                 $error['empty_slider_thumb']="Hãy chọn file có kích thước <20.000M để tiết kiệm storage";
               }
               $destination_path=getcwd().DIRECTORY_SEPARATOR;
               $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\sliders\ ").$_FILES['file']['name'];
               if(file_exists($target_path))
               {
                  $error['empty_slider_thumb']="File đã tồn tại.Hãy chọn 1 file khác.";
               }
            }
       }
       if(empty($slider_status))
       {
           $error['empty_slider_status']='Trường trạng thái không được để trống';
       }
       /**/
        if(!empty($error))
        {
            $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
            $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
            $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
            $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
            $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
            $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
        }
        else{
            /*load lai data sai*/
            $data['empty_slider_name']=isset($error['empty_slider_name'])?$error['empty_slider_name']:null;
            $data['empty_slider_slug']=isset($error['empty_slider_slug'])?$error['empty_slider_slug']:null;
            $data['empty_slider_desc']=isset($error['empty_slider_desc'])?$error['empty_slider_desc']:null;
            $data['empty_slider_num_order']=isset($error['empty_slider_num_order'])?$error['empty_slider_num_order']:null;
            $data['empty_slider_thumb']=isset($error['empty_slider_thumb'])?$error['empty_slider_thumb']:null;
            $data['empty_slider_status']=isset($error['empty_slider_status'])?$error['empty_slider_status']:null;
            /**/
            if(!empty($_FILES['file']['name']))
            {
                $destination_path=getcwd().DIRECTORY_SEPARATOR;
                $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images\sliders\ ").basename($_FILES['file']['name']);
                if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path))
                {
                    $target_path_slider_thumb_old=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$slider_thumb_;
                    unlink($target_path_slider_thumb_old);
                    //  update
                    $data1=[
                        'thumb_name'=>'/sliders/'.$slider_thumb,
                        'time'=>date('d/m/Y'),
                        'user_id'=>$_SESSION['info_user_login']['id'],
                      ];
                    $id_media=get_media_id($id)['id'];
                    db_update("medias",$data1,"id={$id_media}");
                    $data=[
                        'slider_name'=>$slider_name,
                        'slider_slug'=>$slider_slug,
                        'slider_desc'=>$slider_desc,
                        'slider_num_order'=>$slider_num_order,
                        'thumb_id'=>$id_media,
                        'slider_status'=>$slider_status,
                        'user_id'=>$_SESSION['info_user_login']['id'],
                        'slider_time'=>date("d/m/Y"),
                        'user_id'=>$_SESSION['info_user_login']['id'],
                        'trash'=>0,
                    ];
                    db_update("sliders",$data,"id=$id");
                    redirect("?mod=slider&controller=AdminSlider&action=show_slider&page=1&status=notTrash&ok=ok");
                }
            }
            else
            {
                $data1=[
                    'thumb_name'=>$slider_thumb_,
                    'time'=>date('d/m/Y'),
                    'user_id'=>$_SESSION['info_user_login']['id'],
                  ];
                $id_media=get_media_id($id)['id'];
                db_update("medias",$data1,"id={$id_media}");
                $data=[
                    'slider_name'=>$slider_name,
                    'slider_slug'=>$slider_slug,
                    'slider_desc'=>$slider_desc,
                    'slider_num_order'=>$slider_num_order,
                    'thumb_id'=>$id_media,
                    'slider_status'=>$slider_status,
                    'slider_time'=>date("d/m/Y"),
                    'user_id'=>$_SESSION['info_user_login']['id'],
                    'trash'=>0,
                ];
                db_update("sliders",$data,"id=$id");
                redirect("?mod=slider&controller=AdminSlider&action=show_slider&page=1&status=notTrash&ok=ok");
            }
        }
     }


     load_view("AdminSliderEdit_slider",$data);
  }

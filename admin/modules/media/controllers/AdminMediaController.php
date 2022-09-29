<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    
}
function indexAction()
{
    echo "OK";
}

function show_media_listAction()
{
    load("helper","checkVarEmpty");
    load("helper","pagination");
    load("helper","redirecting");
    load_model("media");

    $data['name']=$_SESSION['info_user_login']['name'];
     /* pagination */
     $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
     $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
     $num_row=get_num_row();//cần
     $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

     $pagination=pagination($page,$num_page,$num_row,$num_per_page);

     $start=$pagination['start'];


     $medias=get_list_imgs($start,$num_page);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

     $data['num_per_page']=$num_per_page;
     $data['pag']=$pagination['page'];//Bây giờ tôi mới biết key không phân biệt s và ko có s và coi là 1

     /* end pagination*/
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
                  case 'deletePern':
                      foreach($_POST['checkItem'] as $item)
                      {     
                        $where='id='.$item;
                        $thumb_name= get_thumb_name($item)[0]['thumb_name'];

                        $destination_path=getcwd().DIRECTORY_SEPARATOR;
                        $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$thumb_name;
                        if(file_exists($target_path))
                        {
                            unlink($target_path);
                            db_delete("medias","$where");
                        }
                        else{
                            db_delete("medias","$where");
                        }
                      }
                      redirect("?mod=media&controller=AdminMedia&action=show_media_list&page=1&ok");
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
      if(isset($_POST['sm_s']))
      {
         $search=$_POST['s'];
         $medias=get_list_imgs($start,$num_page,$search);
       }
    $data['count']=get_num_row();
    $data['medias']=$medias;

    $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
    $data['ok']=isset($_GET['ok'])?"Đã thao tác thành công":null;
    $data['num_per_page']=$num_per_page;

    load_view("AdminMediaShowMedia",$data);
}

function deleteAction()
{
    load_model("media");
    load("helper","redirecting");
    load("helper","checkVarEmpty");

    $id=(int)$_GET['id'];

    $thumb_name= get_thumb_name($id)[0]['thumb_name'];

    $destination_path=getcwd().DIRECTORY_SEPARATOR;
    $target_path=$destination_path.str_replace(" ",'',"public\uploadFiles\images ").$thumb_name;
    if(file_exists($target_path))
    {
        unlink($target_path);
        db_delete("medias","id=$id");
    }
    else{
        db_delete("medias","id=$id");
    }

    redirect("?mod=media&controller=AdminMedia&action=show_media_list&page=1&ok");

}

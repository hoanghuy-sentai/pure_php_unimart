<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    
}

function indexAction()
{
    load("helper","checkVarEmpty");

    $data['anounceLoginFail']=null;
    load_view("login",$data);// open login page
}

function loginSuccessAction()
{
    // show_array($_SESSION['info_user_login']['name']);
    // echo $_SESSION['info_user_login']['name'];
    load_model("cus_order");
    load("helper","pagination");

    $data['name']=$_SESSION['info_user_login']['name'];

     /* pagination */
     $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
     $num_page=10;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
     $num_row=get_num_row();//cần
     $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

     $pagination=pagination($page,$num_page,$num_row,$num_per_page);

     $start=$pagination['start'];


     $orders=get_list_order($start,$num_page);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

     $data['num_per_page']=$num_per_page;
     $data['page']=$pagination['page'];//Bây giờ tôi mới biết key không phân biệt s và ko có s và coi là 1

     /* end pagination*/

    //search part
    if(isset($_POST['sm_s']))
    {
      $search=$_POST['s'];
      $orders=get_list_order($start,$num_page,$search);
    }
    //end search part

    /*satisifical*/
    $excecuting=count(num_status("Đang xử lý"))>0?num_status("Đang xử lý")[0]['num']:0;
    $delivering= count(num_status("Đang vận chuyển"))>0?num_status("Đang vận chuyển")[0]['num']:0;
    $finishing=count(num_status("Hoàn thành"))>0?num_status("Hoàn thành")[0]['num']:0;
    $cancering=count(num_status("Hủy"))>0?num_status("Hủy")[0]['num']:0;
    $count_status=[
        'excecuting'=>$excecuting,
        'delivering'=>$delivering,
        'finishing'=>$finishing,
        'cancering'=> $cancering,
    ];
    $data['count_status']=$count_status;
    // show_array($count_status);
    /**/

    $data['orders']=$orders;

    load_view("home",$data);
}

function OrderingDetailAction()
{
    load_model("cus_order");

    $id=(int)$_GET['id'];
    $order=get_list_cus_order_side_pro($id);
    $data['id']=$id;
    $data['order']=$order;
    load_view("AdminIndexOrderingDetail",$data);
}

function updateOderingStatusAction()
{
    load_model("product");
    load_model("cus_order");

    $status_selection=$_GET['status_selection'];
    $id_cus_order=$_GET['id_cus_order'];

    $orders=get_list_cus_order_side_pro($id_cus_order);

    if($status_selection=="finishing")
    {
        foreach($orders as $item)
        {
            foreach(get_product_by_id($item['idOfProduct']) as $vlue)
            {
                if($item['idOfProduct']==$vlue['id'])
                {   
                    $id=$vlue['id'];
                    $newQty=$vlue['product_qty']-$item['product_qty'];
                    $data=[
                        'product_qty'=>$newQty,
                    ];
                    db_update('products',$data,"id=$id");
                }
            }
        }
        $data=['status'=>"Hoàn thành"];
        db_update('cus_order',$data,"id=$id_cus_order");
        echo json_encode("update success");
    }

    if($status_selection=="excecuting")
    {
        $data=['status'=>"Đang xử lý"];
        db_update('cus_order',$data,"id=$id_cus_order");
        echo json_encode("update success");
    }

    if($status_selection=="delivering")
    {
        $data=['status'=>"Đang vận chuyển"];
        db_update('cus_order',$data,"id=$id_cus_order");
        echo json_encode("update success");
    }

    if($status_selection=="cancering")
    {
        $data=['status'=>"Hủy"];
        db_update('cus_order',$data,"id=$id_cus_order");
        echo json_encode("update success");
    }
}

function deleteAction()
{
    load("helper","redirecting");

    $id=(int)$_GET['id'];
    db_delete("cus_order","id=$id");
    redirect("?mod=home&controller=index&action=loginSuccess");
}




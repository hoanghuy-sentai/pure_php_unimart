<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    // projectmvc.vn/?mod=user&controller=index&action=add

}
function indexAction()
{
    load("helper","url");
    load_model("hoang");
    
    // $id=(int)$_GET['id'];
    // echo $id;
    /*
        pagination
     */
        $page=isset($_GET['page'])?$_GET['page']:1;
        $total=get_total_tbl_users();
        $num_page=5;//tôi muốn hiện thị 5 trang
        $num_row=ceil($total/$num_page);//trong 5 trang đó sẽ biểu thị 4 bản ghi mỗi trang
        $num_per_page=$page*$num_page-1;
        $list_users = get_list_user($num_per_page,$num_page);
        
    /*
        end pagination
     */
    $data['hoangPage']=$num_row;
    $data['hoangthongminh']=$list_users;
    $data['hoangdeptrai']='Hoang is very handsome!';
    // load('helper','format'); because it is in autoload already
    load_view("hoang",$data);
}

function addAction()
{
    echo "Đây là thêm dữ liệu";
}

function editAction()
{
    echo "edit";
}

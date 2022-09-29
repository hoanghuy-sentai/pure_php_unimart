<?php

session_start();

//Khi mà chưa đăng nhập mà truy cập vào hệ thống thì:

if(isset($_SESSION['info_user_login'])||(get_module()=='home'&&get_action()=='login'&&get_controller()=='login'))
{
    //Triệu gọi đến file xử lý thông qua request

    $request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller().'Controller.php';

    if (file_exists($request_path)) {
        require $request_path;
    } else {
        echo "Không tìm thấy:$request_path ";
    }

    $action_name = get_action().'Action';

    call_function(array('construct', $action_name));
}
else
{
    //Triệu gọi đến file xử lý thông qua request

    $request_path = MODULESPATH . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'index'.'Controller.php';

    if (file_exists($request_path)) {
        require $request_path;
    } else {
        echo "Không tìm thấy:$request_path ";
    }

    $action_name = 'index'.'Action';

    call_function(array('construct', $action_name));
}




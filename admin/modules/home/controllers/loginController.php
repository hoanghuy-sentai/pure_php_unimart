<?php

use Symfony\Component\HttpFoundation\Session\Session;
use WindowsAzure\Common\Internal\Atom\Entry;

function construct() {
//    echo "DÙng chung, load đầu tiên";
    
}

function indexAction()
{
    echo "Đây không phải là action login";
}

function loginAction()
{
    load_model("login");

    load("helper","redirecting");
    load("helper","checkVarEmpty");

    $error=array();

    $email=$_POST['email'];
    $password=$_POST['password'];

    $password=md5($password);

    if(is_login($email,$password)==true)
    {
        $_SESSION['info_user_login']=get_info_user_login($email,$password);
    }
    else
    {
        $error['loginFail']="You have missed your email or password.Try again ";
    }

    if(empty($error))
    {
        // show_array($_SESSION['info_user_login']);

        // echo get_module();

        redirect("?mod=home&controller=index&action=loginSuccess");
    }
    if(!empty($error))
    {
        // echo "OK";
        $data['anounceLoginFail']=$error['loginFail'];
        load_view("login",$data);
    }
}



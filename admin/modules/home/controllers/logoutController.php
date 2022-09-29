<?php
    function construct() {
    //    echo "DÙng chung, load đầu tiên";
        
    }
    
    function logoutAction()
    {
        load("helper","redirecting");

        unset($_SESSION['info_user_login']);

        redirect("?mod=home&controller=index&action=index");
    }
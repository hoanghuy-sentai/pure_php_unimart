<?php
    function is_login($email,$password)
    {
        if(db_num_rows("select * from users Where email='$email'  && password='$password'"))
        {
            return true;
        }
        return false;
    }
    
    function get_info_user_login($email,$password)
    {
        $result= db_fetch_row("select * from users Where email='$email'  && password='$password'");
        return $result;
    }
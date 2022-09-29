<?php
    function passwordValidation($subject)
    {
        $partten="/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if(!preg_match($partten,$subject,$matchs))
        {
            return false;
        }
        return true;
    }
?>
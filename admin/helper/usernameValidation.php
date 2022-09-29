<?php
    function usernameValidation($subject)
    {
        $partten="/^[A-Za-z0-9_\.-]{6,64}$/";
        if(!preg_match($partten,$subject,$matchs))
        {
            return false;
        }
        return true;
    }
?>
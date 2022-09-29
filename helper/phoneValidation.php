<?php
    function phoneValidation($subject)
    {
        $partten="/^[0-9]{10}$/";
        if(!preg_match($partten,$subject,$matchs))
        {
            return false;
        }
        return true;
    }
?>
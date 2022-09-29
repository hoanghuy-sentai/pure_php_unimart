<?php
    function intValidation($subject)
    {
        $partten="/^[0-9]{1,20}$/";
        if(!preg_match($partten,$subject,$matchs))
        {
            return false;
        }
        return true;
    }
?>
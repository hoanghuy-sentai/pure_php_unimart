<?php
    function emailValidation($subject)
    {
        $partten="/^[A-Za-z0-9_\.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if(!preg_match($partten,$subject,$matchs))
        {
            return false;
        }
        return true;
    }
?>
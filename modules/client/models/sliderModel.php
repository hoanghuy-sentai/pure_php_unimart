<?php
function get_sliders()
{
    $result=db_fetch_array("SELECT * FROM `sliders` INNER JOIN medias ON medias.id=sliders.thumb_id ORDER BY slider_num_order ASC;");
    return $result;
}



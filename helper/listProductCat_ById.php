<?php
    function listProductCat_ById($id,$data)
    {
        $listProductCatById=array();
        foreach($data as $item)
        {
            if($item['parent_id']==$id)
            {
                $listProductCatById[]=$item;
            }
        }
        return $listProductCatById;
    }
?>
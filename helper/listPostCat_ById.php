<?php 
 function listPostCat_ById($id,$data)
 {
     $listPostCatById=array();
     foreach($data as $item)
     {
         if($item['parent_id']==$id)
         {
             $listPostCatById[]=$item;
         }
     }
     return $listPostCatById;
 }
?>
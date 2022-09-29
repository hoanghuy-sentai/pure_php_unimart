<?php
     function data($data,$parent_id=0)
     {
             echo "<ul class='sub-menu'>";
             foreach($data as $item)
             {
                     if($item['parent_id']==$parent_id)
                     {
                             echo "<li><a href=san-pham/danh-muc-".$item['id'].".html>".$item['cat_name']."</a>";
                             $id=$item['id'];
                             data($data,$id);
                             echo "</li>";
                     }
             }
            echo "</ul>";
     }
?>
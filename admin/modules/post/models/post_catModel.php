<?php
      function get_list_postscat($start,$num_per_page,$trash,$search="")
      {
          $result=db_fetch_array("select * from post_cat  WHERE `trash`='$trash'&&`cat_name` like '%$search%' limit $start,$num_per_page");
          return $result;
      }
  
      function get_list_postscat_notLimit($trash,$search="")
      {
          $result=db_fetch_array("select * from post_cat  WHERE `trash`='$trash'&&`cat_name` like '%$search%'");
          return $result;
      }
  
      function get_num_row($trash)
      {
          $result=db_num_rows("select * from post_cat where trash='$trash'");
          return $result;
      }
  
      function get_post_cat_by_id($id)
      {
          $result=db_fetch_row("select * from post_cat where id='$id'");
          return $result;
      }
?>
<?php
		  $post_title=isset($_POST['post_title'])?$_POST['post_title']:null;
          $post_thumb=isset($_POST['post_thumb'])?$_POST['post_thumb']:null;
          $post_date=date("d/m/Y");
          $post_desc=isset($_POST['post_desc'])?$_POST['post_desc']:null;
          $slug=isset($_POST['slug'])?$_POST['slug']:null;
          $post_creating=date("d/m/Y");
          $cat_id=isset($_POST['cat_id'])?$_POST['cat_id']:null;
          $status=isset($_POST['status'])?$_POST['status']:null;
          $trash=0;
		  
		  if(!empty($error))
		  {
			 $data['empty_post_title']=isset($error['emtpy_post_title'])?$error['emtpy_post_title']:null;
			 $data['empty_post_thumb']=isset($error['empty_post_thumb'])?$error['empty_post_thumb']:null;
			 $data['empty_post_desc']=isset($error['empty_post_desc'])?$error['empty_post_desc']:null;
			 $data['empty_slug']=isset($error['empty_slug'])?$error['empty_slug']:null;
		  }
?>
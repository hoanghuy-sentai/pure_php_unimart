<?php
     function construct()
     {
 
     }
     function postDetailAction()
     {
        load("helper","postCategories");
        load_model("post");
        load_model("post_cat");

        $id=(int)$_GET['id'];
        // echo $id;
        $post=get_post_detail($id);

        $postCats=get_postsCat();

        $data['postCats']=$postCats;
        $data['post']=$post;

        load_view("ClientPostDetailPostByCatId",$data);
     }
?>
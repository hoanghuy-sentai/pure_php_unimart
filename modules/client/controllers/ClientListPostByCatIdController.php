<?php
    function construct()
    {

    }
    function listPostByCatIdAction()
    {

        load("helper","postCategories");
        load_model("post_cat");
        load("helper","listPostCat_ById");
        load_model("post");
        load("helper","list_post_of_id_of_cat");
        load("helper","pagination");

        $id= isset($_GET['id'])?(int)$_GET['id']:null;
        $data['id']=$id;


        if(isset($id)||$id==null)
        {
             /*Hiển thị mỗi danh mục 1 bài viết*/
            //$posts=get_list_posts_one_postCat_show_one_record();
            /**/
            /* pagination*/
            $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
            $num_page=8;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
            $num_row=get_num_row2();//cần
            $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang
        
            $pagination=pagination($page,$num_page,$num_row,$num_per_page);
        
            $start=$pagination['start'];
        
        
            $posts=get_list_posts_one_postCat_show_one_record($start,$num_page,"");//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại
        
            $data['num_per_page']=$num_per_page;
            $data['page']=$pagination['page'];
            /*  end pagination */

            $data['posts']=$posts;
        }

        if(isset($id)&&$id!=null)
        {
            $postCats=get_postsCat();
            $posts=get_list_posts();
            $listPostCat_ById=listPostCat_ById($id,$postCats);
    
            $posts2=list_post_of_id_of_cat($listPostCat_ById,$posts,$id);
            $get_ids=array();
            if(count($posts2)>0){
                foreach($posts2 as $item)
                {
                    $get_ids[]=$item['id'];
                }
                $list_id= implode(',',$get_ids);
                $where="&&posts.id IN($list_id)";
                $where2="posts.id IN($list_id)";
            }
            else{
                $where="&&posts.cat_id=$id";
                $where2="posts.cat_id=$id";
            }
           /* pagination*/
           $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
           $num_page=8;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
           $num_row=get_num_row($where2);//cần
           $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang
    
           $pagination=pagination($page,$num_page,$num_row,$num_per_page);
    
           $start=$pagination['start'];
    
    
           $posts=get_list_post($start,$num_page,"",$where);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại
    
           $data['num_per_page']=$num_per_page;
           $data['page']=$pagination['page'];
           /*  end pagination */
           $data['posts']=$posts;
        }

       
       

        $postCats=get_postsCat();

        $data['postCats']=$postCats;



        // $data['id']=$id;

        load_view("ClientPostListPostByCatId",$data);;
    }
?>
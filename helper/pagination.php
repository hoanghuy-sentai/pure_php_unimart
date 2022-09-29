<?php
     function pagination($page,$num_page,$num_row,$num_per_page)
     {
         $page=$page;
         $num_page=$num_page;
         $num_row=$num_row;
         $num_per_page=$num_per_page;

         $num_per_page=ceil($num_row/$num_page);//tính số dòng hiện thị trong 1trang
         $start=($page*$num_page)-$num_page;//lấy điểm bắt đầu hiện tại

         if(isset($_GET['next'])&&$_GET['page']<=$num_per_page)
         {
             $page=$page+1;
             $next=($page*$num_page)-$num_page;
             $start=$next;
         }
         if(isset($_GET['pre'])&&$_GET['page']>1)
         {
             $page=$page-1;
             $pre=($page*$num_page)-$num_page;
             $start=$pre;
         }

         $result=array();
         $result=[
            'start'=>$start,
            'page'=>$page,
         ];

         return $result;
       }
?>
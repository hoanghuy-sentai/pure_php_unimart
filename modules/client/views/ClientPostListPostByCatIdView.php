<?php
get_header();
?>

<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="bai-viet.html" title="">Blog</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Danh sách bài viết</h3>
                </div>
                <div class="section-detail">
                    <?php 
                    if(count($posts)>0)
                    {
                    ?>
                    <ul class="list-item">    
                        <?php 
                        foreach($posts as $post)
                        {
                        ?>     
                        <li class="clearfix">
                            <a href="bai-viet/chi-tiet-bai-viet-<?php echo $post['id'] ?>.html" title="" class="thumb fl-left">
                                <img src=<?php echo base_url("admin/public/uploadFiles/images").$post['thumb_name']  ?> alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="bai-viet/chi-tiet-bai-viet-<?php echo $post['id'] ?>.html" title="" class="title"><?php echo $post['post_title'] ?></a>
                                <span class="create-date"><?php echo $post['post_creating'] ?></span>
                                <p class="desc"><?php echo strlen($post['post_desc'])>340?substr($post['post_desc'],0,340)."...":$post['post_desc'] ?> </p>
                            </div>
                        </li>
                        <?php
                        }
                         ?>
                    </ul>
                    <?php 
                    }else echo "<p>Không có bài viết nào</p>";
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                <?php 
                    if(count($posts)>0)
                    {
                    ?>
                    <ul class="list-item clearfix">
                                <!-- <li>
                                    <a href="?mod=client&controller=ClientListProductByCatId&action=listProductByCatId&pre=pre&page=<?php echo $page ?>&id=1" title=""><</a>
                                </li> -->
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="bai-viet/chi-tiet-bv-<?php echo $i ?>-<?php echo $id ?>.html" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                <!-- <li>
                                        <a href="?mod=client&controller=ClientListProductByCatId&action=listProductByCatId&next=next&page=<?php echo $page ?>&id=1" title="">></a>
                                </li>    -->
                         </ul>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục bài viết</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                       <?php data($postCats,0) ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
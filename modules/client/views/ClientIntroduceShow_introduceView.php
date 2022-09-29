<?php
    get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="">Giới thiệu</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $page['page_name'] ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo $page['page_date'] ?></span>
                    <div class="detail">
                       <?php echo $page['content'] ?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                <?php if(count($mostSaling)>0){ ?>
                    <ul class="list-item">
                        <?php 
                        foreach($mostSaling as $product)
                        {
                        ?>
                        <li class="clearfix">
                            <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $product['id'] ?>" title="" class="thumb fl-left">
                                <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $product['id'] ?>" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product['product_price'],"đ") ?></span>
                                    <span class="old"><?php echo currency_format($product['product_price']+1200000,"đ") ?></span>
                                </div>
                                <a href="?mod=client&controller=ClientCart&action=buy_now&id=<?php echo $product['id'] ?>" title="Mua ngay" class="buy-now fl-right" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                    <?php } 
                    ?>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
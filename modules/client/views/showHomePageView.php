<?php
    get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php 
                    foreach($sliders as $slider)
                    {
                    ?>
                    <div class="item">
                        <img src="<?php echo base_url("admin/public/uploadFiles/images").$slider['thumb_name']  ?>" alt="">
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php 
                        foreach($featureProducts as $featureProduct)
                        {
                        ?>
                        <li>
                            <a href="san-pham/chi-tiet-sp-<?php echo $featureProduct['id'] ?>.html" title="" class="thumb">
                                <img src="<?php echo base_url("admin/public/uploadFiles/images").$featureProduct['thumb_name']  ?>">
                            </a>
                            <a href="san-pham/chi-tiet-sp-<?php echo $featureProduct['id'] ?>.html" title="" class="product-name"><?php echo $featureProduct['product_name']  ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($featureProduct['product_price'],"đ")  ?></span>
                                <span class="old"><?php echo currency_format($featureProduct['product_price']+1000000,"đ")  ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $featureProduct['id'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?mod=client&controller=ClientCart&action=buy_now&id=<?php echo $featureProduct['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                        }
                         ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php 
                        foreach($phone_products as $product)
                        {
                        ?>
                        <li>
                            <a href="san-pham/chi-tiet-sp-<?php echo $product['id'] ?>.html" title="" class="thumb">
                            <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>">
                            </a>
                            <a href="san-pham/chi-tiet-sp-<?php echo $product['id'] ?>.html" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($product['product_price'],"đ") ?></span>
                                <span class="old"><?php echo currency_format($product['product_price']+1200000,"đ") ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $product['id'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?mod=client&controller=ClientCart&action=buy_now&id=<?php echo $product['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php 
                        foreach($laptop_products as $product)
                        {
                        ?>
                        <li>
                            <a href="san-pham/chi-tiet-sp-<?php echo $product['id'] ?>.html" title="" class="thumb">
                            <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>">
                            </a>
                            <a href="san-pham/chi-tiet-sp-<?php echo $product['id'] ?>.html" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($product['product_price'],"đ") ?></span>
                                <span class="old"><?php echo currency_format($product['product_price']+1200000,"đ") ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $product['id'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?mod=client&controller=ClientCart&action=buy_now&id=<?php echo $product['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                   <ul class="list-item">
                    <?php  data($productsCat);  ?>
                   </ul>
                </div>
            </div>
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
                            <a href="san-pham/chi-tiet-sp-<?php echo $product['id'] ?>.html" title="" class="thumb fl-left">
                                <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="san-pham/chi-tiet-sp-<?php echo $product['id']?>.html" title="" class="product-name"><?php echo $product['product_name'] ?></a>
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
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    get_footer();
?>
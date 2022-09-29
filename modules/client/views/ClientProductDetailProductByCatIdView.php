<?php
    get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="san-pham.html" title=""><?php echo $break_cump['dad_cat_name'] ?></a>
                    </li>
                    <li>
                        <a href="#" title=""><?php echo $break_cump['destination'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>">
                        </a>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                     <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['product_name'] ?></h3>
                        <div class="desc">
                        <textarea readonly id="desc"><?php echo $product['product_short_desc'] ?></textarea>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php echo $product['product_qty']>0?'Còn hàng':'Sản phẩm tạm dừng kinh doanh.' ?></span>
                        </div>
                        <p class="price"><?php echo currency_format($product['product_price'],'đ') ?></p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" readonly  data_url="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $product['id'] ?>" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $product['id'] ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail product-content">
                     <?php echo $product['product_detail_desc'] ?>
                     <a class="extend-content" style="cursor:pointer">Xem thêm <span>↓</span></a>
                     <a class="collapse-content" style="cursor:pointer">Thu gọn <span>↑</span></a>
                     <div class="opacity"></div>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <?php 
                if(count($theSamCategoryProducts)>0)
                {
                ?>
                <div class="section-detail">
                    <ul class="list-item">   
                        <?php 
                        foreach($theSamCategoryProducts as $item)
                        {
                        ?> 
                       <li>
                            <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="thumb">
                            <img src="<?php echo base_url("admin/public/uploadFiles/images").$item['thumb_name']  ?>">
                            </a>
                            <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['product_price'],"đ") ?></span>
                                <span class="old"><?php echo currency_format($item['product_price']+1200000,"đ") ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
                <?php 
                }
                else echo "<p>Không có sản phẩm nào cùng danh mục.</p>";
                ?>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                  <ul class="list-item">
                    <?php  data($productsCats);  ?>
                   </ul>
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
<?php
    get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=client&controller=index&action=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php 
            foreach($products as $key=>$val)
            {
            ?>
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $key ?></h3>
                    <div class="filter-wp fl-right">   
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">   
                        <?php 
                        foreach($val as $product)
                        {
                        ?>                 
                            <li>
                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php  echo $product['id'] ?>" title="" class="thumb">
                                <img src="<?php echo base_url("admin/public/uploadFiles/images").$product['thumb_name']  ?>">
                                </a>
                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $product['id'] ?>" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product['product_price'],"đ") ?></span>
                                    <span class="old"><?php echo currency_format($product['product_price']+1200000,"đ") ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?mod=client&controller=ClientCart&action=add_cart&id=<?php echo $product['id'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php 
            }
            ?>

            <div class="section" id="paging-wp">
                <div class="section-detail">           
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
                        <?php data($product_cat) ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
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
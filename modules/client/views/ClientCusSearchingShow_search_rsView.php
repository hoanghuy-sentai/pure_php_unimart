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
                        <a href="#" title="">Lọc</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Các sản phẩm tìm kiếm</h3>
                    <div class="filter-wp fl-right">
                        <?php  if(count($products)>0){  ?>
                        <p class="desc">Hiển thị <?php echo count($products) ?> trên <?php echo $total_record ?> sản phẩm</p>
                        <?php } ?>
                        <div class="form-filter">
                            <?php 
                            if(count($products)>0)
                            {
                            ?>
                            <form method="POST" action="?mod=client&controller=ClientCusSearching&action=show_search_rs&s=<?php echo $key_word ?>">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit" id="filter" name="filter">Lọc</button>
                            </form>
                            <?php
                            }
                             ?>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php
                    if (count($products) > 0) {
                    ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($products as $product) {
                            ?>
                                <li>
                                    <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $product['id'] ?>" title="" class="thumb">
                                        <img src="<?php echo base_url("admin/public/uploadFiles/images") . $product['thumb_name']  ?>">
                                    </a>
                                    <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $product['id'] ?>" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['product_price'], "đ") ?></span>
                                        <span class="old"><?php echo currency_format($product['product_price'] + 1200000, "đ") ?></span>
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
                    <?php
                    } else  echo "<p>Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của quý khách.Ấn vào <a href='?mod=client&controller=index&action=index'>đây</a>để trở về trang chủ.</p>";
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                <?php 
                    if(count($products)>0)
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
                                        <a href="?mod=client&controller=ClientCusSearching&action=show_search_rs&page=<?php echo $i ?>&s=<?php echo $key_word ?>" title=""><?php echo $i ?></a>
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
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                         <?php data($productsCats,0) ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="filter-product-wp">
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
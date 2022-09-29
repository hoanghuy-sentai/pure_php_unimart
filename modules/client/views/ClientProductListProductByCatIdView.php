<?php
    get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="<?php echo $name_product_cat[0]['cat_name'] ?>"><?php echo $name_product_cat[0]['cat_name'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $name_product_cat[0]['cat_name'] ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($products) ?> sản phẩm trên tổng số <?php echo $count_product ?> sản phẩm.</p>
                        <div class="form-filter">
                            <form method="POST" action="sap-xep-<?php echo $id ?>.html">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit" id="filter" name="filter">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php 
                        if(count($products)>0)
                        {
                    ?>
                    <ul class="list-item clearfix">     
                        <?php
                        foreach($products as $product)
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
                    <?php 
                        }
                        else  echo "<p>Không có sản phẩm nào.</p>";
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
                                        <a href="sp/danh-muc-<?php echo $i ?>-<?php echo $id ?>.html" title=""><?php echo $i ?></a>
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
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="loc-gia-<?php echo $id ?>.html">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input onchange='this.form.submit();' id="under500t" type="radio" value="r-price-under500t" name="r-price"></td>
                                    <td><label for="under500t">Dưới 500.000đ</label> </td>
                                </tr>
                                <tr>
                                    <td><input onchange='this.form.submit();' id="between500t-1m" type="radio" value="r-price-between500t-1m" name="r-price"></td>
                                    <td><label for="between500t-1m">500.000đ - 1.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input onchange='this.form.submit();' id="between1m-5m" type="radio" value="r-price-between1m-5m" name="r-price"></td>
                                    <td><label for="between1m-5m">1.000.000đ - 5.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input onchange='this.form.submit();'  id='between5m-10m' type="radio" value="r-price-between5m-10m" name="r-price"></td>
                                    <td><label for="between5m-10m">5.000.000đ - 10.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input onchange='this.form.submit();' id="below10m" type="radio" name="r-price-below10m"></td>
                                    <td><label for="below10m">Trên 10.000.000đ</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
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
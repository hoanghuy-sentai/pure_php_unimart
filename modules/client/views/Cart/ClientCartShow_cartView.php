<?php
    get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=client&controller=index&action=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php 
                if(isset($_SESSION['cart'])&&count($_SESSION['cart'])>0)
                {
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($_SESSION['cart']['products'] as $item)
                        {
                        ?>
                        <tr>
                            <td><?php echo $item['product_code'] ?></td>
                            <td>
                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="thumb">
                                    <img src="<?php echo base_url("admin/public/uploadFiles/images").$item['thumb_name']  ?>">
                                </a>
                            </td>
                            <td>
                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="name-product"><?php echo $item['product_name'] ?></a>
                            </td>
                            <td><?php echo currency_format($item['product_price'],"đ") ?></td>
                            <td>
                                <input type="number" min="1" name="num-order" value="<?php echo $item['product_qty'] ?>" data-id="<?php echo $item['id'] ?>" data-price=<?php echo $item['product_price'] ?> data-url="?mod=client&controller=ClientCart&action=update_cart_by_ajax" class="num-order">
                            </td>
                            <td><span id="sub_total_of_<?php echo $item['id'] ?>" ><?php echo currency_format($item['sub_total'],'đ') ?></span></td>
                            <td>
                                <a href="?mod=client&controller=ClientCart&action=delete_cart&id=<?php echo $item['id'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span id='total'><?php echo currency_format($_SESSION['cart']['statistical']['total'],"Đ") ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                        <a href="?mod=client&controller=ClientPayment&action=show_payment_page" title="Delete this item" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php
                } else echo "<p>Không có sản phẩm nào trong giỏ hàng.</p>";
                ?>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <?php 
                 if(isset($_SESSION['cart'])&&count($_SESSION['cart'])>0)
                {
                ?>
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?mod=client&controller=ClientCart&action=continueToBuy" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=client&controller=ClientCart&action=delete_all_cart" title="" id="delete-cart">Xóa giỏ hàng</a>
                <?php 
                } 
                ?>
            </div>
        </div>
    </div>
</div>
<?php 
    get_footer();
?>

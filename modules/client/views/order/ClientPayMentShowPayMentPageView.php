<?php
    get_header();
?>
<div id="main-content-wp" class="checkout-page sig">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=client&controller=index&action=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
    <?php if(isset($_SESSION['cart']['products'])){ ?>
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="?mod=client&controller=ClientPayment&action=execute" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" value="<?php echo $cus_name  ?>" name="cus_name" id="fullname">
                            <p><?php echo checkVarEmpty($empty_cus_name) ?></p>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" value="<?php echo $cus_email ?>" name="cus_email" id="email">
                            <p><?php echo checkVarEmpty($empty_cus_email) ?></p>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input value="<?php echo $cus_add  ?>" type="text" name="cus_add" id="address">
                            <?php echo checkVarEmpty($empty_cus_add) ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" value="<?php echo $cus_phone ?>" name="cus_phone" id="phone">
                            <p><?php echo checkVarEmpty($empty_cus_phone) ?></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="cus_note"><?php echo $cus_note ?></textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($_SESSION['cart']['products'] as $item)
                        {
                        ?>
                        <tr class="cart-item">
                            <td class="product-name"><?php echo $item['product_name'] ?><strong class="product-quantity">x <?php echo $item['product_qty'] ?></strong></td>
                            <td class="product-total"><?php echo currency_format($item['sub_total']) ?></td>
                        </tr>
                        <?php
                        }
                         ?>
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price"><?php echo currency_format($_SESSION['cart']['statistical']['total']) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" <?php echo $payMethod=='direct-payment'?"checked":'' ?> name="payMethod" value="Thanh toán tại cửa hàng">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" <?php echo $payMethod=='payment-home'?"checked":'' ?> id="payment-home" name="payMethod" value="Vận chuyển">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                    <?php echo checkVarEmpty($empty_payMethod) ?>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" name="order_now" id="order-now" value="Đặt hàng">
                </div>
            </div>
            </form>
        </div>
        <?php } ?>
    </div>
</div>
<!DOCTYPE html>
<html>
    <head>
        <title>ISMART STORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo  base_url() ?>" ></base>
        <link href="<?php echo base_url("public/css/bootstrap/bootstrap-theme.min.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/css/bootstrap/bootstrap.min.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/reset.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/css/carousel/owl.carousel.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/css/carousel/owl.theme.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/css/font-awesome/css/font-awesome.min.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/style.css") ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo base_url("public/responsive.css") ?> rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src=<?php echo base_url("public/js/jquery-2.2.4.min.js") ?> type="text/javascript"></script>
        <script src=<?php echo base_url("public/js/elevatezoom-master/jquery.elevatezoom.js") ?> type="text/javascript"></script>
        <script src=<?php echo base_url("public/js/bootstrap/bootstrap.min.js") ?> type="text/javascript"></script>
        <script src=<?php echo base_url("public/js/carousel/owl.carousel.js") ?> type="text/javascript"></script>
        <script src=<?php echo base_url("public/js/main.js") ?> type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="trang-chu.html" title="Trang chủ">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="san-pham.html" title="Sản phẩm">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="blog.html" title="blog">Blog</a>
                                    </li>
                                    <li>
                                        <a href="gioi-thieu-1.html" title="Giới thiệu">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="lien-he-2.html" title="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="trang-chu.html" title="" id="logo" class="fl-left"><img src="public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <!-- ?mod=client&controller=ClientCusSearching&action=show_search_rs" -->
                                <form method="POST" action="tim-kiem.html">
                                    <input type="text" name="s" value="<?php echo isset($key_word)?$key_word:null ?>" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"><?php isset($_SESSION['cart']['products'])?count($_SESSION['cart']['products']):0 ?></span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num">
                                            <?php 
                                                if(isset($_SESSION['cart']['products'])&&count($_SESSION['cart']['products'])>0)
                                                {
                                                    echo count($_SESSION['cart']['products']);
                                                }
                                                else
                                                    echo "0";
                                            ?>
                                        </span>
                                    </div>
                                    <?php 
                                    if(isset($_SESSION['cart']['products'])&&count($_SESSION['cart']['products'])>0)
                                    {
                                    ?>
                                    <div id="dropdown">
                                        <p class="desc">Có <span><?php //echo count($_SESSION['cart']) ?> sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php 
                                             foreach($_SESSION['cart']['products'] as $item)
                                             {
                                            ?>
                                            <li class="clearfix">
                                                <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="thumb fl-left">
                                                <img src="<?php echo base_url("admin/public/uploadFiles/images").$item['thumb_name']  ?>">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="?mod=client&controller=ClientProductDetail&action=listProductByCatId&id=<?php echo $item['id'] ?>" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                                    <p class="price"><?php echo currency_format($item['product_price'],"đ") ?></p>
                                                    <p class="qty">Số lượng: <span><?php echo $item['product_qty'] ?></span></p>
                                                </div>
                                            </li>
                                            <?php 
                                             }
                                            ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php echo currency_format($_SESSION['cart']['statistical']['total'],"Đ") ?></p>
                                        </div>
                                        <dic class="action-cart clearfix">
                                            <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
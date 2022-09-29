<?php
    get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <style>
            .card{
                margin: 0px auto;
            }
            .card {
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                width: 40%;
                }

            .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
                }

            .container {
                padding: 2px 16px;
                }
            .card .container .card-header{
                padding: 15px 0px 0px 0px;
            }
            .card .container .card-header h1{
                text-align: center;
                font-size: 20px;
            }
            .card .container .card-body p{
                margin: 25px 0 20px 0px;
            }
            .card .container .card-body{
                padding:0px 0px 18px 0px;
            }
            .card .container .sub-info{
                width: 100%;
                background-color:#eaf2fd ;
            }
            .card .container .sub-info ul{
                list-style: none;
            }
        </style>
        <div id='card' class="card">
            <div class="container">
                <div class="card-header">
                    <h1><b><i class="fa-solid fa-check"></i>ĐẶT HÀNG THÀNH CÔNG</b></h1> 
                </div>
                <div class="card-body">
                    <p>Cảm ơn bạn <b> <?php echo $info['cus_name'] ?></b> đã đặt hàng tại hệ thống Unimart.</p> 
                    <div class="sub-info">
                        <p>Đơn hàng: <?php echo $info['cus_order_code'] ?></p>
                        <ul>
                            <li><b>Người nhận hàng: </b><?php echo $info['cus_name'] ?>,<?php echo $info['cus_phone'] ?></li>
                            <li><b>Giao đến: </b><?php echo $info['cus_add'] ?></li>
                            <li><b>Tổng tiền: </b><?php echo currency_format($info['total'],"đ") ?></li>
                        </ul>
                    </div>
                    <span>Bạn hãy ấn vào <a href="?mod=client&controller=index&action=index" title="back">đây</a>để quay trở lại trang chủ.</span>
                </div>
            </div>
        </div>
    </div>
</div>
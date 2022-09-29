<?php 
	get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix"> 
                        <form method="POST" action="?mod=home&controller=index&action=loginSuccess&page=1" class="form-s fl-right">
                            <input placeholder="Nhập tên KH cần tìm" type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>  
                    </div>
                    <div class="actions">
                        <style>
                            .box{
                                width: 20%;
                                display: inline-block;
                                margin: 2px 0px 2px 0px;
                                border-radius: 25px;
                            }
                            .box.box1{
                                background-color:red;
                            }
                            .box.box2{
                                background-color: yellow;
                            }
                            .box.box3{
                                background-color: green;
                            }
                            .box.box4{
                                background-color:blue;
                            }
                            .box .box-header{
                                text-align: center;
                                color: white;
                                border-bottom: 1px solid white;
                                border-radius: 25px;
                                height: 20px;
                            }
                            .box .box-body{
                                text-align: center;
                                color:white;
                                height: 40px;
                                padding: 8px 0px 0px 0px;
                            }
                        </style>
                        <div class="box box1">
                            <div class="box-header">
                                <h3>Đơn hàng hủy</h3>
                            </div>
                            <div class="box-body">
                                <p><?php echo $count_status['cancering'] ?></p>
                            </div>
                        </div>
                        <div class="box box2">
                            <div class="box-header">
                                <h3>Hoàn thành</h3>
                            </div>
                            <div class="box-body">
                                <p><?php echo $count_status['finishing'] ?></p>
                            </div>
                        </div>
                        <div class="box box3">
                            <div class="box-header">
                                <h3>Đang vận chuyển</h3>
                            </div>
                            <div class="box-body">
                                <p><?php echo $count_status['delivering'] ?></p>
                            </div>
                        </div>
                        <div class="box box4">
                            <div class="box-header">
                                <h3>Đang xử lý</h3>
                            </div>
                            <div class="box-body">
                                <p><?php echo $count_status['excecuting'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        // show_array($orders) 
                    ?>
                    <?php 
                    if(count($orders)>0)
                    {
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">Tên KH</span></td>
                                    <td><span class="thead-text">Mã đơn</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Ghi chú</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Tổng tiền</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($orders as $order)
                                {
                                ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $order["cus_name"] ?></span>
                                    <td><span class="tbody-text"><?php echo $order["cus_order_code"] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order["cus_email"] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order["cus_add"] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order["cus_phone"] ?></span></td>
                                    <td>
                                        <span class="tbody-text" onclick="return alert('<?php echo $order['cus_note'] ?>')">
                                          <?php echo strlen($order["cus_note"])<10?$order["cus_note"]:"..." ?>
                                        </span>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $order["status"] ?></span></td>
                                    <td><span class="tbody-text"><?php echo currency_format($order["cus_total"],"đ") ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order["date"]   ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=home&controller=index&action=OrderingDetail&id=<?php echo $order["id"]  ?>  " title="Chi tiết đơn hàng" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa đơn hàng không?')" href="?mod=home&controller=index&action=delete&id=<?php echo $order["id"]  ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>      
                        </table>
                    </div>
                <?php
                }else echo "<p>Không tồn tại bản ghi nào.</p>"; 
                ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                         <ul id="list-paging" class="fl-right">
                                <li>
                                    <a href="?mod=home&controller=index&action=loginSuccess&pre=pre&page=<?php echo $page ?>" title=""><</a>
                                </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=home&controller=index&action=loginSuccess&page=<?php echo $i ?>" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                <li>
                                    <a href="?mod=home&controller=index&action=loginSuccess&next=next&page=<?php echo $page ?>" title="">></a>
                                </li>   
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	get_footer();
?>
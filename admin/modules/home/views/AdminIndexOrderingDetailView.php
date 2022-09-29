<?php
    get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chi tiết đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions" id="status_selection" data-id=<?php echo $id ?> data-url="?mod=home&controller=index&action=updateOderingStatus" >
                                <option value="excecuting">Đang xử lý</option>
                                <option value="delivering">Đang vận chuyển</option>
                                <option value="finishing">Hoàn thành</option>
                                <option value="cancering">Hủy</option>
                            </select>
                            <!-- <input type="submit" name="sm_action" value="Áp dụng"> -->
                        </form>
                    </div>
                    <div class="table-responsive">
                        <?php
                        if(count($order)>0)
                        { 
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Tổng tạm</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($order as $item)
                                {
                                ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $item['product_code'] ?></h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <a target="_blank" href="<?php echo 'public/uploadFiles/images'.$item['thumb_name'] ?>"><img src="<?php echo 'public/uploadFiles/images'.$item['thumb_name'] ?>" alt=""></a>  
                                        </div>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['product_name'] ?></span>
                                    <td><span class="tbody-text"><?php echo currency_format($item['product_price'],"đ") ?></span></td>
                                    <td><span class="tbody-text"><span> <?php echo $item['product_qty'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo currency_format($item['sub_total'],"đ") ?></span></td>
                                </tr> 
                                <?php 
                                }
                                ?>                                                                                            
                            </tbody>
                            <tfoot> 
                            </tfoot>
                        </table>
                    <?php 
                    }else echo "<p>Không tồn tại bản ghi nào</p>";
                    ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    
                </div>
            </div>
        </div>
    </div>
</div>
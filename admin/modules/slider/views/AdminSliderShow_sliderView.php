<?php
    get_header();
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=slider&controller=AdminSlider&action=add_slider" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=slider&controller=AdminSlider&action=show_slider&page=1&status=notTrash">Tất cả <span class="count">(<?php echo $show_record[0] ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=slider&controller=AdminSlider&action=show_slider&page=1&sts=active&status=notTrash">Đã đăng <span class="count">(<?php echo $show_record[1] ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=slider&controller=AdminSlider&action=show_slider&page=1&sts=not_active&status=notTrash">Chờ xét duyệt<span class="count">(<?php echo $show_record[2] ?>)</span></a></li>
                            <li class="pending"><a href="?mod=slider&controller=AdminSlider&action=show_slider&page=1&status=Trash">Thùng rác<span class="count">(<?php echo $show_record[3] ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" placeholder="Nhập tên slider cần tìm" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=slider&controller=AdminSlider&action=show_slider&page=1&status=notTrash" class="form-actions">
                            <select name="actions">
                                <option value="choose">Tác vụ</option>
                                <?php 
                                foreach($actions as $k=>$v)
                                {
                                ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($wrong_task) ?></div>
                    <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok) ?></div>
                    <div class="table-responsive">
                        <?php 
                            if(count($sliders)>0){
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Link</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($sliders as $slider)
                                    {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[<?php echo $slider['id'] ?>]" value="<?php echo $slider['id'] ?>" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $slider['slider_name'] ?></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <a target="_blank" href="<?php echo base_url("public/uploadFiles/images/").$slider['thumb_name']?>"><img src="<?php echo base_url("public/uploadFiles/images").$slider['thumb_name']?>" alt=""></a> 
                                        </div>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $slider['slider_slug'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $slider['slider_num_order'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $slider['slider_status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $slider['slider_time'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $slider['name'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">www.facebook.com</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=slider&controller=AdminSlider&action=edit&trash=notTrash&id=<?php echo $slider['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa không?')" href="?mod=slider&controller=AdminSlider&action=delete&trash=notTrash&id=<?php echo $slider['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                ?>      
                            </tbody>
                           
                        </table>
                      </form> 
                        <?php
                            }else echo "<p>Không có bản ghi nào.</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                            <ul id="list-paging" class="fl-right">
                                    <li>
                                        <a href="?mod=slider&controller=AdminSlider&action=show_slider&trash=notTrash&pre=pre&page=<?php echo $pag ?>&status=notTrash" title=""><</a>
                                    </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=slider&controller=AdminSlider&action=show_slider&trash=notTrash&page=<?php echo $i ?>&status=notTrash" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                    <li>
                                        <a href="?mod=slider&controller=AdminSlider&action=show_slider&trash=notTrash&next=next&page=<?php echo $pag ?>&status=notTrash" title="">></a>
                                    </li>   
                            </ul>
                </div>
            </div>
        </div>
    </div>
</div>
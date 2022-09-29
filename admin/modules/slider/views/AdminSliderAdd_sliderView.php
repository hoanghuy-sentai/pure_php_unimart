<?php
    get_header();
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên slider</label>
                        <input type="text" value="<?php echo $slider_name ?>" name="slider_name" id="title">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_name) ?></div>

                        <label for="title">Link</label>
                        <input type="text" value="<?php echo $slider_slug ?>" name="slider_slug" id="slug">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_slug) ?></div>

                        <label for="desc">Mô tả</label>
                        <textarea name="slider_desc" id="desc" class="ckeditor"><?php echo $slider_desc ?></textarea>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_desc) ?></div>

                        <label for="title">Thứ tự</label>
                        <input type="text" value="<?php echo $slider_num_order  ?>" name="slider_num_order" id="num-order">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_num_order) ?></div>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                        </div>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_thumb) ?></div>

                        <label>Trạng thái</label>
                        <select name="slider_status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="active" <?php echo $slider_status=='active'?'selected':'' ?> >Công khai</option>
                            <option value="not_active"  <?php echo $slider_status=='not_active'?'selected':''  ?> >Chờ duyệt</option>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slider_status) ?></div>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
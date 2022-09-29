<?php 
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($announce) ?></div>
                    <form method="POST" action="?mod=page&controller=AdminListPage&action=edit&id=<?php echo $id ?>">
                        <label for="title">Tiêu đề</label>
                        <input type="text" value="<?php echo $page_name ?>" name="title" id="title">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_title) ?></div>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" value="<?php echo $slug ?>" name="slug" id="slug">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slug) ?></div>

                        <label for="desc">Mô tả</label>
                        <textarea name="desc"  id="desc" class="ckeditor"><?php echo $content ?></textarea>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_desc) ?></div>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">Chọn trạng thái</option>
                            <option value="active" <?php echo $status=='active'?'selected':'' ?> >Đăng</option>
                            <option value="not_active" <?php echo $status=='not_active'?'selected':'' ?>>Chờ xét duyệt</option>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_status) ?></div>

                       <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
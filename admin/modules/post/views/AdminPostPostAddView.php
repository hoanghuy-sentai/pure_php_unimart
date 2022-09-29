<?php
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok) ?></div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="?mod=post&controller=AdminPost&action=add" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="post_title" value="<?php echo $post_title  ?>" id="title">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_post_title) ?></div>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" value="<?php echo $slug ?>" name="slug" id="slug">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_slug) ?></div>

                        <label for="desc">Mô tả</label>
                        <textarea name="post_desc" id="desc" class="ckeditor"><?php echo $post_desc ?></textarea>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_post_desc) ?></div>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                        </div>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_post_thumb) ?></div>

                        <label>Danh mục</label>
                        <select name="cat-id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php 
                            foreach($postCats as $postCat)
                            {
                            ?>
                            <option value="<?php echo $postCat['id'] ?>" <?php echo $cat_id==$postCat['id']?'selected':''  ?>  ><?php echo str_repeat('-',$postCat['level']).$postCat['cat_name'] ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_cat_id) ?></div>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="active" <?php echo $status=='active'?'selected':'' ?>>Đăng</option>
                            <option value="not_active"<?php echo $status=='not_active'?'selected':'' ?>>Chờ duyệt</option>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_status) ?></div>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
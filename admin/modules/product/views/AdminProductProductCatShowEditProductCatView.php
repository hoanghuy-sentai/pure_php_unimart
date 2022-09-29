<?php 
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật danh mục bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="?mod=product&controller=AdminProductCat&action=edit&id=<?php echo $id ?>" >
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="cat_name" value="<?php echo $cat_name ?>" id="title">

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="active" <?php echo $status =='active'?'selected':'' ?> >Đăng</option>
                            <option value="not_active" <?php echo $status=='not_active'?'selected':'' ?>>Chờ duyệt</option>
                        </select>
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php 
                                foreach($postCats as $postCat)
                                {
                            ?>
                                    <option value="<?php echo $postCat['id'] ?>" <?php echo $postCat['cat_name']==$cat_name?"selected":"" ?> ><?php echo str_repeat("-",$postCat['level']).$postCat['cat_name'] ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                        <input type="hidden" name="parent_id_old" value="<?php echo $id_of_old_parentId ?>">
                        <p>Nếu không chọn danh mục thì sẽ mặc định là danh mục cha(0).</p>
                        <button type="submit" name="btn-submit" value="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
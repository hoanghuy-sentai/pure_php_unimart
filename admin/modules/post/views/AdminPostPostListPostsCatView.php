<?php
    get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="POST" action="?mod=post&controller=AdminPostCat&action=listPostCat" class="form-s">
                            <div class="fl-left">
                                <input type="text" placeholder="Nhập tên danh muc mới" name="i" id="s">
                                <input type="submit" name="sm_i" value="Thêm mới">
                            </div>
                            <div class="fl-right form-actions">
                                <select name="parent_id">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php 
                                        foreach($postCats as $postCat)
                                        {
                                    ?>
                                    <option value="<?php echo $postCat['id'] ?>"><?php echo str_repeat("-",$postCat['level']).$postCat['cat_name'] ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                                <p>Nếu không chọn danh mục thì mặc định sẽ là danh mục cha(0).</p>
                            </div>
                        </form>
                    </div>
                    <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:20px"><?php echo checkVarEmpty($ok) ?></div>
                    <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_cat_name) ?></div>
                    <div class="actions">
                    </div>
                    <div class="table-responsive">
                        <?php 
                            if(count($posts_cat))
                            {
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">id</span></td>
                                    <td><span class="thead-text">Tên danh mục</span></td>
                                    <td><span class="thead-text">Ngày đăng</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($posts_cat as $item)
                                    {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $item['id']  ?></span>
                                    <td><span class="tbody-text"><?php echo $item['cat_name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['post_cat_creating'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['time'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Bacon ipsum dolor amet hamburger frankfurter cow biltong pork loin capicola</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=post&controller=AdminPostCat&action=edit&id=<?php echo $item['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&controller=AdminPostCat&action=delete&id=<?php echo $item['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php 
                            }
                            else
                                echo "<p>Không tồn tại bản ghi nào.Hãy thêm bản ghi mới</p>";
                         ?>
                        </form>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                     <ul id="list-paging" class="fl-right">
                             <li>
                                <a href="?mod=post&controller=AdminPostCat&action=listPostCat&pre=pre&page=<?php echo $page ?>" title=""><</a>
                            </li>
                            <?php
                                for($i=1;$i<=$num_per_page;$i++)
                                {
                            ?>
                                <li>
                                    <a href="?mod=post&controller=AdminPostCat&action=listPostCat&page=<?php echo $i ?>" title=""><?php echo $i ?></a>
                                </li>    
                            <?php
                                }
                            ?>
                            <li>
                                <a href="?mod=post&controller=AdminPostCat&action=listPostCat&next=next&page=<?php echo $page ?>" title="">></a>
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
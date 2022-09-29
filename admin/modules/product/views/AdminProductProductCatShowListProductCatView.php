<?php
    get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <div class="form-s fl-left">
                            <form method="POST" action="?mod=product&&controller=AdminProductCat&&action=addCat&status=notTrash" >
                                <input type="text"  placeholder="Nhập tên danh muc sp mới" name="i" id="s">
                                <input type="submit" name="sm_i" value="Thêm mới">
                        </div>
                        <div class="form-s fl-right form-actions">
                                <select name="cat_id">
                                    <option value="0">--- Chọn danh mục ---</option>
                                    <?php 
                                    foreach($productCats as $productCat)
                                    {
                                    ?>
                                        <option value="<?php echo $productCat['id'] ?>"><?php echo str_repeat("-",$productCat['level']).$productCat['cat_name'] ?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                                <p>Nếu không chọn danh mục thì mặc định sẽ là danh mục cha(0).</p>
                            </form>
                        </div>
                    </div>
                    <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok) ?></div>
                    <div style="margin-top:0px;background-color:red;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($notOk) ?></div>
                    <div class="actions">
                    </div>
                    <?php 
                        if(count($product_cats)>0)
                        {
                    ?>
                    <div class="table-responsive">
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
                                    foreach($product_cats as $product_cat)
                                    {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $product_cat['id'] ?></span>
                                    <td><span class="tbody-text"><?php echo $product_cat['cat_name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $product_cat['product_cat_creating'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $product_cat['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $product_cat['time'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Bacon ipsum dolor amet hamburger frankfurter cow biltong pork loin capicola</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=product&&controller=AdminProductCat&&action=edit&&page=1status=notTrash&id=<?php echo $product_cat['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa không')" href=?mod=product&&controller=AdminProductCat&&action=delete&&page=1status=notTrash&id=<?php echo $product_cat['id'] ?>"" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
                            echo "<p>Không có sản phẩm nào.Hãy thêm mới một sản phẩm!</p>"
                    ?>
                        </form>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                        <ul id="list-paging" class="fl-right">
                                <li>
                                    <a href="?mod=product&controller=AdminProductCat&action=showListProductCat&status=notTrash&pre=pre&page=<?php echo $page ?>" title=""><</a>
                                </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=product&controller=AdminProductCat&action=showListProductCat&status=notTrash&page=<?php echo $i ?>" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                <li>
                                    <a href="?mod=product&controller=AdminProductCat&action=showListProductCat&status=notTrash&next=next&page=<?php echo $page ?>" title="">></a>
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
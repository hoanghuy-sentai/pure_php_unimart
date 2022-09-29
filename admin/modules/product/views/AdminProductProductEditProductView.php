<?php
    get_header()
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok) ?></div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="?mod=product&controller=AdminProduct&action=edit&id=<?php echo $id ?>" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" value="<?php echo $product_name ?>" id="product-name">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_name) ?></div>

                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" value="<?php echo $product_code ?>" id="product-code">
                        <input type="hidden" name="product_code_" value="<?php echo $product_code ?>">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_code) ?></div>

                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="product_price" value="<?php echo $product_price ?>" id="price">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_price) ?></div>

                        <label for="price">Số lượng sản phẩm</label>
                        <input type="text" name="product_qty" value="<?php echo $product_qty ?>" id="price">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_qty) ?></div>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_short_desc" id="desc"><?php echo $product_short_desc ?></textarea>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_short_desc) ?></div>

                        <label for="desc">Chi tiết</label>
                        <textarea name="product_detail_desc" id="desc" class="ckeditor"><?php echo $product_detail_desc  ?></textarea>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_detail_desc) ?></div>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="hidden" name="file_" value="<?php echo $product_thumb ?>">
                        </div>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_thumb) ?></div>

                        <label>Danh mục sản phẩm</label>
                        <select name="product_cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php 
                            foreach($productCats as $productCat)
                            {
                            ?>
                                <option value="<?php echo $productCat['id'] ?>" <?php echo $product_cat==$productCat['id']?'selected':"" ?>><?php echo str_repeat("-",$productCat['level']).$productCat['cat_name'] ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_cat) ?></div>

                        <label>Trạng thái</label>
                        <select name="product_status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="not_active" <?php echo $product_status =='not_active'?'selected':'' ?> >Chờ duyệt</option>
                            <option value="active" <?php echo $product_status =='active'?'selected':''  ?> >Đăng</option>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_product_status) ?></div>

                        <label>Sản phẩm nổi bật?</label>
                        <div id="uploadFile">
                            <input type="radio" name="productFeature" value="0" <?php echo $product_feature=="0"?'checked':'' ?> >Có       
                            <input type="radio" name="productFeature" value="1" <?php echo $product_feature=="1"?'checked':'' ?> id="price">Không
                        </div>

                        <button type="submit" name="btn-submit" value="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
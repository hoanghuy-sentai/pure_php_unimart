<?php
    get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&controller=AdminPost&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                <div style="margin-bottom:20px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok)  ?></div>
                <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($wrong_task)  ?></div>
                <div style="margin-bottom:20px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($info)  ?></div>
                <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($wrong_task)  ?></div>
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=post&controller=AdminPost&action=listPost&page=1&status=notTrash">Tất cả <span class="count">(<?php echo $show_record[0] ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=post&controller=AdminPost&action=listPost&page=1&sts=active&status=notTrash">Đã đăng <span class="count">(<?php echo $show_record[1] ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=post&controller=AdminPost&action=listPost&page=1&sts=not_active&status=notTrash">Chờ xét duyệt <span class="count">(<?php echo $show_record[2] ?>)</span></a></li>
                            <li class="trash"><a href="?mod=post&controller=AdminPost&action=listPost&page=1&status=Trash">Thùng rác <span class="count">(<?php echo $show_record[3] ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=post&controller=AdminPost&action=listPost&page=1&status=notTrash" class="form-s fl-right">
                            <input placeholder="Nhập tên tiêu đề cần tìm" type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=post&controller=AdminPost&action=listPost&page=1&status=notTrash" class="form-actions">
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
                    <?php
                        if(count($posts)>0)
                        { 
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">id</span></td>
                                    <td><span class="thead-text">Ảnh</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Ngày đăng</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>     
                                <?php 
                                foreach($posts as $post)
                                {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem['<?php echo $post['id'] ?>']" value="<?php echo $post['id'] ?>" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $post['id'] ?></h3></span>
                                    <td><span class="tbody-text"><a target="_blank" href="<?php echo base_url('public/uploadFiles/images'.$post['thumb_name']) ?>"><img src="<?php echo base_url('public/uploadFiles/images'.$post['thumb_name']) ?>"></a> </span></td>
                                    <td><span class="tbody-text"><?php echo $post['post_title'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['post_date'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['cat_name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['post_creating'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['status'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Bacon ipsum dolor amet hamburger frankfurter cow biltong pork loin capicola</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=post&controller=AdminPost&action=edit&page=1&id=<?php echo $post['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa không?')" href="?mod=post&controller=AdminPost&action=delete&page=1&id=<?php echo $post['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                        </table>
                        </form>
                    <?php
                        }
                        else
                            echo "<p>Không tồn tại bản ghi nào.Hãy thêm bản ghi mới!</p>"
                    ?>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                            <ul id="list-paging" class="fl-right">
                                    <li>
                                        <a href="?mod=post&controller=AdminPost&action=listPost&pre=pre&page=<?php echo $pag ?>&status=notTrash" title=""><</a>
                                    </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=post&controller=AdminPost&action=listPost&page=<?php echo $i ?>&status=notTrash" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                    <li>
                                        <a href="?mod=post&controller=AdminPost&action=listPost&next=next&page=<?php echo $pag ?>&status=notTrash" title="">></a>
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
<?php
    get_header();
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $count ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=media&controller=AdminMedia&action=show_media_list&page=1" class="form-s fl-right">
                            <input type="text" name="s" placeholder="Nhập tên file cần tìm" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=media&controller=AdminMedia&action=show_media_list&page=1" class="form-actions">
                            <select name="actions">
                                <option value="choose">Tác vụ</option>
                                <option onclick="return confirm('Nếu xóa ảnh thì bản ghi có chứa ảnh cũng sẽ bị xóa,bạn có muốn xóa hay không?')" value="deletePern">Xóa</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    <div style="margin-bottom:20px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok)  ?></div>
                    <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($wrong_task)  ?></div>
                    <?php 
                    if(count($medias)>0)
                    {
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên file</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($medias as $media)
                                {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[<?php echo $media['id'] ?>]" value="<?php echo $media['id'] ?>" class="checkItem"></td>
                                    <td>
                                        <div class="tbody-thumb">
                                            <a target="_blank" href="<?php echo "public/uploadFiles/images".$media['thumb_name'] ?>"><img src=<?php echo "public/uploadFiles/images".$media['thumb_name'] ?>  alt=""></a> 
                                        </div>
                                    </td>
                                    <td><span class="tbody-text"><?php echo basename($media['thumb_name']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $media['name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $media['time'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <!-- <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li> -->
                                            <li><a onclick="return confirm('Nếu xóa ảnh thì bản ghi có chứa ảnh cũng sẽ bị xóa,bạn có muốn xóa hay không?')" href="?mod=media&controller=AdminMedia&action=delete&page=1&id=<?php echo $media['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
                         }else echo "<p>Không tồn tại bản ghi nào.</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                            <ul id="list-paging" class="fl-right">
                                    <li>
                                        <a href="?mod=media&controller=AdminMedia&action=show_media_list&page=1&pre=pre&page=<?php echo $pag ?>&status=notTrash" title=""><</a>
                                    </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=media&controller=AdminMedia&action=show_media_list&page=1&page=<?php echo $i ?>&status=notTrash" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                    <li>
                                        <a href="?mod=media&controller=AdminMedia&action=show_media_list&page=1&next=next&page=<?php echo $pag ?>&status=notTrash" title="">></a>
                                    </li>   
                            </ul>
                </div>
            </div>
        </div>
    </div>
</div>
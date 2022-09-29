<?php
    get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?mod=page&controller=AdminListPage&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                    <div style="margin-bottom:20px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok)  ?></div>
                    <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($wrong_task)  ?></div>
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=1&status=notTrash">Tất cả <span class="count">(<?php echo $count_record[0] ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=1&status=notTrash&sts=active">Đã đăng <span class="count">(<?php echo $count_record[3]  ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=1&status=notTrash&sts=not_active">Chờ xét duyệt <span class="count">(<?php echo $count_record[2]  ?>)</span> |</a></li>
                            <li class="trash"><a href="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=1&status=Trash">Thùng rác <span class="count">(<?php echo $count_record[1]  ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=1&status=notTrash" class="form-s fl-right">
                            <input type="text" name="s" id="s" placeholder="Nhập tên trang">
                            <input type="submit" name="sm_s"  value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=page&controller=AdminListPage&action=showListPage&page=1&status=notTrash" class="form-actions">
                            <select name="actions">
                                <option value="choose">Tác vụ</option>
                                <?php 
                                  foreach($acts as $k=>$v)
                                  {
                                ?>
                                  <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php 
                                  }
                                ?>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    <div class="table-responsive">
                    <?php 
                        if(count($pages)>0)
                        {
                     ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">Id</span></td>
                                    <td><span class="thead-text">Tên trang</span></td>
                                    <td><span class="thead-text">Ngày đăng</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($pages as $page)
                                    {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[<?php echo $page['id'] ?>]" value="<?php echo $page['id'] ?>" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $page['id'] ?></span>
                                    <td><span class="tbody-text"><?php echo $page['page_name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['page_date'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['name'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['creating_time'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=page&controller=AdminListPage&action=edit&id=<?php echo $page['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa không?')" href="?mod=page&controller=AdminListPage&action=delete&id=<?php echo $page['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
                        }
                        else
                             echo "<p>Không tồn tại bản ghi nào,hãy thêm bản ghi mới.</p>";
                    ?>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">          
                <div class="section-detail clearfix">
                            <ul id="list-paging" class="fl-right">
                                    <li>
                                        <a href="?mod=page&controller=AdminListPage&action=showListPage&pre=pre&page=<?php echo $pag ?>&status=notTrash" title=""><</a>
                                    </li>
                                <?php
                                    for($i=1;$i<=$num_per_page;$i++)
                                    {
                                ?>
                                    <li>
                                        <a href="?mod=page&controller=AdminListPage&action=showListPage&page=<?php echo $i ?>&status=notTrash" title=""><?php echo $i ?></a>
                                    </li>    
                                <?php
                                    }
                                ?>
                                    <li>
                                        <a href="?mod=page&controller=AdminListPage&action=showListPage&next=next&page=<?php echo $pag ?>&status=notTrash" title="">></a>
                                    </li>   
                            </ul>
                    </div>

            </div>
        </div>
    </div>
</div>
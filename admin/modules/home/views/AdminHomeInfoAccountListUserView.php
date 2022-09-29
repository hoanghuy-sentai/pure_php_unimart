<?php 
    get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=home&controller=index&action=loginSuccess" title="">Home</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách người dùng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                    <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($wrong_task); ?></div>
                    <div style="margin-bottom:20px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($ok);echo checkVarEmpty($info)  ?></div>
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=home&controller=infoAccount&action=showListUsers&page=1&status=notTrash">Tất cả <span class="count">(<?php echo $countNotTrash ?>)</span></a> |</li>
                            <li class="trash"><a href="?mod=home&controller=infoAccount&action=showListUsers&page=1&status=trash">Thùng rác <span class="count">(<?php echo $countTrash ?>)</span></a></li>
                        </ul>
                        <form method="POST" action="?mod=home&controller=infoAccount&action=showListUsers&page=1&status=notTrash" class="form-s fl-right">
                            <input type="text" placeholder="Nhập tên email" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=home&controller=infoAccount&action=showListUsers&page=1&status=notTrash" class="form-actions">
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
                            if(count($users)>0)
                            { 
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">Id</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Tên</span></td>
                                    <td><span class="thead-text">Vai trò</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>                                 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                        foreach($users as $user)
                                        {
                                 ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[<?php echo $user['id']  ?>]" value="<?php echo $user['id'] ?>" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $user['id'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['email'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['name']  ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['rolename'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['date_creating'] ?></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Bacon ipsum dolor amet hamburger frankfurter cow biltong pork loin capicola</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=home&controller=infoAccount&action=edit&id=<?php echo $user['id']  ?>"" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xóa không?')" href="?mod=home&controller=infoAccount&action=delete&id=<?php echo $user['id']  ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                    else
                                        echo "<p>Không có bản ghi nào,hãy thêm mới một bản ghi.</p>"
                                 ?>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                             <li>
                                <a href="?mod=home&controller=infoAccount&action=showListUsers&pre=pre&page=<?php echo $page ?>&status=notTrash" title=""><</a>
                            </li>
                        <?php
                            for($i=1;$i<=$num_per_page;$i++)
                            {
                        ?>
                            <li>
                                <a href="?mod=home&controller=infoAccount&action=showListUsers&page=<?php echo $i ?>&status=notTrash" title=""><?php echo $i ?></a>
                            </li>    
                        <?php
                            }
                        ?>
                            <li>
                                <a href="?mod=home&controller=infoAccount&action=showListUsers&next=next&page=<?php echo $page ?>&status=notTrash" title="">></a>
                            </li>   
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

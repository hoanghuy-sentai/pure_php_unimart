<?php get_header() ?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left" style="margin-left: 20px;">Thêm tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=home&controller=index&action=loginSuccess" title="">Home</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                <div style="margin-top:0px;background-color:yellow;color:white;padding:0px 0px 0px 5px;font-size:22px"><?php echo checkVarEmpty($announce) ?></div>
                <form method="POST" action="?mod=home&controller=infoAccount&action=createUser">
                        <label for="name">Tên hiển thị</label>
                        <input type="text" name="name"   placeholder="" id="display-name">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_name);echo checkVarEmpty($er_name) ?></div>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" " placeholder="" >
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($emptyEmail);echo checkVarEmpty($duplexEmail) ?></div>

                        <label for="display-name">Mật khẩu</label>
                        <input type="password" name="password"  id="display-name">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_password);echo checkVarEmpty($er_password);echo checkVarEmpty($er_password_validation) ?></div>
                        <label for="display-name">Nhập lại mật khẩu</label>
                        <input type="password"   name="re-password" id="display-name">
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_re_password) ?></div>

                        <select name="role" id="role" >
                            <option value="">Quyền</option>
                            <?php 
                                foreach($roles as $key=>$vlue)
                                {
                            ?>
                                 <option value="<?php $key=$key+1; echo $key ?>" ><?php echo $vlue['rolename']  ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                        <div style="margin-bottom:20px;background-color:red;color:white;padding:0px 0px 0px 5px"><?php echo checkVarEmpty($empty_role) ?></div>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
<!-- <h1>Ahihi</h1>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi itaque aspernatur, inventore voluptas, sint blanditiis maxime possimus, odio quo ut rem unde velit recusandae in ipsam sapiente! Odit, rerum saepe?</p> -->
<?php
    // show_array($hoangthongminh);
    // echo $hoangdeptrai;
    get_header();
?>
<!-- ------------------ -->
<body>
    <div id="container">
        <h1 style="text-align:center">List users</h1>
        <table border="1px" cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <td>Sự phân biệt</td>
                    <td>Tên người dùng</td>
                    <td>Họ và tên</td>
                    <td>Email</td>
                    <td>Giới tính</td>
                    <td>Mật khẩu</td>
                    <td>Tiền kiếm được</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($hoangthongminh)>0)
                    {
                        foreach($hoangthongminh as $noroncuahoang)
                        {
                        ?>
                            <tr>
                                <td><?php echo $noroncuahoang['user_id'] ?></td>
                                <td><?php echo $noroncuahoang['username'] ?></td>
                                <td><?php echo $noroncuahoang['fullname'] ?></td>
                                <td><?php echo $noroncuahoang['email'] ?></td>
                                <td><?php echo $noroncuahoang['gender'] ?></td>
                                <td><?php echo $noroncuahoang['password'] ?></td>
                                <td><?php echo currency_format($noroncuahoang['earn'],"$") ?></td>
                            </tr>
                        <?php
                        }
                    }
                    else{
                        ?>
                           <p>Không có dữ liệu nào để hiển thị.</p>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <ul id="pagination">
        <?php 
            for($i=1;$i<=$hoangPage;$i++)
            {
                echo "<li><a href='?mod=user&controller=index&act=index&page=$i'>$i</a></li>";
            }
        ?>
        </ul>
            <!-- <li><a href="?mod=user&controller=index&act=index&page=1">1</a></li> -->
            <!-- <li><a href="?mod=user&controller=index&act=index&page=2">2</a></li>
            <li><a href="?mod=user&controller=index&act=index&page=3">3</a></li>
            <li><a href="?mod=user&controller=index&act=index&page=4">4</a></li>
            <li><a href="?mod=user&controller=index&act=index&page=5">5</a></li> -->
    </div>
</body>
</html>
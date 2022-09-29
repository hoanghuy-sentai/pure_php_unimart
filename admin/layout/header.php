<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý ISMART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url("public/css/bootstrap/bootstrap.min.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("public/css/bootstrap/bootstrap-theme.min.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("public/reset.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("public/css/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("public/style.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("public/responsive.css")?>" rel="stylesheet" type="text/css"/>

        <script src="<?php echo base_url("public/js/jquery-2.2.4.min.js")?>" type="text/javascript"></script>
        <script src="<?php echo base_url("public/js/bootstrap/bootstrap.min.js")?>" type="text/javascript"></script>
        <script src="<?php echo base_url("public/js/plugins/ckeditor/ckeditor.js")?>" type="text/javascript"></script>
        <script src="<?php echo base_url("public/js/main.js")?>" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?mod=home&controller=index&action=loginSuccess" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?mod=page&controller=AdminListPage&action=showListPage&status=notTrash" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=page&controller=AdminListPage&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=page&controller=AdminListPage&action=showListPage&status=notTrash" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=post&controller=AdminPost&action=listPost&status=notTrash" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=post&controller=AdminPost&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&controller=AdminPost&action=listPost&status=notTrash" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&controller=AdminPostCat&action=listPostCat" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=product&controller=AdminProduct&action=showListProduct&page=1&status=notTrash" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product&controller=AdminProduct&action=add&page=1" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&controller=AdminProduct&action=showListProduct&page=1&status=notTrash" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&&controller=AdminProductCat&&action=showListProductCat&status=notTrash" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=home&controller=index&action=loginSuccess&page=1" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <!-- <li>
                                        <a href="?page=list_order" title="">Danh sách khách hàng</a> 
                                    </li> -->
                                </ul>
                            </li>
                            <li>
                                <!-- <a href="?page=menu" title="">Menu</a> -->
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="public/images/img-admin.png">
                                </div>
                                <h3 id="account" class="fl-right"><?php echo $name ?></h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?mod=home&controller=infoAccount&action=showInfoAccount" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="?mod=home&controller=logout&action=logout" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
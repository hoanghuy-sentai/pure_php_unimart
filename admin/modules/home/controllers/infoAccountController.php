<?php
        function construct() {
        //    echo "DÙng chung, load đầu tiên";
            
        }
        
        function showInfoAccountAction()
        {
            load("helper","checkVarEmpty");
            load_model("infoUser");
        
            $data['name']=$_SESSION['info_user_login']['name'];
            $data['email']=$_SESSION['info_user_login']['email'];

            $data['empty_name']=null;
            $data['empty_email']=null;
            $data['empty_password']=null;
            $data['empty_re_password']=null;
            $data['er_password']=null;
            $data['er_name']=null;
            $data['er_password_validation']=null;
            $data['empty_role']=null;
            $data['announce']=null;

            $data['show_name']=isset($name)?$name:null;

            $roles=get_role();
            $data['user']=userInfo($_SESSION['info_user_login']['id'])['role_id'];
            $data['roles']=$roles;

            load_view("infoUser",$data);// open login page
        }

        function addAction()
        {  

            load("helper","checkVarEmpty");
            load_model("infoUser");
        
            $data['name']=$_SESSION['info_user_login']['name'];
            $data['email']=$_SESSION['info_user_login']['email'];

            $data['empty_name']=null;
            $data['emptyEmail']=null;
            $data['empty_password']=null;
            $data['empty_re_password']=null;
            $data['er_password']=null;
            $data['er_name']=null;
            $data['er_password_validation']=null;
            $data['empty_role']=null;
            $data['announce']=null;
            $data['empty_role']=null;
            $data['duplexEmail']=null;
            

            $data['show_name']=isset($name)?$name:null;

            $roles=get_role();
            $data['roles']=$roles;

            load_view("AdminHomeInfoAccountAdd",$data);
        }

        function updateUserAction()
        {
            // show_array($_SESSION);
            load("helper","checkVarEmpty");
            load("helper","setInputValue");
            load("helper","stringValidation");
            load("helper","passwordValidation");
            load_model("infoUser");

            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $re_password=$_POST['re-password'];
            $role=$_POST['role'];

            $error=array();


            if(empty($name))
            {
                $error['emptyName']="Tên không được để trống";
            }
            else
            {
                $subject=$name;
                if(!stringValidation($subject))//false==true => action
                {
                    $error['er_name']="Tên chứa các ký tự A đến Z,a đến z,0-9 dấu. và dấu gạch dưới.Và độ dài từ 6-32 ký tự";
                }
            }


            if(empty($password))
            {
                $error['emptyPassword']='Password không được để trống';
            }
            else{
                $subject=$password;
                if(!passwordValidation($subject))
                {
                    $error['er_password_validation']="Mật khẩu có định dạng các ký tự chữ cái hoa,thường,chữ số,ký tự đặc biệt,dấu chấm.Bắt đầu với ký tự in hoa.Và có 6-32 ký tự";
                }
            }

            if(empty($re_password))
            {
                $error['empty_re_Password']='Password không được để trống';
            }

            if($password!=$re_password)
            {
                $error['er_password']="Mật khẩu không khớp";
            }

            if(empty($role))
            {
                $error['empty_role']='Bạn chưa chọn quyền';
            }

            if(!empty($error))
            {
                $data['empty_name']=isset($error['emptyName'])?$error['emptyName']:null;
                $data['empty_password']=isset($error['emptyPassword'])?$error['emptyPassword']:null;
                $data['empty_re_password']=isset($error['empty_re_Password'])?$error['empty_re_Password']:null;
                $data['empty_role']=isset($error['empty_role'])?$error['empty_role']:null;


                $data['er_name']=isset($error['er_name'])?$error['er_name']:null;
                $data['er_password_validation']=isset($error['er_password_validation'])?$error['er_password_validation']:null;

                $data['er_password']=isset($error['er_password'])?$error['er_password']:null;

                $data['announce']=null;

                $data['show_name']=isset($name)?$name:"";
                // $data['show_password']=isset($password)?$password:null;
                // $data['show_re_password']=isset($re_password)?$re_password:null;

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['roles']=$roles;
                $data['user']=userInfo($_SESSION['info_user_login']['id'])['role_id'];

                load_view("infoUser",$data);

            }


            if(empty($error))//update is ready here :v
            {
                // $data['show_name']=isset($name)?$name:$_SESSION['info_user_login']['name'];

                // $data['name']=$_SESSION['info_user_login']['name'];
                // $data['email']=$_SESSION['info_user_login']['email'];

                $data['show_name']=isset($name)?$name:"";

                $data['empty_name']=null;
                $data['empty_email']=null;
                $data['empty_password']=null;
                $data['empty_re_password']=null;
                $data['er_password']=null;
                $data['er_name']=null;
                $data['er_password_validation']=null;
                $data['empty_role']=null;

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['user']=userInfo($_SESSION['info_user_login']['id'])['role_id'];
                $data['roles']=$roles;

                //update
                $fields=[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>md5($password),
                     'role_id'=>$role,
                     'date_creating'=>date("d/m/Y"),
                ];
                db_update('users',$fields,"id=1");

                $data['announce']="Đã cập nhật thành công";

                load_view("infoUser",$data);

                

            }

        }

        function createUserAction()
        {
            // show_array($_SESSION);
            load("helper","checkVarEmpty");
            load("helper","setInputValue");
            load("helper","usernameValidation");
            load("helper","passwordValidation");
            
            load_model("infoUser");

            $name=$_POST['name'];
            $email=isset($_POST['email'])?$_POST['email']:null;
            $password=$_POST['password'];
            $re_password=$_POST['re-password'];
            $role=$_POST['role'];

            $error=array();


            if(empty($name))
            {
                $error['emptyName']="Tên không được để trống";
            }
            else
            {
                $subject=$name;
                if(!usernameValidation($subject))//false==true => action
                {
                    $error['er_name']="Tên chứa các ký tự A đến Z,a đến z,0-9 dấu. và dấu gạch dưới.Và độ dài từ 6-32 ký tự";
                }
            }

            if(empty($email))
            {
                $error['emptyEmail']='Email không được để trống';
            }
            else{
                if(isset($email))
                {
                    // show_array(checkUnique($email));

                    if(!checkUnique($email))
                    {
                        $error['duplexEmail']='email đã được được sử dụng.Hãy chọn email khác';
                    }
                }
            }

            if(empty($password))
            {
                $error['emptyPassword']='Password không được để trống';
            }
            else{
                $subject=$password;
                if(!passwordValidation($subject))
                {
                    $error['er_password_validation']="Mật khẩu có định dạng các ký tự chữ cái hoa,thường,chữ số,ký tự đặc biệt,dấu chấm.Bắt đầu với ký tự in hoa.Và có 6-32 ký tự";
                }
            }

            if(empty($re_password))
            {
                $error['empty_re_Password']='Password không được để trống';
            }


            if($password!=$re_password)
            {
                $error['er_password']="Mật khẩu không khớp";
            }

            if(empty($role))
            {
                $error['empty_re_Password']='Bạn chưa chọn quyền';
            }


            if(!empty($error))
            {
                $data['empty_name']=isset($error['emptyName'])?$error['emptyName']:null;
                $data['emptyEmail']=isset($error['emptyEmail'])?$error['emptyEmail']:null;
                $data['empty_password']=isset($error['emptyPassword'])?$error['emptyPassword']:null;
                $data['empty_re_password']=isset($error['empty_re_Password'])?$error['empty_re_Password']:null;
                $data['empty_role']=isset($error['empty_role'])?$error['empty_role']:null;

                $data['er_name']=isset($error['er_name'])?$error['er_name']:null;
                $data['er_password_validation']=isset($error['er_password_validation'])?$error['er_password_validation']:null;

                $data['er_password']=isset($error['er_password'])?$error['er_password']:null;


                $data['duplexEmail']=isset($error['duplexEmail'])?$error['duplexEmail']:null;


                $data['announce']=null;

                $data['show_name']=isset($name)?$name:"";
               

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['roles']=$roles;

                load_view("AdminHomeInfoAccountAdd",$data);

            }


            if(empty($error))//update is ready here :v
            {
                // $data['show_name']=isset($name)?$name:$_SESSION['info_user_login']['name'];

                // $data['name']=$_SESSION['info_user_login']['name'];
                // $data['email']=$_SESSION['info_user_login']['email'];

                $data['show_name']=isset($name)?$name:"";

                $data['empty_name']=null;
                $data['emptyEmail']=null;
                $data['empty_password']=null;
                $data['empty_re_password']=null;
                $data['er_password']=null;
                $data['er_name']=null;
                $data['er_password_validation']=null;
                $data['empty_role']=null;
                $data['duplexEmail']=null;
                

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['roles']=$roles;

                //add
                $fields=[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>md5($password),
                    'role_id'=>$role,
                    'date_creating'=>date("d/m/Y"),
                ];
                db_insert('users',$fields);

                $data['announce']="Đã thêm user thành công";

                load_view("AdminHomeInfoAccountAdd",$data);

                

            }

        }

        function showListUsersAction()
        {
            global $data,$error;

            load_model("infoUser");
            load("helper",'redirecting');
            load("helper",'pagination');
            load("helper",'checkVarEmpty');

            $data['name']=$_SESSION['info_user_login']['name'];
            $data['email']=$_SESSION['info_user_login']['email'];

            $error=array();

            $info=array();
                    //task

                    if(isset($_POST['sm_action']))
                    {
                        global $data,$error;
        
                        $list_check=isset($_POST['checkItem'])?$_POST['checkItem']:null;
                        if(isset($list_check))
                        {
        
                            // show_array($_POST['checkItem']);
        
                            $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
        
                            // show_array($_POST);
                            $actions=$_POST['actions'];
                            global $data,$error;
                            switch($actions)
                            {
                                case 'choose': $error['wrong_task']="Hãy chọn vào tác vụ nào đó để thực thi";
                                break;
                                case 'delete':
                                    // show_array($_POST['checkItem']);
                                    foreach($_POST['checkItem'] as $item)
                                    {
                                        $data=[
                                            'trash'=>1,
                                        ];
                                        $where='id='.$item;
                                        db_update('users',$data,$where);
                                    }
                                    $info['ok']='Đã bỏ bản ghi vào thùng rác';
                                break;
                                case 'restore':
                                    foreach($_POST['checkItem'] as $item)
                                    {
                                        $data=[
                                            'trash'=>0,
                                        ];
                                        $where='id='.$item;
                                        db_update('users',$data,$where);
                                    }
                                    $info['ok']='Đã khôi phục bản ghi';
                                    ;
                                break;
                                case 'deletePern':
                                    foreach($_POST['checkItem'] as $item)
                                    {     
                                        $where='id='.$item;
                                        db_delete('users',$where);
                                    }
                                    $info['ok']='Đã xóa bản ghi';
                                    ;
                                break;
                                    
                                default:0;
                            }
        
                        }
                        else{
                            $error['wrong_task']="Bạn chưa chọn tác vụ nào cả";
                        }
                    }
        
                    //end task

            // pagination
            $page=isset($_GET['page'])?(int)$_GET['page']:1;//cần
            $num_page=3;//cần. Đây là số lượng bản ghi muốn hiển thị.Mình đã nhầm khi đặt tên biến
            $num_row=get_num_row(0);//cần
            $num_per_page=ceil($num_row/$num_page);//cần. tính số dòng hiện thị trong 1trang

            $pagination=pagination($page,$num_page,$num_row,$num_per_page);

            $start=$pagination['start'];


            $users=get_list_users($start,$num_page,0);//Đáng ra là $num_page là $num_per_page những chót đặt nhầm từ trước và ngại sửa lại

            $data['num_per_page']=$num_per_page;
            $data['page']=$pagination['page'];

            // end pagination

            if(isset($_GET['status'])&&$_GET['status']=='trash')
            {
                $users=get_list_users($start,$num_page,1);
            }
            else{
                $users=get_list_users($start,$num_page,0);
            }

            if(isset($_GET['status'])&&$_GET['status']=='notTrash')//nếu status trên url là .. thì..
            {
                global $data,$error;

                $acts=[
                    'delete'=>'Bỏ vào thùng rác',
                ];

                
            }
            else{
                global $data,$error;

                $acts=[
                    'restore'=>'khôi phục',
                    'deletePern'=>'Xóa',
                ];
            }


            //tìm kiếm

            if(isset($_POST['sm_s']))
            {
                $search= $_POST['s'];
                $users=get_list_users($start,$num_page,0,$search);
            }

            //end search

            $data['acts']=isset($acts)?$acts:null;

            $data['countNotTrash']=get_num_row(0);
            $data['countTrash']=get_num_row(1);

            $data['users']=$users;


    
            $data['wrong_task']=isset($error['wrong_task'])?$error['wrong_task']:null;
            $data['ok']=isset($info['ok'])?$info['ok']:null;

            $data['info']=isset($_GET['info'])?"Đã xóa thành công":null;

            load_view("AdminHomeInfoAccountListUser",$data);
        }

        function deleteAction()
        {   
            load("helper","redirecting");

            $id=(int)$_GET['id'];
            $table='users';
            db_delete("$table","id=$id");

            redirect("?mod=home&controller=infoAccount&action=showListUsers&status=notTrash&info=info");
        }

        function editAction()
        {
            load("helper","checkVarEmpty");
            load_model('infoUser');

            $id=(int)$_GET['id'];

            $data['name']=$_SESSION['info_user_login']['name'];
            $data['email']=$_SESSION['info_user_login']['email'];

            $data['empty_name']=null;
            $data['emptyEmail']=null;
            $data['empty_password']=null;
            $data['empty_re_password']=null;
            $data['er_password']=null;
            $data['er_name']=null;
            $data['er_password_validation']=null;
            $data['empty_role']=null;
            $data['announce']=null;
            $data['duplexEmail']=null;

            $data['show_name']=isset($name)?$name:null;

            $roles=get_role();
            $data['user']=userInfo($id)['role_id'];
            $data['roles']=$roles;



           
            $user=get_user_by_id($id);
            $data['user']=$user;

            load_view("AdminHomeInfoAccountEdit",$data);
        }

        function updateAction()
        {
            $id=(int)$_GET['id'];

            load("helper","checkVarEmpty");
            load("helper","setInputValue");
            load("helper","usernameValidation");
            load("helper","passwordValidation");
            load_model("infoUser");

            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $re_password=$_POST['re-password'];
            $role=$_POST['role'];

            $error=array();


            if(empty($name))
            {
                $error['emptyName']="Tên không được để trống";
            }
            else
            {
                $subject=$name;
                if(!usernameValidation($subject))//false==true => action
                {
                    $error['er_name']="Tên chứa các ký tự A đến Z,a đến z,0-9 dấu. và dấu gạch dưới.Và độ dài từ 6-32 ký tự";
                }
            }


            if(empty($password))
            {
                $error['emptyPassword']='Password không được để trống';
            }
            else{
                $subject=$password;
                if(!passwordValidation($subject))
                {
                    $error['er_password_validation']="Mật khẩu có định dạng các ký tự chữ cái hoa,thường,chữ số,ký tự đặc biệt,dấu chấm.Bắt đầu với ký tự in hoa.Và có 6-32 ký tự";
                }
            }

            if(empty($re_password))
            {
                $error['empty_re_Password']='Password không được để trống';
            }

            if($password!=$re_password)
            {
                $error['er_password']="Mật khẩu không khớp";
            }

            if(empty($role))
            {
                $error['empty_role']='Bạn chưa chọn quyền';
            }

            if(!empty($error))
            {
                $data['empty_name']=isset($error['emptyName'])?$error['emptyName']:null;
                $data['emptyEmail']=isset($error['emptyEmail'])?$error['emptyEmail']:null;
                $data['duplexEmail']=isset($error['duplexEmail'])?$error['duplexEmail']:null;
                $data['empty_password']=isset($error['emptyPassword'])?$error['emptyPassword']:null;
                $data['empty_re_password']=isset($error['empty_re_Password'])?$error['empty_re_Password']:null;
                $data['empty_role']=isset($error['empty_role'])?$error['empty_role']:null;


                $data['er_name']=isset($error['er_name'])?$error['er_name']:null;
                $data['er_password_validation']=isset($error['er_password_validation'])?$error['er_password_validation']:null;

                $data['er_password']=isset($error['er_password'])?$error['er_password']:null;

                $data['announce']=null;

                $data['show_name']=isset($name)?$name:"";
                // $data['show_password']=isset($password)?$password:null;
                // $data['show_re_password']=isset($re_password)?$re_password:null;

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['roles']=$roles;
                $data['user']=userInfo($id)['role_id'];

                $user=get_user_by_id($id);
                $data['user']=$user;

                load_view("AdminHomeInfoAccountEdit",$data);

            }


            if(empty($error))//update is ready here :v
            {
                // $data['show_name']=isset($name)?$name:$_SESSION['info_user_login']['name'];

                // $data['name']=$_SESSION['info_user_login']['name'];
                // $data['email']=$_SESSION['info_user_login']['email'];

                $data['show_name']=isset($name)?$name:"";

                $data['empty_name']=null;
                $data['emptyEmail']=null;
                $data['duplexEmail']=null;
                $data['empty_password']=null;
                $data['empty_re_password']=null;
                $data['er_password']=null;
                $data['er_name']=null;
                $data['er_password_validation']=null;
                $data['empty_role']=null;

                $data['name']=$_SESSION['info_user_login']['name'];
                $data['email']=$_SESSION['info_user_login']['email'];

                $roles=get_role();
                $data['user']=userInfo($id)['role_id'];
                $data['roles']=$roles;

                //update
                $fields=[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>md5($password),
                     'role_id'=>$role,
                     'date_creating'=>date("d/m/Y"),
                ];
                db_update('users',$fields,"id=$id");

                $data['announce']="Đã cập nhật thành công";

                $user=get_user_by_id($id);
                $data['user']=$user;

                load_view("AdminHomeInfoAccountEdit",$data);

                

            }
        }


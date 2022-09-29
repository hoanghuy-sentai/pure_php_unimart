<?php
    function construct()
    {

    }

    function show_payment_pageAction()
    {
        load("helper","checkVarEmpty");

        $data['empty_cus_name']=null;
        $data['empty_cus_email']=null;
        $data['empty_cus_add']=null;
        $data['empty_cus_phone']=null;
        $data['empty_payMethod']=null;

        $data['cus_name']=null;
        $data['cus_email']=null;
        $data['cus_add']=null;
        $data['cus_phone']=null;
        $data['payMethod']=null;
        $data['cus_note']=null;

        load_view("order/ClientPayMentShowPayMentPage",$data);
    }

    function executeAction()
    {
        load("helper","redirecting");
        load("helper","checkVarEmpty");
        load("helper","stringValidation");
        load("helper","phoneValidation");
        load("helper","emailValidation");
        load("lib","email");
        load("helper","email_content");

        if(isset($_POST['order_now']))
        {
            $cus_name=$_POST['cus_name'];
            $cus_email=$_POST['cus_email'];
            $cus_add=$_POST['cus_add'];
            $cus_phone=$_POST['cus_phone'];
            $cus_payMethod=isset($_POST['payMethod'])?$_POST['payMethod']:null;
            $cus_note=$_POST['cus_note'];

            $error=array();
            if(empty($cus_name))
            {
                $error['empty_cus_name']="Họ tên không được để trống.";
            }
            else{
                if(!stringValidation($cus_name))
                {
                    $error['empty_cus_name']="Họ tên không hợp lệ.";
                }
            }

            if(empty($cus_email))
            {
                $error['empty_cus_email']="Email không được để trống.";
            }
            else{
                if(!emailValidation($cus_email))
                {
                    $error['empty_cus_email']="Email không hợp lệ.";
                }
            }

            if(empty($cus_add))
            {
                $error['empty_cus_add']="Địa chỉ không được để trống.";
            }
            else{
                if(!stringValidation($cus_add))
                {
                    $error['empty_cus_add']="Địa chỉ không hợp lệ.";
                }
            }

            if(empty($cus_phone))
            {
                $error['empty_cus_phone']='Số điện thoại không được để trống.';
            }
            else{
                if(!phoneValidation($cus_phone))
                {
                    $error['empty_cus_phone']='Số điện thoại không hợp lệ.';
                }
            }

            if(empty($cus_payMethod))
            {
                $error['empty_payMethod']="Hãy chọn một phương thức thanh toán.";
            }

            if(!empty($error))
            {
                $data['empty_cus_name']=isset($error['empty_cus_name'])?$error['empty_cus_name']:null;
                $data['empty_cus_email']=isset($error['empty_cus_email'])?$error['empty_cus_email']:null;;
                $data['empty_cus_add']=isset($error['empty_cus_add'])?$error['empty_cus_add']:null;;
                $data['empty_cus_phone']=isset($error['empty_cus_phone'])?$error['empty_cus_phone']:null;;
                $data['empty_payMethod']=isset($error['empty_payMethod'])?$error['empty_payMethod']:null;;

                /*Load lại data khi lỗi*/
                $data['cus_name']=$cus_name;
                $data['cus_email']=$cus_email;
                $data['cus_add']=$cus_add;
                $data['cus_phone']=$cus_phone;
                $data['cus_note']=$cus_note;
                $data['payMethod']=$cus_payMethod;
                //
            }

            if(empty($error))
            {
                $cus_order_code="#".rand(3,4).substr(time(),8);
                $content=email_content($cus_name,$cus_order_code,$cus_email,$cus_add,$cus_phone,$cus_note,$cus_payMethod,$_SESSION['cart']['products'],$_SESSION['cart']['statistical']['total']);
                $_SESSION['order']['info']=[
                    'cus_name'=>$cus_name,
                    'cus_add'=>$cus_add,
                    'cus_phone'=>$cus_phone,
                    'cus_order_code'=>$cus_order_code,
                    'total'=>$_SESSION['cart']['statistical']['total'],
                ];
                /*save in db*/
                $cus_or_field=[
                    'cus_order_code'=>$cus_order_code,
                    'cus_name'=>$cus_name,
                    'cus_email'=>$cus_email,
                    'cus_add'=>$cus_add,
                    'cus_phone'=>$cus_phone,
                    'cus_note'=>$cus_note,
                    'status'=>"Đang xử lý",
                    'cus_total'=>$_SESSION['cart']['statistical']['total'],
                    'date'=>date("d/m/Y"),
                ];
                $id= db_insert("cus_order",$cus_or_field);
                foreach($_SESSION['cart']['products'] as $item)
                {
                    $cus_pr_field=[
                        'idOfProduct'=>$item['id'],
                        'product_code'=>$item['product_code'],
                        'thumb_name'=>$item['thumb_name'],
                        'product_name'=>$item['product_name'],
                        'product_price'=>$item['product_price'],
                        'product_qty'=>$item['product_qty'],
                        'sub_total'=>$item['sub_total'],
                        'cus_order_id'=>$id,
                    ];
                    db_insert("cus_product",$cus_pr_field);
                }

                /**/

                send_email($cus_email,"Unimart store","[Unimart.vn]Thư xác nhận thanh toán",$content);
                redirect("?mod=client&controller=ClientPayment&action=order_success");
            }

            load_view("order/ClientPayMentShowPayMentPage",$data);
        }
    }

    function order_successAction()
    {
        $data['info']=[
            'cus_name'=>$_SESSION['order']['info']['cus_name'],
            'cus_add'=>$_SESSION['order']['info']['cus_add'],
            'cus_phone'=>$_SESSION['order']['info']['cus_phone'],
            'cus_order_code'=>$_SESSION['order']['info']['cus_order_code'],
            'total'=>$_SESSION['order']['info']['total'],         
        ];
        unset($_SESSION['cart']);
        load_view("order/ClientPayMentOrderSuccess",$data);
    }
?>
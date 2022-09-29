<?php
   function construct()
   {

   }
   function add_cartAction()
   {
       load_model("product");
       load("helper","redirecting");

       $id=(int)$_GET['id'];
       $qty=isset($_GET['qty'])?$_GET['qty']:0;

       $old_qty=isset($_SESSION['cart']['products'][$id]['product_qty'])?$_SESSION['cart']['products'][$id]['product_qty']:0;
       $qty=$old_qty+1;

       $product=get_product_by_id($id);
       $_SESSION['cart']['products'][$id]=[
             'id'=>$product['id'],
             'product_code'=>$product['product_code'],
             'thumb_name'=>$product['thumb_name'],
             'product_name'=>$product['product_name'],
             'product_price'=>$product['product_price'],
             'product_qty'=>$qty,
             'sub_total'=>$product['product_price']*$qty,
       ];
        
      /*total*/
      $total=0;
      foreach($_SESSION['cart']['products'] as $item)
      {
         $total=$total+$item['sub_total'];
      }
      $_SESSION['cart']['statistical']['total']=$total;
      /**/
       
       redirect("gio-hang.html");
      
    //    echo json_encode($qty);
   }

   function show_cartAction()
   {
        load_view("Cart/ClientCartShow_cart");
   }

   function delete_cartAction()
   {
      load("helper","redirecting");

      $id=(int)$_GET['id'];
      unset($_SESSION['cart']['products'][$id]);
      redirect("?mod=client&controller=ClientCart&action=show_cart");
   }

   function update_cart_by_ajaxAction()
   {
      load_model("product");


      $id=$_GET['id'];

      $product=get_product_by_id($id);

      $qty=$_GET['qty'];
      $price=$_GET['price'];
      $sub_total=$qty*$price;

      $_SESSION['cart']['products'][$id]=[
         'id'=>$product['id'],
         'product_code'=>$product['product_code'],
         'thumb_name'=>$product['thumb_name'],
         'product_name'=>$product['product_name'],
         'product_price'=>$product['product_price'],
         'product_qty'=>$qty,
         'sub_total'=>$sub_total,
      ];
    
      /*total*/
      $total=0;
      foreach($_SESSION['cart']['products'] as $item)
      {
         $total=$total+$item['sub_total'];
      }
      $_SESSION['cart']['statistical']['total']=$total;
      /**/

      $data=[
         'id'=>$id,
         'sub_total'=>currency_format($sub_total,"đ"),
         'total'=>currency_format($total,"Đ"),
      ];
      echo json_encode($data);
   }

   function delete_all_cartAction()
   {
      load("helper","redirecting");

      unset($_SESSION['cart']);
      redirect("?mod=client&controller=ClientCart&action=show_cart");
   }

   function continueToBuyAction()
   {
      load("helper","redirecting");

      redirect("?mod=client&controller=index&action=index");
   }

   function buy_nowAction()
   {
      load("helper","redirecting");
      load_model("product");

      $id=(int)$_GET['id'];
      $qty=isset($_GET['qty'])?$_GET['qty']:0;

      $old_qty=isset($_SESSION['cart']['products'][$id]['product_qty'])?$_SESSION['cart']['products'][$id]['product_qty']:0;
      $qty=$old_qty+1;

      $product=get_product_by_id($id);
      $_SESSION['cart']['products'][$id]=[
            'id'=>$product['id'],
            'product_code'=>$product['product_code'],
            'thumb_name'=>$product['thumb_name'],
            'product_name'=>$product['product_name'],
            'product_price'=>$product['product_price'],
            'product_qty'=>$qty,
            'sub_total'=>$product['product_price']*$qty,
      ];
       
     /*total*/
     $total=0;
     foreach($_SESSION['cart']['products'] as $item)
     {
        $total=$total+$item['sub_total'];
     }
     $_SESSION['cart']['statistical']['total']=$total;
     /**/

     redirect("thanh-toan.html");
   }

?>
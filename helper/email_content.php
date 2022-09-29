<?php
    function email_content($cus_name,$product_code,$cus_email,$cus_add,$cus_phone,$cus_note,$payMethod,$session_cart,$session_cart_total)
    {
        ?>
        <?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
        <?php 
            $context="
            <table align='center' bgcolor='#dcf0f8' border='0' cellpadding='0' cellspacing='0'
            style='margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px'
            width='100%'>
            <tbody>
                <tr>
                    <td align='center'
                        style='font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'
                        valign='top'>
                        <table border='0' cellpadding='0' cellspacing='0' style='margin-top:15px' width='600'>
                            <tbody>
                                <tr>
                                    <td>
                                        <h1 style='font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0'>
                                            Cảm ơn quý khách $cus_name  đã đặt hàng tại <span class='il'>Unimart</span>,</h1>

                                        <p
                                            style='margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'>
                                            <span class='il'>Unimart</span> rất vui thông báo đơn hàng  $product_code 
                                            của quý khách đã được tiếp nhận và đang trong quá trình xử lý. <span
                                                class='il'>Unimart</span> sẽ thông báo đến quý khách ngay khi hàng
                                            chuẩn bị được giao.
                                        </p>

                                        <h3
                                            style='font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd'>
                                            Thông tin đơn hàng <span
                                                style='font-size:12px;color:#777;text-transform:none;font-weight:normal'>(Ngày
                                                 ".date('d')."  Tháng ".date('m')."  Năm  ".date('Y').") ".date('H:i:s')."</span></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                    style='font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <thead>
                                            <tr>
                                                <th align='left'
                                                    style='padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold'
                                                    width='50%'>Thông tin thanh toán</th>
                                                <th align='left'
                                                    style='padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold'
                                                    width='50%'> Địa chỉ giao hàng </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style='padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'
                                                    valign='top'><span
                                                        style='text-transform:capitalize'> $cus_name</span><br>
                                                    <a href='mailto:bicave13@gmail.com' target='_blank'> $cus_email</a><br>
                                                    <?php echo  $cus_phone ?>
                                                </td>
                                                <td style='padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'
                                                    valign='top'><span
                                                        style='text-transform:capitalize'> $cus_name </span><br>
                                                    <a href='mailto:bicave13@gmail.com' target='_blank'> $cus_email </a><br>
                                                     $cus_add<br>
                                                    T: $cus_phone 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'
                                                    style='padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444'
                                                    valign='top'>
                                                    <p
                                                        style='font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'>
                                                        <strong>Phương thức thanh toán: </strong> $payMethod <br>
                                                        <strong>Cách thức nhận hàng:</strong> quý khách nhận
                                                        hàng tại cửa hàng, địa chỉ nhận hàng sẽ được thông
                                                        báo đến quý khách sau khi có xác nhận của cửa hàng.
                                                      
                                                        <strong>Phí vận chuyển:Free </strong> <br>
                                                        <!-- {{-- 0đ --}} -->
                                                    </p>
                                                </td>
                                          </tr>
                                          </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p
                                            style='margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'>
                                            <i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao
                                                nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép
                                                lái xe để chụp ảnh hoặc ghi lại thông tin.</i>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2
                                                style='text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea'>
                                                CHI TIẾT ĐƠN HÀNG</h2>
                                        <table border='0' cellpadding='0' cellspacing='0' style='background:#f5f5f5' width='100%'>
                                            <thead>
                                                    <tr>
                                                        <th align='left' bgcolor='#02acea'
                                                            style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px'>
                                                            Sản phẩm</th>
                                                        <th align='left' bgcolor='#02acea'
                                                            style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px'>
                                                            Đơn giá</th>
                                                        <th align='left' bgcolor='#02acea'
                                                            style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px'>
                                                            Số lượng</th>
                                                        <th align='left' bgcolor='#02acea'
                                                            style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px'>
                                                            Giảm giá</th>
                                                        <th align='right' bgcolor='#02acea'
                                                            style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px'>
                                                            Tổng tạm</th>
                                                    </tr>
                                            </thead>
                                            <tbody bgcolor='#eee' style='font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px'>
                                            "
                                        ;
        ?>      
                                            <?php 
                                            $t=array();
                                            foreach ($session_cart as $item)
                                            {
                                            $product_buy[]=
                                            "
  
                                                    <tr>
                                                        <td align='left' style='padding:3px 9px' valign='top'>
                                                            <span>".$item['product_name']."</span><br>
                                                        </td>
                                                        <td align='left' style='padding:3px 9px' valign='top'>
                                                            <span>".currency_format($item['product_price'],'đ')."</span>
                                                        </td>
                                                        <td align='left' style='padding:3px 9px' valign='top'>". $item['product_qty']."</td>
                                                        <td align='left' style='padding:3px 9px' valign='top'><span>0</span> </td>
                                                        <td align='right' style='padding:3px 9px' valign='top'>
                                                            <span>".currency_format($item['sub_total'],'đ')."</span>
                                                        </td>
                                                    </tr>

                                            ";
                                            }
                                            ?>
                                            <?php  
                                                 foreach($product_buy as $item)
                                                 {
                                                     $context=$context.$item;
                                                 }
                                                 $context3="
                                                 </tbody>
                                                 <tfoot
                                                 style='font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px'>
                                                 <tr>
                                                     <td align='right' colspan='4' style='padding:5px 9px'>Tạm
                                                         tính</td>
                                                     <td align='right' style='padding:5px 9px'>
                                                         <span>".currency_format($session_cart_total,'đ')."</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td align='right' colspan='4' style='padding:5px 9px'>Phí
                                                         vận chuyển</td>
                                                     <td align='right' style='padding:5px 9px'><span>0đ</span>
                                                     </td>
                                                 </tr>
                                                 <tr bgcolor='#eee'>
                                                     <td align='right' colspan='4' style='padding:7px 9px'>
                                                         <strong><big>Tổng giá trị đơn hàng</big> </strong>
                                                     </td>
                                                     <td align='right' style='padding:7px 9px'>
                                                         <strong><big><span>".currency_format($session_cart_total,'đ')."</span> </big>
                                                         </strong>
                                                     </td>
                                                 </tr>
                                             </tfoot>
                                         </table>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>&nbsp;
                                         <p
                                             style='margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'>
                                             Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm
                                             mục <a href='google.com' title='Các câu hỏi thường gặp' target='_blank'
                                                 data-saferedirecturl='google.com'>
                                                 <strong>các câu hỏi thường gặp</strong>.</a></p>
                                         <p
                                             style='margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal'>
                                             Mọi thắc mắc và góp ý, quý khách vui lòng liên hệ với <span
                                                 class='il'>Unimart</span> Care qua <a href='google.com' target='_blank'
                                                 data-saferedirecturl='google.com'>https://hotro.<span
                                                     class='il'>Unimart</span>.vn/hc/vi</a>. Đội ngũ <span
                                                 class='il'>Unimart</span>
                                             Care luôn sẵn sàng hỗ trợ bạn.</p>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </td>
                 </tr>
             </tbody>
         </table>
         </td>
         </tr>
         </tbody>
         </table>";
        ?>
        <?php
        return $context.$context3;

    }

?>


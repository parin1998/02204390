<!doctype html>
<html lang="zxx">
<?php

require("head.html");
session_start();
if (!(isset($_SESSION['admin']))) {
    session_destroy();
    header("location:index.php?allow=0");
}
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
require('connectDB.php');
$sql = 'SELECT payment.slip, payment.id AS p_id, cart.id ,cart.total_price, payment.date , product.name , cart_product.quantity , payment.money_received , payment.status ,payment.slip , tracking.t_status , tracking.track_code FROM 
cart INNER JOIN cart_product ON cart.id = cart_product.cart_id
INNER JOIN product ON cart_product.product_id = product.id
INNER JOIN payment ON payment.cart_id = cart.id
INNER JOIN tracking ON (tracking.pay_id = payment.id) AND (tracking.cart_id = cart.id)';
$rs = selectAll($db, $sql);
$record = array();
foreach ($rs as $row) {
    $record[] = $row;
}

?>

<!-- update -->
<?php
if (isset($_GET['cart.id']) && $_GET['cart.id'] != "") {
    $Update_cart_id = $RS['record[].id'];
    $update_payment_status = $RS['record[].status'];
    $update_track_status = $RS['record[].t_status'];
    $update_track_code = $RS['record[].track_code'];
}

?>



<body class="test">
    <?php
    // echo $record;
    ?>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#"><img class="img-fluid ml-5" src="img/favicon.gif" alt="logo"></img> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item text-right" id="navbarSupportedContent">
                            <div class="col-md-3"></div>
                            <ul class="navbar-nav mr-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./order.php">Order</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="updatepayment.php">
                                        Payment
                                    </a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="adminloguot.php">
                                        logout
                                    </a>

                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- breadcrumb part start-->
    <section class="breadcrumb_part bg-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>Pilowy Admin</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb part end-->


    <!--================ track post part start =================-->
    <section class="confirmation_part section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <h3>รายละเอียดการชำระเงิน</h3>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">เลขที่คำสั่งซื้อ</th>
                                    <th scope="col">วันที่ทำรายการ</th>
                                    <th scope="col">สินค้า</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">จำนวนยอดที่ต้องได้รับ</th>
                                    <th scope="col">จำนวนยอดที่ได้รับจริง</th>
                                    <th scope="col">สถานะการชำระเงิน</th>
                                    <th scope="col">หลักฐานการชำระเงิน</th>
                                    <th scope="col">แก้ไข</th>
                                    <th scope="col">ภาพสลิป</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($record); $i++) {
                                ?>
                                    <tr>
                                        <th colspan="2"><span><?php echo $record[$i]['id'] ?></span></th>
                                        <th> <span><?php echo $record[$i]['date'] ?></span></th>
                                        <th><?php echo $record[$i]['name'] ?></th>
                                        <th>x <?php echo $record[$i]['quantity'] ?></th>
                                        <th> <span><?php echo $record[$i]['total_price'] ?> บาท</span></th>
                                        <th> <span><?php echo $record[$i]['money_received'] ?> บาท</span></th>
                                        <th> <span><?php echo $record[$i]['status'] ?></span></th>
                                        <th> <span><?php echo $record[$i]['slip'] ?></span></th>
                                        <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?php echo $record[$i]['id'] ?>" data-whatever="@mdo">แก้ไข</button></th>
                                        <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModalCenter-<?php echo $record[$i]['id'] ?>" data-whatever="@fat">รูป</button></th>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ track post part end =================-->
    <?php
    for ($j = 0; $j < count($record); $j++) {

    ?>
<!--=============== modal update =============-->

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form></form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">จำนวนยอดที่ต้องได้รับ:</label>
            <input type="text" name="money_received" value="<?php echo $record[$j]['money_received']; ?>" class="form-control" id="money_received">
                 <input type="hidden" id="p_id" name="p_id" value="<?php echo $record[$j]['p_id']; ?>" />
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">สถานะการชำระเงิน:</label>
            <input type="text" name="statuspayment" value="<?php echo $record[$j]['status']; ?>" class="form-control" id="statuspayment">
                 <input type="hidden" id="p_id" name="p_id" value="<?php echo $record[$j]['p_id']; ?>" />
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary">แก้ไข</button>
      </div>
    </div>
  </div>
</div>

<?php }
?>


<!-- delete Modal -->
<?php
    for ($k = 0; $k < count($record); $k++) {

    ?>
<div class="modal fade" id="deleteModalCenter-<?php echo $record[$k]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete ?</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="updateorder.php" method="post">
           <div class="modal-body">
             คุณแน่ใจว่าจะลบรายการนี้ ?
           </div>
           <div class="modal-footer">
             <input type="hidden" id="cd_id" name="_id" value="<?php echo $record[$k]['cp_id']; ?>" />
             <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
             <button name="submit" type="submit" class="btn btn-primary">ลบ</button>
           </div>
           </from>
       </div>
     </div>
   </div>
<?php }
?>
    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="footer_iner">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-9">
                        <div class="footer_menu">
                            <div class="footer_logo">
                                <a href="#"><img src="img/favicon.gif" alt="#"></a>
                            </div>
                            <div class="footer_menu_item">
                                <a href="admin.php">Home</a>
                                <a href="order.php">Order</a>

                                <a href="updatepayment.php">Payment</a>

                                <!-- <a href="#">Pages</a>
                            <a href="blog.html">Blog</a>
                            <a href="contact.html">Contact</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="social_icon">
                            <a href="https://www.facebook.com/Pilowy-%E0%B8%AB%E0%B8%A1%E0%B8%AD%E0%B8%99%E0%B8%A2%E0%B8%B2%E0%B8%87%E0%B8%9E%E0%B8%B2%E0%B8%A3%E0%B8%B2%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%AA%E0%B8%B8%E0%B8%82%E0%B8%A0%E0%B8%B2%E0%B8%9E-103141214799677/" target="new">
                                <i class="fab fa-facebook-f"></i></a>
                            <!-- <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="copyright_part">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="copyright_text">
                            <P>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                All rights reserved | This
                                template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </P>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- magnific popup js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- carousel js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- slick js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>

    </div>
</body>


</html>
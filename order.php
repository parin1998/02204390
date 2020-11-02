 <!doctype html>
 <html lang="zxx">
 <?php

  require("head.html");
  session_start();
  function console_log($output, $with_script_tags = true)
  {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
      ');';
    if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
  }
  if (!(isset($_SESSION['admin']))) {
    session_destroy();
    header("location:index.php?allow=0");
  }
  require('connectDB.php');
  $sql = 'SELECT cart.id ,cart.total_price, payment.date ,payment.id AS p_id , product.name , cart_product.quantity , cart_product.id AS cp_id , payment.money_received , payment.status ,tracking.id AS t_id , tracking.t_status , tracking.track_code FROM 
cart INNER JOIN cart_product ON cart.id = cart_product.cart_id
INNER JOIN product ON cart_product.product_id = product.id
INNER JOIN payment ON payment.cart_id = cart.id
INNER JOIN tracking ON (tracking.pay_id = payment.id) AND (tracking.cart_id = cart.id)';
  $rs = selectAll($db, $sql);
  $record = array();
  foreach ($rs as $row) {
    $record[] = $row;
  }
  // $sqlupdate = 'UPDATE payment.id FROM payment INNER JOIN cart ON payment.cart_id = cart.id';
  ?>

 <body class="test">
   <?php
    // echo $record;
    // console_log($record[0]['cp_id']);
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
                                    <a class="nav-link" href="./updatepayment.php">Payment</a>
                                </li>
                 <li class="nav-item">
                   <a class="nav-link" href="adminlogout.php">
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
             <h3>รายละเอียดการสั่งซื้อสินค้า</h3>
             <table class="table table-borderless">
               <thead>
                 <tr>
                   <th scope="col" colspan="2">เลขที่คำสั่งซื้อ</th>
                   <th scope="col">วันที่ทำรายการ</th>
                   <th scope="col">สินค้า</th>
                   <th scope="col">จำนวน</th>
                   <th scope="col">ยอดที่ต้องชำระ</th>
                   <th scope="col">สถานะการชำระเงิน</th>
                   <th scope="col">สถานะการจัดส่งสินค้า</th>
                   <th scope="col">เลขพัสดุ</th>
                   <th scope="col">แก้ไข</th>
                   <th scope="col">ลบ</th>
                 </tr>
               </thead>
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
                     <th> <span><?php echo $record[$i]['status'] ?></span></th>
                     <input type="hidden" id="p_id" name="p_id" value="<?php echo $record[$i]['p_id']; ?>" />
                     <input type="hidden" id="t_id" name="t_id" value="<?php echo $record[$i]['t_id']; ?>" />
                     <input type="hidden" id="cp_id" name="cp_id" value="<?php echo $record[$i]['cp_id']; ?>" />
                     <input type="hidden" id="id" name="id" value="<?php echo $record[$i]['id']; ?>" />
                     <th> <span><?php echo $record[$i]['t_status'] ?></span></th>
                     <th> <span><?php echo $record[$i]['track_code'] ?></span></th>
                     <input type="hidden" id="row" name="row" value="<?php echo $i; ?>" />
                     <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?php echo $record[$i]['id']; ?>" data-whatever="@mdo">แก้ไข</button></th>
                     <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModalCenter-<?php echo $record[$i]['id']; ?>" data-whatever="@fat">ลบ</button></th>
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
     <div class="modal fade" id="updateModal-<?php echo $record[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายการ</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form action="updateorder.php" method="post">
               <div class="form-group">
                 <label for="statuspayment" class="col-form-label">สถานะการชำระเงิน:</label>
                 <input type="text" name="statuspayment" value="<?php echo $record[$j]['status']; ?>" class="form-control" id="statuspayment">
                 <input type="hidden" id="p_id" name="p_id" value="<?php echo $record[$j]['p_id']; ?>" />

                 <input type="hidden" id="t_id" name="t_id" value="<?php echo $record[$j]['t_id']; ?>" />
                 <input type="hidden" id="id" name="id" value="<?php echo $record[$j]['id']; ?>" />

               </div>
               <div class="form-group">
                 <label for="statuspost" class="col-form-label">สถานะการจัดส่งสินค้า:</label>
                 <input type="text" name="statuspost" value="<?php echo $record[$j]['t_status']; ?>" class="form-control" id="statuspost">
               </div>
               <div class="form-group">
                 <label for="trackcode" class="col-form-label">เลขพัสดุ:</label>
                 <input type="text" name="trackcode" value="<?php echo $record[$j]['track_code']; ?>" class="form-control" id="trackcode">
               </div>
               <!--recipient-name-->

           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
             <button name="submit" type="submit" class="btn btn-primary">แก้ไข</button>
           </div>
           </form>
         </div>
       </div>
     </div>
 <?php
    }
    
    for ($k = 0; $k < count($record); $k++) {

    ?>  
   <!-- delete Modal -->
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
             <input type="hidden" id="cp_id" name="cp_id" value="<?php echo $record[$k]['cp_id']; ?>" />
             <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
             <button name="submit" type="submit" class="btn btn-primary">ลบ</button>
           </div>
           </from>
       </div>
     </div>
   </div>


<?php
    }
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
   <!-- <script>
    $("#order_edit").click(function() {
      $.ajax({
        type: 'POST',
        url: 'ajax.php?id=' + $("#id").val(),
        cache: false,
        success: function(response) {
          alert(response);
          console.log(response);
        }
      });
    });
  </script> -->

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

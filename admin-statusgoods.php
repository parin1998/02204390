<!doctype html>
<html lang="zxx">

<?php
session_start();
require("head.html");
require('connectDB.php');

$sessionlifetime = 30; //กำหนดเป็นนาที
// print_r($_SESSION["timeLasetdActive"]);
if (isset($_SESSION["timeLasetdActive"])) {
  $seclogin = (time() - $_SESSION["timeLasetdActive"]) / 60;
  //หากไม่ได้ Active ในเวลาที่กำหนด
  if ($seclogin > $sessionlifetime) {
    //goto logout page
    session_destroy();
    header("location:index.php?time=0");
    exit(0);
  } else {
    $_SESSION["timeLasetdActive"] = time();
  }
} else {
  $_SESSION["timeLasetdActive"] = time();
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
console_log($_SESSION['id']);
if (isset($_SESSION['id'])) {
  $sql = 'SELECT cart.id , payment.date , product.name , cart_product.quantity , payment.money_received , payment.status , tracking.status , tracking.track_code FROM 
    cart INNER JOIN cart_product ON cart.id = cart_product.cart_id
    INNER JOIN product ON cart_product.product_id = product.id
    INNER JOIN payment ON payment.cart_id = cart.id
    INNER JOIN tracking ON (tracking.pay_id = payment.id) AND (tracking.cart_id = cart.id)
    WHERE cart.cus_id = \'' . $_SESSION['id'] . '\' ORDER BY cart_product.id ASC';

  $rs = selectAll($db, $sql);
  $record = array();
  foreach ($rs as $row) {
    $record[] = $row;
  }
}


?>

<body>
  <!--::header part start::-->
  <?php
  // console_log($_SESSION['f_name']);
  //
  ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171494050-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-171494050-1');
  </script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TVQP89G');
  </script>
  <!-- End Google Tag Manager -->

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVQP89G" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!--::header part start::-->
  <header class="main_menu home_menu">
    <div class="">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php"><img class="img-fluid ml-5" src="img/favicon.gif" alt="logo"></img> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="menu_icon"><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse main-menu-item text-right" id="navbarSupportedContent">
              <div class="col-md-8"></div>
              <ul class="navbar-nav mr-2">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">about</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="product_list.php">
                    product
                  </a>

                </li>

                <?php
                if (isset($_SESSION['id']))
                  $page = 'statusgoods.php';
                else {
                  $page = 'login.php';
                  $_SESSION['check'] = true;
                }
                ?>
                <li class="nav-item">

                  <a class="nav-link" href="<?php echo $page; ?>">
                    tracking
                  </a>

                </li>
                <!-- <li class="nav-item">
                                    <a class="nav-link" href="blog.php">
                                        pages
                                    </a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="blog.php" >blog</a>

                                </li> -->

                <!-- <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contact</a>
                                </li> -->
              </ul>
            </div>
            <?php
            if (isset($_SESSION['id']))
              $p = 'cart.php';
            else
              $p = 'login.php';
            ?>
            <div class="hearer_icon d-flex align-items-center mr-md-5 mr-sm-5 mr-4">
              <!-- <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a> -->
              <a href="<?php echo $p; ?>">
                <i class="fas fa-shopping-cart"></i>
              </a>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <!-- <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div> -->
  </header>
  <!-- Header part end-->
  <!-- Header part end-->

  <!-- breadcrumb part start-->
  <section class="breadcrumb_part">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner">
            <h2>สถานะสินค้า</h2>
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
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>ข้อมูลลูกค้า</h4>
            <ul>
              <li>
                <p>ชื่อ-นามสกุล</p><span>: <?php echo $_SESSION['f_name'];
                                            echo " ";
                                            echo $_SESSION['l_name']; ?></span>
              </li>
              <li>
                <p>อีเมล</p><span>: <?php echo $_SESSION['email']; ?></span>
              </li>
              <li>
                <p>เบอร์โทร</p><span>: <?php echo $_SESSION['phone']; ?></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">

        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>ที่อยู่รับสินค้า</h4>
            <ul>
              <li>
                <p>ที่อยู่</p><span>: <?php echo $_SESSION['address'];
                                      echo " ";
                                      echo $_SESSION['postal_code']; ?></span>
              </li>

            </ul>
          </div>
        </div>
      </div>
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
                  <th scope="col">ยอดชำระ</th>
                  <th scope="col">สถานะการชำระเงิน</th>
                  <th scope="col">สถานะการจัดส่งสินค้า</th>
                  <th scope="col">เลขพัสดุ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i = 0; $i < count($record); $i++) {
                ?>
                  <tr>
                    <th colspan="2"><span>KU18888</span></th>
                    <th> <span>15/02/20</span></th>
                    <th>หมอนทุเรียน</th>
                    <th>x 1</th>
                    <th> <span>590 บาท</span></th>
                    <th> <span>ชำระแล้ว</span></th>
                    <th> <span>จัดส่งเรียบร้อยแล้ว</span></th>
                    <th> <span>eieizazababakrukri</span></th>
                  </tr>

                <?php
                }
                ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ track post part end =================-->

  <!--::footer_part start::-->
  <section class="client_review">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">

        </div>
      </div>
    </div>

  </section>
  <footer class="footer_part">
    <div class="footer_iner">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-8">
            <div class="footer_menu">
              <div class="footer_logo">
                <a href="index.html"><img src="img/favicon.gif" alt="#"></a>
              </div>
              <div class="footer_menu_item">
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="product_list.html">Products</a>
                <!-- <a href="#">Pages</a>
                            <a href="blog.html">Blog</a>
                            <a href="contact.html">Contact</a> -->
              </div>
            </div>
          </div>
          <div class="col-lg-4">
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
              <div class="copyright_link">
                <a href="#">Turms & Conditions</a>
                <a href="#">FAQ</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--::footer_part end::-->
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml: true,
        version: 'v7.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- Your Chat Plugin code -->
  <div class="fb-customerchat" attribution=setup_tool page_id="103141214799677" theme_color="#0084ff">
  </div>
  <!-- jquery plugins here-->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/mixitup.min.js"></script>
  <!-- particles js -->
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

</body>

</html>
<!doctype html>
<html lang="zxx">

<?php

require("head.html");

?>

<body>
    <!--::header part start::-->
    <?php
    require("header.php");


    if (isset($_POST['product_id'])) {
        $_SESSION['product_id'] = $_POST['product_id'];
        $_SESSION['num'] = $_POST['num'];
        $_SESSION['price'] = $_POST['price'];

    }
    if (isset($_GET['from'])) {
        console_log($_GET['from']);
        $from = $_GET['from'];
        $_SESSION['from'] = $from;

    }
    ?>
    <!-- Header part end-->

    <!-- breadcrumb part start-->
    <!-- <section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>login</h2>
                </div>
            </div>
        </div>
    </div>
</section> -->
    <!-- breadcrumb part end-->

    <!--================login_part Area =================-->
    <section class="login_part section_padding mt-md-5 pt-md-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>ไม่เคยซื้อของกับเรา ?</h2>
                            <p>ก่อนซื้อของกับเรากรุณากรอกเบอร์โทรศัพท์เพื่อเป็นการลงทะเบียนยืนยันตัวตนกับเรา</p><br /><br />

                            <form class="row contact_form" action="createuser.php" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="เบอร์โทรศัพท์" maxlength="10">
                                </div>

                                <!-- <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">Remember me</label>
                                </div> -->

                                <!-- <button type="submit" value="submit" class="btn_3">
                                ซื้อของต่อ
                            </button> -->

                                <input name="submit" type="submit" value="ซื้อของต่อ" class="btn_3 ml-auto mr-auto" />

                                <!-- <a class="lost_pass" href="#">forget password?</a> -->
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>ยินดีต้อนรับ ! <br>
                                กรอกเบอร์โทรศัพท์เพื่อเข้าใช้งาน</h3>
                            <form class="row contact_form" action="checkuser.php" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="เบอร์โทรศัพท์" maxlength="10">
                                </div>

                                <!-- <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">Remember me</label>
                                </div> -->
                                <br /><br /><br />
                                <!-- <button type="submit" value="submit" class="btn_3">
                                ซื้อของต่อ
                            </button> -->
                                <input name="submit" type="submit" value="ซื้อของต่อ" class="btn_3 ml-auto mr-auto" />
                                <!-- <a class="lost_pass" href="#">forget password?</a> -->
                                <!--</div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    <!--::footer_part start::-->
    <?php
    require("footer.php");
    ?>
    <!--::footer_part end::-->

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

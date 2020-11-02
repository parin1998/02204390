<!-- client review part here -->
<section class="client_review">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="client_review_slider owl-carousel">
                    <div class="single_client_review">
                        <div class="client_img">
                            <img src="img/client.png" alt="#">
                        </div>
                        <p>"ใช้แล้วนอนหลับสบายมากครับ"</p>
                        <h5>- สมชาย</h5>
                    </div>
                    <div class="single_client_review">
                        <div class="client_img">
                            <img src="img/client_1.png" alt="#">
                        </div>
                        <p>"คอหายปวด นอนหลับสบายมาก"</p>
                        <h5>- ประยุทธ</h5>
                    </div>
                    <div class="single_client_review">
                        <div class="client_img">
                            <img src="img/client_2.png" alt="#">
                        </div>
                        <p>"นอนคอตกหมอนบ่อยๆ ตอนนี้ไม่ตกอีกแล้ว ดีมากครับ"</p>
                        <h5>- ปริญญา</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- client review part end -->


<!-- feature part here -->
<section class="feature_part section_padding">
    <div class="container">
        <!-- <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="feature_part_tittle">
                    <h3>Credibly innovate granular
                        internal or organic sources
                        whereas standards.</h3>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="feature_part_content">
                    <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                        sources. Credibly innovate granular internal or “organic” sources whereas high standards in
                        web-readiness.</p>
                </div>
            </div>
        </div> -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single_feature_part">
                    <img src="img/icon/feature_icon_2.svg" alt="#">
                    <h4>Online Order</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_feature_part">
                    <img src="img/icon/feature_icon_3.svg" alt="#">
                    <h4>Free Delivery</h4>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- feature part end -->

<!-- subscribe part here -->
<!-- <section class="subscribe_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe_part_content">
                    <h2>Get promotions & updates!</h2>
                    <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                        sources credibly innovate granular internal .</p>
                    <div class="subscribe_form">
                        <input type="email" placeholder="Enter your mail">
                        <a href="#" class="btn_1">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- subscribe part end -->

<!--::footer_part start::-->
<footer class="footer_part">
    <div class="footer_iner">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-8">
                    <div class="footer_menu">
                        <div class="footer_logo">
                            <a href="index.php"><img src="img/favicon.gif" alt="#"></a>
                        </div>
                        <div class="footer_menu_item">
                            <a href="index.php">Home</a>
                            <a href="about.php">About</a>
                            <a href="product_list.php">Products</a>

                            <?php
                            if (isset($_SESSION['id']))
                                $page = 'statusgoods.php';
                            else {
                                $page = 'login.php?from=track';
                                
                            }
                            ?>

                            <a href="<?php echo $page; ?>">Tracking</a>

                            <?php
                            if (isset($_SESSION['id']))
                                $page = 'payment.php';
                            else {
                                $page = 'login.php?from=payment';
                                
                            }
                            ?>

                            <a href="<?php echo $page; ?>">Payment</a>

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
                            <script>document.write(new Date().getFullYear());</script>
                            All rights reserved | This
                            template is made with <i class="ti-heart" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </P>
                        
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
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v7.0'
        })
        ;
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="103141214799677"
     theme_color="#0084ff">
</div>

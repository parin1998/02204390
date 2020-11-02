<!doctype html>
<html lang="zxx">

<?php
require("head.html");
require('connectDB.php');
$sql = 'SELECT product.id,product.name,product.img,product.price,product.detail FROM product';
$rs = selectAll($db, $sql);
$record = array();
foreach ($rs as $row) {
    $record[] = $row;
}
?>

<body>
<!--::header part start::-->
<?php
require("header.php");
?>
<!-- Header part end-->

<!-- breadcrumb part start-->
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>รายการสินค้า</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!-- product list part start-->
<section class="product_list section_padding pt-md-2 pt-2 pl-2 pr-2">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="product_list">
                    <div class="container">
                        <div class="row col-md-12">
                            <?php
                            for ($i = 0; $i < count($record); $i++) {
                                ?>
                                <?php
                                if ($i % 2 == 1) { ?>
                                    <div class="col-md-1">

                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="col-lg-5 col-md-5 col-sm-6 border-circle-square pt-4 mt-5">
                                    <div class="single_product_item pl-2 ml-0 text-center">
                                        <img src="<?php echo $record[$i]['img']; ?>" alt="#" class="img-fluid">
                                        <h3><a href="single-product.php?id=<?php echo $record[$i]['id'] ;?>">
                                                <?php echo $record[$i]['name']; ?>
                                            </a></h3>
                                        <p><?php $record[$i]['price'] ?></p>
                                        <div class="add_to_cart mt-4">
                                            <a href="single-product.php?id=<?php echo $record[$i]['id'];?>" class="btn_3">Explore Now</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product list part end-->

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

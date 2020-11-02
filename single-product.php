<!doctype html>
<html lang="zxx">

<?php
require("head.html");
require("connectDB.php");
if (isset($_GET['id'])) {
    $sql = 'SELECT product.id,product.name,product.img,product.price as product_price,product.detail FROM product WHERE id = \'' . $_GET['id'] . '\'';
    $rs = selectAll($db, $sql);
    //print_r($rs);
    echo "<br>";

    $record = array();
    foreach ($rs as $row) {
        $record[] = $row;
    }
}
?>

<body>
<!--::header part start::-->
<?php
require("header.php");
?>
<!-- Header part end-->

<!-- breadcrumb part start-->
<section class="breadcrumb_part single_product_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="single_product_img">
                    <img src="<?php echo $record[0]['img'] ?>" alt="#"
                         class="img-fluid col-md-12 col-sm-12 pl-0 pr-0 border-circle-square"
                         style="border-color: #FFFFFF">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="single_product_text text-center">
                    <h3><?php echo $record[0]['name']; ?></h3>
                    <p>
                        <?php echo $record[0]['detail']; ?>
                    </p>
                    <?php
                    if (isset($_SESSION['id'])) {
                        $page = "cart.php?add=" . $record[0]['id'];
                    } else {
                        $page = "login.php";
                    }
                    ?>
                    <form action="<?php echo $page; ?>" method="POST">
                        <div class="card_area border-circle-square mt-3 pb-5">
                            <p>จำนวน</p>
                            <div class="product_count_area">
                                <div class="product_count d-inline-block">
                                    <span class="product_count_item inumber-decrement" id="change-num1"> <i
                                                class="fas fa-minus"></i></span>
                                    <input class="product_count_item input-number" name="num" id="num" type="text"
                                           value="1" min="1" max="999">
                                    <span class="product_count_item number-increment" id="change-num2"> <i
                                                class="fas fa-plus"></i></span>
                                    <span id="price_change">
                                             <input type="hidden" name="product_price" id="product_price"
                                                    value="<?php echo $record[0]['product_price']; ?>">
                                            <input type="hidden" name="price" id="price"
                                                   value="<?php echo $record[0]['product_price']; ?>">
                                        </span>
                                    <input type="hidden" name="product_id" id="product_id"
                                           value="<?php echo $record[0]['id']; ?>">
                                </div>
                            </div>

                            <div class="container pt-3 pb-1 " id="total">
                                <label id="total_price"
                                       style="font-size: 18px;color: #0f6674"><?php echo number_format(590, 2) ?>
                                    บาท</label>
                                <input type="hidden" name="total_price" id="total_price"
                                       value="<?php echo $record[0]['price']; ?>">
                            </div>
                        </div>

                        <div class=" add_to_cart mt-md-3 mt-sm-2 mt-3">
                            <button value="<?php echo 'add' ?>" name="submit" id="submit" type="submit" class="btn_3">
                                add to cart
                            </button>
                        </div>
                </div>
                </from>
            </div>
        </div>
    </div>
</div>
</div>
<!--================End Single Product Area =================-->

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
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Intl.~locale.en"></script>

<script type="text/javascript">
    $('#num').add('#change-num1').add('#change-num2').on('input click', function () {
        $.ajax({
            url: 'price_change.php',
            datatype: 'json',
            method: 'POST',
            data: {
                num: $('#num').val(),
                price: $('#product_price').val()
            },
            beforeSend: function () {
                if($('#num').val() == "")
                {
                    $('#num').val(0);

                }
                else{
                    $('#num').val(parseInt($('#num').val()));
                }
            }
    }).
        done(function (data) {
            var price1 = JSON.parse(data);
            $('#total_price').text(price1.format + " บาท");
            $('#price').val(price1.value);
        });
    });
    //change number by click
    /*$('#change-num1').add('#change-num2').click(function () {
        $.ajax({
            url: 'price_change.php',
            datatype: 'json',
            method: 'POST',
            data: {
                num: $('#num').val(),
                price: $('#product_price').val()
            },
            beforeSend: function () {
                if($('#num').val() == "")
                {
                    $('#num').val(0);
                }
                else{
                    $('#num').val(parseInt($('#num').val()));
                }
            }
        }).
        done(function (data) {
            var price1 = JSON.parse(data);
            $('#total_price').text(price1.format + " บาท");
            $('#price').val(price1.value);
        });
    });*/
</script>
</body>

</html>

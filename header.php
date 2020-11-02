<?php

//กำหนดเวลาที่สามารถอยู่ในระบบ
session_start();
if (isset($_SESSION['id']))
    console_log($_SESSION['id']);
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

// console_log($_SESSION['f_name']);
//
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TVQP89G');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVQP89G"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--::header part start::-->
<header class="main_menu home_menu">
    <div class="">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"><img class="img-fluid ml-5" src="img/favicon.gif"
                                                                  alt="logo"></img> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item text-right" id="navbarSupportedContent">
                        <div class="col-md-6"></div>
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
                                $page = 'login.php?from=track';

                            }
                            ?>
                            <li class="nav-item">

                                <a class="nav-link" href="<?php echo $page; ?>">
                                    tracking
                                </a>

                            </li>
                            <?php
                            if (isset($_SESSION['id']))
                                $page = 'payment.php';
                            else {
                                $page = 'login.php?from=payment';

                            }
                            ?>
                            <li class="nav-item">

                                <a class="nav-link" href="<?php echo $page; ?>">
                                    payment
                                </a>

                            </li>

                            <?php
                            if (isset($_SESSION['id'])) {
                                ?>
                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link">
                                        logout
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
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
                    <div class="header_icon d-flex align-items-center mr-md-5 mr-sm-5 mr-4">
                        <!-- <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a> -->
                        <?php
                        if (isset($_SESSION['id'])) {
                            $from2 = "cart.php";
                        } else {
                            $from2 = "login.php?from=cart";
                        }
                        ?>
                        <a href="<?php echo $from2; ?>">
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

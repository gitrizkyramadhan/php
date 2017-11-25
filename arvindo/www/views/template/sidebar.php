<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PT. Arvindo</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="shortcut icon" href="aset/img/logo1.png">
        <link rel="stylesheet" href="aset/css/jquery-ui.min.css">
        <link rel="stylesheet" href="aset/js/lib/Sticky/sticky.css">
        <link rel="stylesheet" href="aset/js/lib/datepicker/css/datepicker.css">
        <link rel="stylesheet" href="aset/css/bootstrap.min.css">
        <link rel="stylesheet" href="aset/css/todc-bootstrap.min.css">
        <link rel="stylesheet" href="aset/css/font-awesome/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="aset/css/linecons/style.css?=<?= date('YmdHis') ?>">-->
        <link rel="stylesheet" href="aset/css/retina.css">
        <link rel="stylesheet" href="aset/css/jAlert.css">
        <link rel="stylesheet" href="aset/css/newtable.css">
        <link rel="stylesheet" href="aset/css/style.css?=<?= date('YmdHis') ?>">
        <link rel="stylesheet" href="aset/css/theme/color_3.css">
        <link rel="stylesheet" href="aset/css/custom.css?=<?= date('YmdHis') ?>">

        <script src="aset/js/jquery.min.js"></script>
        <script src="aset/js/jquery-ui.min.js"></script>
        <script src="aset/js/bootstrap.min.js"></script>
        <script src="aset/js/jquery.ba-resize.min.js"></script>
        <script src="aset/js/jquery_cookie.min.js"></script>
        <script src="aset/js/ajaxfileupload.js"></script>
        <script src="aset/js/retina.min.js"></script>
        <script src="aset/js/tinynav.js"></script>
        <script src="aset/js/jquery.sticky.js"></script>
        <script src="aset/js/lib/Sticky/sticky.js"></script>
        <script src="aset/js/lib/jquery.inputmask/jquery.inputmask.bundle.min.js"></script>
        <script src="aset/js/lib/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="aset/js/tinynav.js"></script>
        <script src="aset/js/lib/navgoco/jquery.navgoco.min.js"></script>
        <script src="aset/js/lib/jMenu/js/jMenu.jquery.js"></script>
        <script src="aset/js/lib/typeahead.js/typeahead.min.js"></script>
        <script src="aset/js/lib/typeahead.js/hogan-2.0.0.js"></script>
        <script src="aset/js/ebro_common.js"></script>
        <script src="aset/js/jAlert.min.js"></script>
        <script src="aset/js/newtable.js?v=<?= date('YmdHis') ?>"></script>
        <script src="aset/js/myscript.js?v=<?= date('YmdHis') ?>"></script>

        <script>
            var site_url = "<?= site_url(); ?>";
            var base_url = "<?= base_url(); ?>";
            var app_name = 'e-Watch Management';
            $(document).ready(function () {
                if (window.location.hash === '') {
                    window.location.hash = '#front/home';
                }
                $('.nemucurrent').click(function () {
                    $(this).parent().children('li').removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>
    </head>
    <body class="full_width" >
        <div id="wrapper_all">
            <?php if ($this->newsession->userdata('logged_in')) { ?>
                <div style="position: absolute; top: 4px; left: 10px; color: #fff; width: 90%;">Selamat Datang <b style="color:#bfb"><?= $this->newsession->userdata('U_NAME'); ?></b>, Anda login sebagai <span style="color:#bfb"><?= $this->newsession->userdata('T_ROLE') . ', ' . $this->newsession->userdata('T_FLAG') ?></span></div>
            <?php } ?>
            <nav id="top_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2 col-sm-1 right">
							<h1 style="margin-top:0;font-size:800%; color:white;">A</h1>
                            <!--<img src="<?= base_url() . 'aset/img/logo-kemkes.png'?>">-->
                        </div>
                        <div class="col-xs-10 col-sm-4">
                            <h3 class="flogo consolas">E-Watch</h3>
                            <p class="cwhite consolas" style="font-size: 11pt;">
                                PT. Arvindo Cipta Gemilang<br>
                                Management Resource Application
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <ul id="text_nav_h" class="clearfix top_ico_nav" style="float: right;">
                                <?= $menulist ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <nav id="mobile_navigation"></nav>
            <section class="container clearfix main_section">
                <div id="main_content_outer" class="clearfix">
                    <div id="main_content"><?= $main_content ?></div>
                </div>
            </section>
            <div id="footer_space"></div>
        </div>
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        &copy; 2016 @heartworkscreative.com
                    </div>
                    <div class="col-sm-1" style="float: right">
                        <!-- <small class="text-muted">v1.0</small> -->
                    </div>
                </div>
            </div>
        </footer>

        <script src="aset/js/lib/jquery-steps/jquery.steps.min.js?v=<?= date('YmdHis'); ?>"></script>
        <script src="aset/js/lib/parsley/parsley.min.js?v=<?= date('YmdHis'); ?>"></script>
        <script src="aset/js/pages/ebro_wizard.js?v=<?= date('YmdHis'); ?>"></script>
    </body>
</html>

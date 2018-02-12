<html lang="fr" ng-app="afApp">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>AFRIMARINE KAMSAR</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Uri::create('assets/img/favicon.ico') ?>"/>
        <?php echo Asset::css(array('bootstrap.css', 'main.css', 'responsive.css', 'dataTables.css', 'icons.css', 'font-awesome.min.css', 'css', 'msg.css', 'chosen.css')); ?>
        <?php echo Asset::js(array('angular.js', 'jquery.js', 'jqueryinputmask.js', 'bootstrap.js', 'msg.js', 'dataTables.js', 'Util.js', 'chosen.js', 'app.js')); ?>
        <script>
            $(document).ready(function() {
                App.init();                
            });
            var resize = function() {
                $('body').css('height', '0px');
                var winH = $(window).height();
                var menuH = 100; //Hauteur du header et du breadcrumb 

                $('#main-content').css({'height': parseInt(winH - menuH) + 'px'});
                $(window).resize(function() {
                    var winH = $(window).height();
                    $('#main-content').css({'height': parseInt(winH - menuH) + 'px'});
                });
            };
            var initForm = function() {
                Util.chosen();
                $('input[type="datetime"]').inputmask();
            };
            var refreshFactureState = function() {
                $(".factureState").each(function(index) {
                    var text = $(this).text().trim();
                    if (text == "NON ENVOYEE")
                        $(this).addClass('label-danger');
                    if (text == "ENVOYEE NON PAYEE")
                        $(this).addClass('label-warning');
                    if (text == "ENVOYEE PAYEE")
                        $(this).addClass('label-success');

                });
            };
            var uploadEnd = function($type, msg) {
                if ($type === "1") {
                    $('.alert-success').html(msg).fadeIn();
                    Util.resetForm('#frmMsg');
                }
                else
                    $('.alert-danger').html(msg).fadeIn();

            };

        </script>                 
    </head>
    <script> var baseUrl = "<?php echo Uri::create('/') ?>";</script>
    <body class="<?php echo Session::get('admin') ? "" : "login" ?>" onload="resize()">
        <?php if (Session::get("admin")): ?>           
            <?php echo render('header'); ?>       
            <div id="container" class="fixed-header">
                <?php echo render('menu'); ?>  
                <div id="content">
                    <div class="container" onmouseover="resize()">
                        <div ng-view>
                            
                        </div>
                    </div>
                </div>
            </div>  
            <?php echo Asset::js(array('custom.js', 'service.js', 'application.js')) ?>
        <?php else: ?>
            <?php include 'login.php' ?>
        <?php endif; ?> 
    </body>
</html>
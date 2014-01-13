<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?= $lang_array['title'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/css/pages/error.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-toastr/toastr.min.css">
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $lang_array['title'] ?></h2>
            <div class="well-lg">
                <?= $lang_array['description'] ?>
            </div>
            <form role="form">
                <h3 class="form-section">Налаштування MySQL</h3>
                <div class="form-body">
                    123213
                </div>
                <h3 class="form-section">Профіль адміністратора</h3>
                <div class="form-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?= $lang_array['label_login'] ?></label>
                        <div class="input-icon">
                            <i class="icon-user"></i>
                            <input type="text" class="form-control" id="admin-login" placeholder="admin">
                        </div>
                        <span class="help-block"><?= $lang_array['label_login_help'] ?></span>
                    </div>
                    <div class="form-group">
                        <label><?= $lang_array['label_email'] ?></label>
                        <div class="input-icon">
                            <i class="icon-envelope"></i>
                            <input type="text" class="form-control" id="admin-email" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><?= $lang_array['label_password'] ?></label>
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <input type="text" class="form-control" id="admin-password" placeholder="">
                        </div>
                    </div>
                </div>
                <h3 class="form-section">Налаштування адресації</h3>
                <div class="form-body">
                    123213
                </div>
                <h3 class="form-section">Безпека та системи захисту</h3>
                <div class="form-body">
                    123213
                </div>
                <h3 class="form-section">Налаштування мов системи управління</h3>
                <div class="form-body">
                    123213
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue"><?= $lang_array['label_button_install'] ?></button>
                    <button type="clear" class="btn default"><?= $lang_array['label_button_clear'] ?></button>
                </div>
            </form>
            <div class="portlet solid bordered light-grey">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-bar-chart"></i><?= $lang_array['label_config'] ?></div>
                </div>
                <div class="portlet-body">
                    <div class="help-block"><i>Перевірте поточні налаштування перш ніж натискати кнопку "Встановити"</i></div>
                    <div class="well-lg">
                        Буде встановлено наступні плагіни:
                        <p>
                        <ul>
                            <li>Dummy</li>
                            <li>Новини</li>
                            <li>Блог</li>
                            <li>Онлайн-магазин</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/plugins/respond.min.js"></script>
<script src="/assets/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<script src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>
<!-- END CORE PLUGINS -->
<script src="/assets/scripts/app.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
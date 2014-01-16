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
        <div class="col-md-8">
            <h2><?= $lang_array['title'] ?></h2>
            <div class="well-lg">
                <?= $lang_array['description'] ?>
            </div>
            <form role="form">
                <h3 class="form-section"><?= $lang_array['group_mysql'] ?></h3>
                <div class="form-body">
                    <div class="form-group">
                        <label for="mysql-hostname"><?= $lang_array['label_hostname'] ?></label>
                        <div class="input-icon">
                            <i class="icon-globe"></i>
                            <input type="text" class="form-control not-empty mysql-group" name="mysql-hostname" placeholder="localhost" value="localhost">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mysql-database"><?= $lang_array['label_database'] ?></label>
                        <div class="input-icon">
                            <i class="icon-hdd"></i>
                            <input type="text" class="form-control not-empty mysql-group" name="mysql-database" placeholder="" value="abton3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mysql-login"><?= $lang_array['label_username'] ?></label>
                        <div class="input-icon">
                            <i class="icon-user"></i>
                            <input type="text" class="form-control not-empty mysql-group" name="mysql-login" placeholder="" value="root">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mysql-password"><?= $lang_array['label_password'] ?></label>
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <input type="password" class="form-control mysql-group" name="mysql-password" placeholder="" value="root">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mysql-prefix"><?= $lang_array['label_tableprefix'] ?></label>
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <input type="text" class="form-control mysql-group not-empty" name="mysql-prefix" placeholder="a3_" value="a3_">
                        </div>
                    </div>
                    <button type="button" class="btn default yellow" id="test-connection"><i class="icon-refresh"></i> <?= $lang_array['label_button_test'] ?></button>
                </div>
                <h3 class="form-section"><?= $lang_array['group_admin'] ?></h3>
                <div class="form-body">
                    <div class="form-group">
                        <label for="admin-login"><?= $lang_array['label_login'] ?></label>
                        <div class="input-icon">
                            <i class="icon-user"></i>
                            <input type="text" class="form-control not-empty" name="admin-login" placeholder="admin" value="admin">
                        </div>
                        <span class="help-block"><?= $lang_array['label_login_help'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="admin-email"><?= $lang_array['label_email'] ?></label>
                        <div class="input-icon">
                            <i class="icon-envelope"></i>
                            <input type="text" class="form-control not-empty" name="admin-email" placeholder="" value="dkkrid@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="admin-password"><?= $lang_array['label_password'] ?></label>
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <input type="text" class="form-control not-empty" name="admin-password" placeholder="" value="123">
                        </div>
                    </div>
                </div>
                <h3 class="form-section"><?= $lang_array['group_security'] ?></h3>
                <div class="form-body">
                    <div class="form-group">
                        <label><?= $lang_array['label_hashfunc'] ?></label>
                        <select class="form-control" name="security-hash-func">
                            <option value="sha512,128">SHA 512 (рекомендовано)</option>
                            <option value="sha256,64">SHA 256</option>
                            <option value="sha1,40">SHA 1</option>
                            <option value="md5,32">md5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="security-use-salt" value="true" checked> <?= $lang_array['label_use_salt'] ?>
                    </div>
                </div>
                <h3 class="form-section"><?= $lang_array['group_misc'] ?></h3>
                <div class="form-body">
                    <div class="form-group">
                        <label for="misc-siteurl"><?= $lang_array['label_siteurl'] ?></label>
                        <div class="input-icon">
                            <i class="icon-globe"></i>
                            <input type="text" class="form-control not-empty" name="misc-siteurl" placeholder="http://www.site.com" value="123.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="misc-prefix"><?= $lang_array['label_cmsprefix'] ?></label>
                        <div class="input-icon">
                            <i class="icon-globe"></i>
                            <input type="text" class="form-control not-empty" name="misc-prefix" placeholder="admin" value="admin">
                        </div>
                        <span class="help-block"><?= $lang_array['label_cmsprefix_help'] ?></span>
                    </div>
                    <div class="form-group">
                        <label><?= $lang_array['label_l10n_available'] ?>:</label>
                        <input type="checkbox" class="form-control misc-langs" name="misc-langs[]" value="ua" checked> українська
                    </div>
                    <div class="form-group">
                        <label><?= $lang_array['label_l10n_default'] ?></label>
                        <select class="form-control" name="misc-l10n-default">
                            <option value="ua">українська</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="submit-install" class="btn blue"><?= $lang_array['label_button_install'] ?></button>
                    <button type="clear" class="btn default"><?= $lang_array['label_button_clear'] ?></button>
                </div>
            </form>
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
<script src="/assets/scripts/abton/install.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();

        // инициализация языковых переменных скриптов
        var lang_array = {
            validate_error: "<?= $lang_array['validate_error'] ?>",
            validate_field_empty: "<?= $lang_array['validate_field_empty'] ?>",

            test_success_title: "<?= $lang_array['test_success_title'] ?>",
            test_success_message: "<?= $lang_array['test_success_message'] ?>",
            test_error_title: "<?= $lang_array['test_error_title'] ?>",
            test_error_message: "<?= $lang_array['test_error_message'] ?>",

            install_success_title: "<?= $lang_array['install_success_title'] ?>",
            install_success_message: "<?= $lang_array['install_success_message'] ?>"
        };

        var test_db_ajax = '<?= $test_db_ajax; ?>';
        var install_ajax = '<?= $install_ajax; ?>';
        $.ajaxSetup({
            data: {
                token: '<?= $token ?>'
            },
            dataType: 'json'
        });

        a3_Install.init(lang_array, test_db_ajax, install_ajax); // обработка элементов страницы

        <?= Instance_Messages::get()->getMessagesScript(); ?>
    });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
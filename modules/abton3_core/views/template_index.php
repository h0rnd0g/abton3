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
    <title><?= $plugin_array['title'].$template_array['title'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-toastr/toastr.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
<!-- BEGIN TOP NAVIGATION BAR -->
<div class="header-inner">
<!-- BEGIN LOGO -->
<a class="navbar-brand" href="<?= Instance_Routing::get()->makeUrl('') ?>">
    <img src="/assets/img/logo-big.png" alt="logo" class="img-responsive" />
</a>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <img src="/assets/img/menu-toggler.png" alt="" />
</a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN TOP NAVIGATION MENU -->
<ul class="nav navbar-nav pull-right">
<!-- BEGIN INBOX DROPDOWN -->
<li class="dropdown" id="header_inbox_bar">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <i class="icon-envelope"></i>
<!--        <span class="badge">5</span>--><!-- TODO: badge for messaging -->
    </a>
    <ul class="dropdown-menu extended inbox">
        <li>
            <p><?= $template_array['user_messages_empty'] ?></p>
        </li>
<!--        <li>-->
<!--            <ul class="dropdown-menu-list scroller" style="height: 250px;">-->
<!--                <li>-->
<!--                    <a href="inbox.html?a=view">-->
<!--                        <span class="photo"><img src="./assets/img/avatar2.jpg" alt=""/></span>-->
<!--                           <span class="subject">-->
<!--                           <span class="from">Lisa Wong</span>-->
<!--                           <span class="time">Just Now</span>-->
<!--                           </span>-->
<!--                           <span class="message">-->
<!--                           Vivamus sed auctor nibh congue nibh. auctor nibh-->
<!--                           auctor nibh...-->
<!--                           </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="inbox.html?a=view">-->
<!--                        <span class="photo"><img src="./assets/img/avatar3.jpg" alt=""/></span>-->
<!--                           <span class="subject">-->
<!--                           <span class="from">Richard Doe</span>-->
<!--                           <span class="time">16 mins</span>-->
<!--                           </span>-->
<!--                           <span class="message">-->
<!--                           Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh-->
<!--                           auctor nibh...-->
<!--                           </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="inbox.html?a=view">-->
<!--                        <span class="photo"><img src="./assets/img/avatar1.jpg" alt=""/></span>-->
<!--                           <span class="subject">-->
<!--                           <span class="from">--><?//= $user->getRepresentativeName() ?><!--</span>-->
<!--                           <span class="time">2 hrs</span>-->
<!--                           </span>-->
<!--                           <span class="message">-->
<!--                           Vivamus sed nibh auctor nibh congue nibh. auctor nibh-->
<!--                           auctor nibh...-->
<!--                           </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="inbox.html?a=view">-->
<!--                        <span class="photo"><img src="./assets/img/avatar2.jpg" alt=""/></span>-->
<!--                           <span class="subject">-->
<!--                           <span class="from">Lisa Wong</span>-->
<!--                           <span class="time">40 mins</span>-->
<!--                           </span>-->
<!--                           <span class="message">-->
<!--                           Vivamus sed auctor 40% nibh congue nibh...-->
<!--                           </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="inbox.html?a=view">-->
<!--                        <span class="photo"><img src="./assets/img/avatar3.jpg" alt=""/></span>-->
<!--                           <span class="subject">-->
<!--                           <span class="from">Richard Doe</span>-->
<!--                           <span class="time">46 mins</span>-->
<!--                           </span>-->
<!--                           <span class="message">-->
<!--                           Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh-->
<!--                           auctor nibh...-->
<!--                           </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
        <li class="external">
            <a href="inbox.html"><?= $template_array['user_messages_goto'] ?> <i class="m-icon-swapright"></i></a>
        </li>
    </ul>
</li>
<!-- END INBOX DROPDOWN -->
<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown user">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <img alt="" src="/assets/img/no-avatar-min.png"/>
        <span class="username"><?= $user->getRepresentativeName() ?></span>
        <i class="icon-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li><a href="<?= Instance_Routing::get()->route('core_profile_edit') ?>"><i class="icon-user"></i> <?= $template_array['user_menu_profile'] ?></a>
        </li>
        <li><a href="inbox.html"><i class="icon-envelope"></i> <?= $template_array['user_menu_messages'] ?> <span class="badge badge-default">0</span></a>
        </li>
        <li class="divider"></li>
        <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> <?= $template_array['user_menu_fullscreen'] ?></a>
        </li>
        <!-- TODO: create lockscreen -->
        <!-- <li><a href="extra_lock.html"><i class="icon-lock"></i> <?= $template_array['user_menu_lockscreen'] ?></a> -->
        </li>
        <li><a href="<?= Instance_Routing::get()->route('core_loginscreen') ?>"><i class="icon-key"></i> <?= $template_array['user_menu_logout'] ?></a>
        </li>
    </ul>
</li>
<!-- END USER LOGIN DROPDOWN -->
</ul>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu">
    <li>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler hidden-phone"></div>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    </li>
    <li>
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <form class="sidebar-search" action="extra_search.html" method="POST">
            <div class="form-container">
                <div class="input-box">
                    <a href="javascript:;" class="remove"></a>
                    <input type="text" placeholder="<?= $template_array['search_placeholder'] ?>"/>
                    <input type="button" class="submit" value=" "/>
                </div>
            </div>
        </form>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
    </li>

    <!-- Меню CMS -->

    <? $iter_count = 0; ?>
    <? foreach ($menu as $item): ?>
        <?
            $this_selected = false;
            $class = "";
            $span_selected = "";
            if (isset($plugin_name) and ($plugin_name == $item['name']))
            {
                $class = "active";
                $span_selected = '<span class="selected"></span>';
                $this_selected = true;
            }

            if ($iter_count == 0)
                $class .= " start";
        ?>

        <? if (count($item['tree']) == 1) { ?>
            <!-- Вывод корневого элемента (если он один) -->
            <li class="<?= $class ?>">
                <a href="<?= $item['tree'][0]['href'] ?>">
                    <i class="icon-<?= $item['tree'][0]['icon'] ?>"></i>
                    <span class="title"><?= $item['tree'][0]['title'] ?></span>
                    <?= $span_selected ?>
                </a>
            </li>
        <? } else { ?>
            <!-- Вывод корневого элемента -->
            <li class="<?= $class ?>">
                <a href="javascript:;">
                    <i class="icon-<?= $item['tree'][0]['icon'] ?>"></i>
                    <span class="title"><?= $item['tree'][0]['title'] ?></span>
                    <?= $span_selected ?>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <? for ($i = 1; $i < count($item['tree']); $i++): ?>
                        <?
                            $class = "";
                            if ((Request::$current->action() == $item['tree'][$i]['action']) and ($this_selected))
                                $class = "active";
                        ?>
                        <li class="<?= $class ?>">
                            <a href="<?= $item['tree'][$i]['href'] ?>">
                                <?= $item['tree'][$i]['title'] ?>
                            </a>
                        </li>
                    <? endfor; ?>
                </ul>
            </li>
        <? } ?>

        <? $iter_count++; ?>
    <? endforeach; ?>
</ul>
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE -->
<div class="page-content">
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                Widget settings form goes here
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler"></div>
    <div class="toggler-close"></div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span><?= $template_array['theme_picker_title'] ?></span>
            <ul>
                <li class="color-black current color-default" data-style="default"></li>
                <li class="color-blue" data-style="blue"></li>
                <li class="color-brown" data-style="brown"></li>
                <li class="color-purple" data-style="purple"></li>
                <li class="color-grey" data-style="grey"></li>
                <li class="color-white color-light" data-style="light"></li>
            </ul>
        </div>
        <div class="theme-option">
            <span><?= $template_array['theme_picker_layout'] ?></span>
            <select class="layout-option form-control input-small">
                <option value="fluid" selected="selected"><?= $template_array['theme_picker_layout_fluid'] ?></option>
                <option value="boxed"><?= $template_array['theme_picker_layout_boxed'] ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $template_array['theme_picker_header'] ?></span>
            <select class="header-option form-control input-small">
                <option value="fixed" selected="selected"><?= $template_array['theme_picker_header_fixed'] ?></option>
                <option value="default"><?= $template_array['theme_picker_header_default'] ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $template_array['theme_picker_menu'] ?></span>
            <select class="sidebar-option form-control input-small">
                <option value="fixed"><?= $template_array['theme_picker_menu_fixed'] ?></option>
                <option value="default" selected="selected"><?= $template_array['theme_picker_menu_default'] ?></option>
            </select>
        </div>
        <div class="theme-option">
            <span><?= $template_array['theme_picker_footer'] ?></span>
            <select class="footer-option form-control input-small">
                <option value="fixed"><?= $template_array['theme_picker_footer_fixed'] ?></option>
                <option value="default" selected="selected"><?= $template_array['theme_picker_footer_default'] ?></option>
            </select>
        </div>
    </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            <?= $plugin_array['title'] ?> <?= isset($plugin_array['description']) ? "<small>{$plugin_array['description']}</small>" : '' ?>
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?= Instance_Routing::get()->makeUrl('') ?>"><?= $template_array['breadcrumb_home_link'] ?></a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="javascript:none;"><?= $plugin_array['title'] ?></a></li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <?= isset($content) ? $content : 'empty' ?>
        </div> <!-- костыль Metronic -->
    </div>
</div>
<!-- END PAGE CONTENT-->
<!-- BEGIN PAGE -->
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        <?= $template_array['index_copyright'] ?>
    </div>
    <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
    </div>
</div>
<!-- END FOOTER -->
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery.pulsate.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery-bootpag/jquery.bootpag.min.js"></script>
<script type="text/javascript" src="/assets/plugins/holder.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/scripts/app.js"></script>
<script src="/assets/scripts/ui-general.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        UIGeneral.init();

        <?= Instance_Messages::get()->getMessagesScript(); ?>
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
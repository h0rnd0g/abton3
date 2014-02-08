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
<a class="navbar-brand" href="index.html">
    <img src="/assets/img/logo.png" alt="logo" class="img-responsive" />
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
        <span class="badge">5</span>
    </a>
    <ul class="dropdown-menu extended inbox">
        <li>
            <p>You have 12 new messages</p>
        </li>
        <li>
            <ul class="dropdown-menu-list scroller" style="height: 250px;">
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo"><img src="./assets/img/avatar2.jpg" alt=""/></span>
                           <span class="subject">
                           <span class="from">Lisa Wong</span>
                           <span class="time">Just Now</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor nibh congue nibh. auctor nibh
                           auctor nibh...
                           </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo"><img src="./assets/img/avatar3.jpg" alt=""/></span>
                           <span class="subject">
                           <span class="from">Richard Doe</span>
                           <span class="time">16 mins</span>
                           </span>
                           <span class="message">
                           Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
                           auctor nibh...
                           </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo"><img src="./assets/img/avatar1.jpg" alt=""/></span>
                           <span class="subject">
                           <span class="from"><?= $user->getRepresentativeName() ?></span>
                           <span class="time">2 hrs</span>
                           </span>
                           <span class="message">
                           Vivamus sed nibh auctor nibh congue nibh. auctor nibh
                           auctor nibh...
                           </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo"><img src="./assets/img/avatar2.jpg" alt=""/></span>
                           <span class="subject">
                           <span class="from">Lisa Wong</span>
                           <span class="time">40 mins</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor 40% nibh congue nibh...
                           </span>
                    </a>
                </li>
                <li>
                    <a href="inbox.html?a=view">
                        <span class="photo"><img src="./assets/img/avatar3.jpg" alt=""/></span>
                           <span class="subject">
                           <span class="from">Richard Doe</span>
                           <span class="time">46 mins</span>
                           </span>
                           <span class="message">
                           Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
                           auctor nibh...
                           </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="external">
            <a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
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
        <li><a href="extra_lock.html"><i class="icon-lock"></i> <?= $template_array['user_menu_lockscreen'] ?></a>
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
<li class="start ">
    <a href="index.html">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
    </a>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-cogs"></i>
        <span class="title">Layouts</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="layout_language_bar.html">
                <span class="badge badge-roundless badge-important">new</span>Language Switch Bar</a>
        </li>
        <li >
            <a href="layout_horizontal_sidebar_menu.html">
                Horizontal & Sidebar Menu</a>
        </li>
        <li >
            <a href="layout_horizontal_menu1.html">
                Horizontal Menu 1</a>
        </li>
        <li >
            <a href="layout_horizontal_menu2.html">
                Horizontal Menu 2</a>
        </li><li >
            <a href="layout_disabled_menu.html">
                Disabled Menu Links</a>
        </li>
        <li >
            <a href="layout_sidebar_fixed.html">
                Sidebar Fixed Page</a>
        </li>
        <li >
            <a href="layout_sidebar_closed.html">
                Sidebar Closed Page</a>
        </li>
        <li >
            <a href="layout_blank_page.html">
                Blank Page</a>
        </li>
        <li >
            <a href="layout_boxed_page.html">
                Boxed Page</a>
        </li>
        <li >
            <a href="layout_boxed_not_responsive.html">
                Non-Responsive Boxed Layout</a>
        </li>
        <li >
            <a href="layout_promo.html">
                Promo Page</a>
        </li>
        <li >
            <a href="layout_email.html">
                Email Templates</a>
        </li>
        <li >
            <a href="layout_ajax.html">
                Content Loading via Ajax</a>
        </li>
    </ul>
</li>
<li class="tooltips" data-placement="left" data-original-title="Frontend&nbsp;Theme For&nbsp;Metronic&nbsp;Admin">
    <a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
        <i class="icon-gift"></i>
        <span class="title">Frontend Theme</span>
    </a>
</li>
<li class="active ">
    <a href="javascript:;">
        <i class="icon-bookmark-empty"></i>
        <span class="title">UI Features</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="active">
            <a href="ui_general.html">
                General</a>
        </li>
        <li >
            <a href="ui_buttons.html">
                Buttons</a>
        </li>
        <li >
            <a href="ui_typography.html">
                Typography</a>
        </li>
        <li >
            <a href="ui_modals.html">
                Modals</a>
        </li>
        <li>
            <a href="ui_extended_modals.html">
                Extended Modals</a>
        </li>
        <li >
            <a href="ui_tabs_accordions_navs.html">
                Tabs, Accordions & Navs</a>
        </li>
        <li >
            <a href="ui_tiles.html">
                Tiles</a>
        </li>
        <li >
            <a href="ui_toastr.html">
                <span class="badge badge-roundless badge-warning">new</span>Toastr Notifications</a>
        </li>
        <li >
            <a href="ui_tree.html">
                Tree View</a>
        </li>
        <li >
            <a href="ui_nestable.html">
                Nestable List</a>
        </li>
        <li >
            <a href="ui_ion_sliders.html">
                <span class="badge badge-roundless badge-important">new</span>Ion Range Sliders</a>
        </li>
        <li >
            <a href="ui_noui_sliders.html">
                <span class="badge badge-roundless badge-success">new</span>NoUI Range Sliders</a>
        </li>
        <li >
            <a href="ui_jqueryui_sliders.html">
                jQuery UI Sliders</a>
        </li>
        <li >
            <a href="ui_knob.html">
                Knob Circle Dials</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-table"></i>
        <span class="title">Form Stuff</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="form_controls.html">
                Form Controls</a>
        </li>
        <li >
            <a href="form_layouts.html">
                Form Layouts</a>
        </li>
        <li >
            <a href="form_component.html">
                Form Components</a>
        </li>
        <li >
            <a href="form_editable.html">
                <span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
        </li>
        <li >
            <a href="form_wizard.html">
                Form Wizard</a>
        </li>
        <li >
            <a href="form_validation.html">
                Form Validation</a>
        </li>
        <li >
            <a href="form_image_crop.html">
                <span class="badge badge-roundless badge-important">new</span>Image Cropping</a>
        </li>
        <li >
            <a href="form_fileupload.html">
                Multiple File Upload</a>
        </li>
        <li >
            <a href="form_dropzone.html">
                Dropzone File Upload</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-sitemap"></i>
        <span class="title">Pages</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="page_portfolio.html">
                <i class="icon-briefcase"></i>
                <span class="badge badge-warning badge-roundless">new</span>Portfolio</a>
        </li>
        <li >
            <a href="page_timeline.html">
                <i class="icon-time"></i>
                <span class="badge badge-info">4</span>Timeline</a>
        </li>
        <li >
            <a href="page_coming_soon.html">
                <i class="icon-cogs"></i>
                Coming Soon</a>
        </li>
        <li >
            <a href="page_blog.html">
                <i class="icon-comments"></i>
                Blog</a>
        </li>
        <li >
            <a href="page_blog_item.html">
                <i class="icon-font"></i>
                Blog Post</a>
        </li>
        <li >
            <a href="page_news.html">
                <i class="icon-coffee"></i>
                <span class="badge badge-success">9</span>News</a>
        </li>
        <li >
            <a href="page_news_item.html">
                <i class="icon-bell"></i>
                News View</a>
        </li>
        <li >
            <a href="page_about.html">
                <i class="icon-group"></i>
                About Us</a>
        </li>
        <li >
            <a href="page_contact.html">
                <i class="icon-envelope-alt"></i>
                Contact Us</a>
        </li>
        <li >
            <a href="page_calendar.html">
                <i class="icon-calendar"></i>
                <span class="badge badge-important">14</span>Calendar</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-gift"></i>
        <span class="title">Extra</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="extra_profile.html">
                User Profile</a>
        </li>
        <li >
            <a href="extra_lock.html">
                Lock Screen</a>
        </li>
        <li >
            <a href="extra_faq.html">
                FAQ</a>
        </li>
        <li >
            <a href="inbox.html">
                <span class="badge badge-important">4</span>Inbox</a>
        </li>
        <li >
            <a href="extra_search.html">
                Search Results</a>
        </li>
        <li >
            <a href="extra_invoice.html">
                Invoice</a>
        </li>
        <li >
            <a href="extra_pricing_table.html">
                Pricing Tables</a>
        </li>
        <li >
            <a href="extra_404_option1.html">
                404 Page Option 1</a>
        </li>
        <li >
            <a href="extra_404_option2.html">
                404 Page Option 2</a>
        </li>
        <li >
            <a href="extra_404_option3.html">
                404 Page Option 3</a>
        </li>
        <li >
            <a href="extra_500_option1.html">
                500 Page Option 1</a>
        </li>
        <li >
            <a href="extra_500_option2.html">
                500 Page Option 2</a>
        </li>
    </ul>
</li>
<li>
    <a class="active" href="javascript:;">
        <i class="icon-leaf"></i>
        <span class="title">3 Level Menu</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="javascript:;">
                Item 1
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li><a href="#">Sample Link 1</a></li>
                <li><a href="#">Sample Link 2</a></li>
                <li><a href="#">Sample Link 3</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                Item 1
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li><a href="#">Sample Link 1</a></li>
                <li><a href="#">Sample Link 1</a></li>
                <li><a href="#">Sample Link 1</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                Item 3
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;">
        <i class="icon-folder-open"></i>
        <span class="title">4 Level Menu</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="javascript:;">
                <i class="icon-cogs"></i>
                Item 1
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="javascript:;">
                        <i class="icon-user"></i>
                        Sample Link 1
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#"><i class="icon-remove"></i> Sample Link 1</a></li>
                        <li><a href="#"><i class="icon-pencil"></i> Sample Link 1</a></li>
                        <li><a href="#"><i class="icon-edit"></i> Sample Link 1</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-user"></i>  Sample Link 1</a></li>
                <li><a href="#"><i class="icon-external-link"></i>  Sample Link 2</a></li>
                <li><a href="#"><i class="icon-bell"></i>  Sample Link 3</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-globe"></i>
                Item 2
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li><a href="#"><i class="icon-user"></i>  Sample Link 1</a></li>
                <li><a href="#"><i class="icon-external-link"></i>  Sample Link 1</a></li>
                <li><a href="#"><i class="icon-bell"></i>  Sample Link 1</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="icon-folder-open"></i>
                Item 3
            </a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-user"></i>
        <span class="title">Login Options</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="login.html">
                Login Form 1</a>
        </li>
        <li >
            <a href="login_soft.html">
                Login Form 2</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-th"></i>
        <span class="title">Data Tables</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="table_basic.html">
                Basic Tables</a>
        </li>
        <li >
            <a href="table_responsive.html">
                Responsive Tables</a>
        </li>
        <li >
            <a href="table_managed.html">
                Managed Tables</a>
        </li>
        <li >
            <a href="table_editable.html">
                Editable Tables</a>
        </li>
        <li >
            <a href="table_advanced.html">
                Advanced Tables</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-file-text"></i>
        <span class="title">Portlets</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="portlet_general.html">
                General Portlets</a>
        </li>
        <li >
            <a href="portlet_draggable.html">
                Draggable Portlets</a>
        </li>
    </ul>
</li>
<li class="">
    <a href="javascript:;">
        <i class="icon-map-marker"></i>
        <span class="title">Maps</span>
        <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="maps_google.html">
                Google Maps</a>
        </li>
        <li >
            <a href="maps_vector.html">
                Vector Maps</a>
        </li>
    </ul>
</li>
<li class="last ">
    <a href="charts.html">
        <i class="icon-bar-chart"></i>
        <span class="title">Visual Charts</span>
    </a>
</li>
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
            <li>
                <a href="javascript:none;">here plugin name</a>
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
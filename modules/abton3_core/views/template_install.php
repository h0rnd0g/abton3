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
    <title>Встановлення системи управління</title>
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
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
            <h2>Встановлення системи управління Abton3 CMS</h2>
            <div class="well">
                Вкажіть основні налаштування для системи управління та натисніть кнопку "Встановити"
            </div>
            <form role="form">
                <div class="form-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Text</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter text">
                        <span class="help-block">A block of help text.</span>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            <span class="input-group-addon"><i class="icon-user"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Left Icon</label>
                        <div class="input-icon">
                            <i class="icon-bell"></i>
                            <input type="text" class="form-control" placeholder="Left icon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Right Icon</label>
                        <div class="input-icon right">
                            <i class="icon-microphone"></i>
                            <input type="text" class="form-control" placeholder="Right icon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Input With Spinner</label>
                        <input class="form-control spinner" type="text" placeholder="Process something">
                    </div>
                    <div class="form-group">
                        <label>Static Control</label>
                        <p class="form-control-static">email@example.com</p>
                    </div>
                    <div class="form-group">
                        <label>Disabled</label>
                        <input type="text" class="form-control" placeholder="Disabled" disabled="">
                    </div>
                    <div class="form-group">
                        <label>Readonly</label>
                        <input type="text" class="form-control" placeholder="Readonly" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Dropdown</label>
                        <select class="form-control">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Multiple Select</label>
                        <select multiple="" class="form-control">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile1">File input</label>
                        <input type="file" id="exampleInputFile1">
                        <p class="help-block">some help text here.</p>
                    </div>
                    <div class="form-group">
                        <label class="">Checkboxes</label>
                        <div class="checkbox-list">
                            <label>
                                <div class="checker"><span><input type="checkbox"></span></div> Checkbox 1
                            </label>
                            <label>
                                <div class="checker"><span><input type="checkbox"></span></div> Checkbox 2
                            </label>
                            <label>
                                <div class="checker disabled"><span><input type="checkbox" disabled=""></span></div> Disabled
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">Inline Checkboxes</label>
                        <div class="checkbox-list">
                            <label class="checkbox-inline">
                                <div class="checker" id="uniform-inlineCheckbox1"><span><input type="checkbox" id="inlineCheckbox1" value="option1"></span></div> Checkbox 1
                            </label>
                            <label class="checkbox-inline">
                                <div class="checker" id="uniform-inlineCheckbox2"><span><input type="checkbox" id="inlineCheckbox2" value="option2"></span></div> Checkbox 2
                            </label>
                            <label class="checkbox-inline">
                                <div class="checker disabled" id="uniform-inlineCheckbox3"><span><input type="checkbox" id="inlineCheckbox3" value="option3" disabled=""></span></div> Disabled
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">Radio</label>
                        <div class="radio-list">
                            <label>
                                <div class="radio" id="uniform-optionsRadios1"><span><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""></span></div> Option 1
                                Option 1
                            </label>
                            <label>
                                <div class="radio" id="uniform-optionsRadios2"><span><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"></span></div> Option 2
                            </label>
                            <label>
                                <div class="radio disabled" id="uniform-optionsRadios3"><span><input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled=""></span></div> Disabled
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">Inline Radio</label>
                        <div class="radio-list">
                            <label class="radio-inline">
                                <div class="radio" id="uniform-optionsRadios4"><span class="checked"><input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked=""></span></div> Option 1
                            </label>
                            <label class="radio-inline">
                                <div class="radio" id="uniform-optionsRadios5"><span><input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"></span></div> Option 2
                            </label>
                            <label class="radio-inline">
                                <div class="radio disabled" id="uniform-optionsRadios6"><span><input type="radio" name="optionsRadios" id="optionsRadios6" value="option3" disabled=""></span></div> Disabled
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue">Submit</button>
                    <button type="button" class="btn default">Cancel</button>
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
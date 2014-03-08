<div class="row" id="edit_navigation_form" style="display: none;">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Редагувати розділ</div>
            </div>
            <div class="portlet-body">
                <form role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Заголовок</label>
                            <input name="edit_title" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Заголовок сторінки</label>
                            <input name="edit_page_title" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Адресна частина</label>
                            <input name="edit_pref" type="text" class="form-control" placeholder="">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label>-->
<!--                                <div class="checker"><span><input name="edit_visible" type="checkbox"></span></div> Відображати у меню-->
<!--                            </label>-->
<!--                        </div>-->
                        <div class="form-group">
                            <label>Контент відповідної сторінки</label>
                            <textarea class="ckeditor form-control" name="edit_content" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ключові слова (SEO)</label>
                            <input name="edit_keywords" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Опис (SEO)</label>
                            <textarea name="edit_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" name="edit_page" pk="" class="btn blue">Зберегти зміни</button>
                        <button type="button" class="btn default" data-dismiss="modal">Відміна</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-list-ol"></i><?= $plugin_array['navigation_table_name'] ?></div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="dd" id="menu_tree">
                    <ol class="dd-list" id="menu">
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="add">
    <div class="col-md-12">
        <div class="portlet box grey">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> Добавити нову сторінку
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Заголовок</label>
                            <input name="add_title" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Заголовок сторінки</label>
                            <input name="add_page_title" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Адресна частина</label>
                            <input name="add_pref" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Контент відповідної сторінки</label>
                            <textarea class="ckeditor form-control" name="add_content" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ключові слова (SEO)</label>
                            <input name="add_keywords" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Опис (SEO)</label>
                            <textarea name="add_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" name="add_navigation" class="btn blue">Добавити</button>
                        <button type="reset" name="reset_add" class="btn default">Очистити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-2" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Видалення розділу</h4>
            </div>
            <div class="modal-body">
                Ви дійсно бажаєте видалити вказаний розділ?<p/><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Відмінити</button>
                <button type="button" name="delete_navigation" pk="" class="btn blue">Видалити</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



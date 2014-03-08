<div class="row" id="edit_article_form" style="display: none;">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Редагувати статтю</div>
            </div>
            <div class="portlet-body">
                <form role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_title'] ?></label>
                            <input type="text" name="edit_title" class="form-control" placeholder="<?= $plugin_array['articles_field_title_placeholder'] ?>">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_pref'] ?></label>
                            <input name="edit_pref" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_preview_img'] ?></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn yellow" name="picker_edit_preview_img" type="button">...</button>
                                </span>
                                <input name="edit_preview_img" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_preview'] ?></label>
                            <textarea class="form-control" name="edit_preview" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_content'] ?></label>
                            <textarea class="ckeditor form-control" name="edit_content" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_seo_keywords'] ?></label>
                            <input type="text" name="edit_keywords" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_seo_description'] ?></label>
                            <textarea class="form-control" name="edit_description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" name="edit_article" pk="" class="btn green">Зберегти зміни</button>
                        <button type="button" name="cancel_article" class="btn default">Відміна</button>
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
                <div class="caption"><i class="icon-cogs"></i> <?= $plugin_array['articles_table_name'] ?></div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" rel="articles" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><?= $plugin_array['articles_field_title'] ?></th>
                            <th><?= $plugin_array['articles_field_date'] ?></th>
                            <th><?= $plugin_array['articles_field_status'] ?></th>
                            <th><?= $plugin_array['articles_field_controls'] ?></th>
                        </tr>
                        </thead>
                        <tbody id="articles">
                        </tbody>
                    </table>
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
                    <i class="icon-reorder"></i> <?= $plugin_array['articles_form_add_title'] ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_title'] ?></label>
                            <input name="add_title" type="text" class="form-control" placeholder="<?= $plugin_array['articles_field_title_placeholder'] ?>">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_pref'] ?></label>
                            <input name="add_pref" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_preview_img'] ?></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn yellow" name="picker_add_preview_img" type="button">...</button>
                                </span>
                                <input name="add_preview_img" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_preview'] ?></label>
                            <textarea name="add_preview" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_content'] ?></label>
                            <textarea class="ckeditor form-control" name="add_content" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_seo_keywords'] ?></label>
                            <input name="add_keywords" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_seo_description'] ?></label>
                            <textarea name="add_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" name="add_article" class="btn blue"><?= $plugin_array['articles_form_add'] ?></button>
                        <button type="reset" name="reset_add" class="btn default"><?= $plugin_array['articles_form_clear'] ?></button>
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
                <h4 class="modal-title"><?= $plugin_array['articles_modal_delete_title'] ?></h4>
            </div>
            <div class="modal-body">
                <?= $plugin_array['articles_modal_delete_body'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Відмінити</button>
                <button type="button" name="delete_article" pk="" class="btn blue">Видалити</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="elfinder_modal" tabindex="-2" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Вкажіть зображення</h4>
            </div>
            <div class="modal-body">
                <div id="elfinder_body"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-cogs"></i> <?= $plugin_array['articles_table_name'] ?></div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
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
                        <tbody>
                        <tr>
                            <td style="min-width: 300px;">Тестовая статья</td>
                            <td>2014-13-02 14:38</td>
                            <td><span class="label label-sm label-success"><?= $plugin_array['articles_status_published'] ?></span></td>
                            <td>
                                <a href="#" class="btn default btn-xs red"><i class="icon-check-empty"></i> <?= $plugin_array['articles_controls_hide'] ?></a>
                                &nbsp;<a class="btn default btn-xs purple" data-toggle="modal" href="#edit"><i class="icon-edit"></i> <?= $plugin_array['articles_controls_edit'] ?></a>
                                &nbsp;<a href="#" class="btn default btn-xs black"><i class="icon-trash"></i> <?= $plugin_array['articles_controls_delete'] ?></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->
<div class="modal fade" id="edit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?= $plugin_array['articles_modal_edit_title'] ?></h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= $plugin_array['articles_field_title'] ?></label>
                            <input type="email" class="form-control" placeholder="<?= $plugin_array['articles_field_title_placeholder'] ?>">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_preview'] ?></label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_content'] ?></label>
                            <textarea class="ckeditor form-control" name="content" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= $plugin_array['articles_field_seo_keywords'] ?></label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?= $plugin_array['articles_field_seo_description'] ?></label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Закрити</button>
                <button type="button" class="btn blue">Зберегти зміни</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
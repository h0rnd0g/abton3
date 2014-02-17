<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-cogs"></i> <?= $plugin_array['feedback_table_name'] ?></div>
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
                            <th><?= $plugin_array['feedback_field_name'] ?></th>
                            <th><?= $plugin_array['feedback_field_email'] ?></th>
                            <th><?= $plugin_array['feedback_field_datetime'] ?></th>
                            <th><?= $plugin_array['feedback_field_content'] ?></th>
                            <th><?= $plugin_array['feedback_field_status'] ?></th>
                            <th><?= $plugin_array['feedback_field_controls'] ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Сергей</td>
                            <td>-</td>
                            <td>2014-13-02 14:38</td>
                            <td>Тестовый отзыв. 123</td>
                            <td><span class="label label-sm label-success"><?= $plugin_array['feedback_status_published'] ?></span></td>
                            <td>
                                <a href="#" class="btn default btn-xs red"><i class="icon-check-empty"></i> <?= $plugin_array['feedback_controls_hide'] ?></a>
                                &nbsp;<a href="#" class="btn default btn-xs purple"><i class="icon-edit"></i> <?= $plugin_array['feedback_controls_edit'] ?></a>
                                &nbsp;<a href="#" class="btn default btn-xs black"><i class="icon-trash"></i> <?= $plugin_array['feedback_controls_delete'] ?></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT -->

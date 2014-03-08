var a3_Plugin = function () {

    var articles = $('#articles');

    var preview_img_field = '';

    var editDOMArticle = function (id) {
        var title = $('[field="title"][pk="'+id+'"]').html();
        var preview = $('[field="preview"][pk="'+id+'"]').html();
        var content = $('[field="content"][pk="'+id+'"]').html();
        var pref = $('[field="pref"][pk="'+id+'"]').html();
        var preview_img = $('[field="preview_img"][pk="'+id+'"]').html();
        var keywords = $('[field="keywords"][pk="'+id+'"]').html();
        var description = $('[field="description"][pk="'+id+'"]').html();

        CKEDITOR.instances.edit_content.setData(content);
        $('[name="edit_title"]').val(title);
        $('[name="edit_preview"]').val(preview);
        $('[name="edit_pref"]').val(pref);
        $('[name="edit_preview_img"]').val(preview_img);
        $('[name="edit_keywords"]').val(keywords);
        $('[name="edit_description"]').val(description);

        $('button[name="edit_article"]').attr('pk', id);

        $('#edit_article_form').slideDown();

        $('html, body').animate({
            scrollTop: 0
        }, 500);

        App.unblockUI($('#edit_article_form'));
    }

    var deleteArticle = function (id) {
        App.blockUI(articles);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'delete_article',
                article_id: id
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        refreshTable();
                    }
                    else
                    {
                        console.log('error');
                        App.unblockUI(articles);
                    }
                },
            complete:
                function () {
                }
        });

    }

    var saveArticle = function (id) {
        App.blockUI($('#edit_article_form'));

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'edit_article',
                article_id: id,
                active: $('[field="status"][pk="'+id+'"]').attr('data'),
                title: $('[name="edit_title"]').val(),
                preview: $('[name="edit_preview"]').val(),
                content: CKEDITOR.instances.edit_content.getData(),
                pref: $('[name="edit_pref"]').val(),
                preview_img: $('[name="edit_preview_img"]').val(),
                added: $('[field="added"][pk="'+id+'"]').html(),
                seo_description: $('[name="edit_description"]').val(),
                seo_keywords: $('[name="edit_keywords"]').val()
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        $('#edit_article_form').hide();

                        $('html, body').animate({
                            scrollTop: 0
                        }, 500);

                        refreshTable();
                    }
                    else
                    {
                        console.log('error');
                    }
                },
            complete:
                function () {
                }
        });
    }

    var changeArticleStatus = function (id, status)
    {
        App.blockUI(articles);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'change_article_status',
                article_id: id,
                active: status
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        refreshTable()
                    }
                    else
                    {
                        console.log('error');
                        App.unblockUI(articles);
                    }
                },
            complete:
                function () {
                }
        });
    }

    var addDOMArticle = function (id, active, title, preview, content, pref, preview_img, seo_description, seo_keywords, added) {

        // спрятанные данные
        var _preview = '<div style="display: none;" pk="'+id+'" field="preview">'+preview+'</div>';
        var _content = '<div style="display: none;" pk="'+id+'" field="content">'+content+'</div>';
        var _keywords = '<div style="display: none;" pk="'+id+'" field="keywords">'+seo_keywords+'</div>';
        var _description = '<div style="display: none;" pk="'+id+'" field="description">'+seo_description+'</div>';
        var _pref = '<div style="display: none;" pk="'+id+'" field="pref">'+pref+'</div>';
        var _preview_img = '<div style="display: none;" pk="'+id+'" field="preview_img">'+preview_img+'</div>';

        var _title = '<td pk="'+id+'" field="title" style="min-width: 300px;">'+title+'</td>';
        var _added = '<td pk="'+id+'" field="added">'+added+'</td>';

        var status = ''; var status_action = '';
        if (active == '1')
        {
            status = '<td><span pk="'+id+'" field="status" data="1" class="label label-sm label-success">'+articles_status_published+'</span></td>';
            status_action = '<a href="javascript:;" pk="'+id+'" action="disable" class="btn default btn-xs red"><i class="icon-check-empty"></i> '+articles_controls_hide+'</a>';
        }
        else
        {
            status = '<td><span pk="'+id+'" field="status" data="0" class="label label-sm label-danger">'+articles_status_moderating+'</span></td>';
            status_action = '<a href="javascript:;" pk="'+id+'" action="enable" class="btn default btn-xs green"><i class="icon-check"></i> '+articles_controls_publish+'</a>';
        }

        var edit_action = '&nbsp;<a pk="'+id+'" action="edit" class="btn default btn-xs purple"><i class="icon-edit"></i> '+articles_controls_edit+'</a>';
        var delete_action = '&nbsp;<a pk="'+id+'" action="delete" href="javascript:;" class="btn default btn-xs black"><i class="icon-trash"></i> '+articles_controls_delete+'</a>';

        // линкуем спрятанные данные в controls
        var controls = '<td>'+status_action+edit_action+delete_action+_preview+_content+_pref+_preview_img+_description+_keywords+'</td>';

        var article_html =
            '<tr type="article" pk="'+id+'">' +
                _title +
                _added +
                status +
                controls +
            '</tr>';

        articles.append(article_html);
    }

    var addArticle = function () {
        App.blockUI($('#add'));

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'add_article',
                active: 0,
                title: $('[name="add_title"]').val(),
                preview: $('[name="add_preview"]').val(),
                content: CKEDITOR.instances.add_content.getData(),
                pref: $('[name="add_pref"]').val(),
                preview_img: $('[name="add_preview_img"]').val(),
                seo_description: $('[name="add_description"]').val(),
                seo_keywords: $('[name="add_keywords"]').val()
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        toastr.success(articles_msg_added, articles_msg_added_body);
                        refreshTable();
                        $('button[name="reset_add"]').click();
                        CKEDITOR.instances.add_content.setData('');
                    }
                    else
                    {
                        console.log('error');
                        toastr.error(articles_msg_error, articles_msg_error_body);
                    }
                },
            complete:
                function () {
                    App.unblockUI($('#add'));
                }
        });
    }

    var refreshTable = function () {
        App.blockUI(articles);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'get_articles'
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        articles.empty();

                        if (data.articles.length == 0)
                        {
                            articles.append('<tr><td colspan="4">'+articles_table_empty+'</td></tr>');
                        }
                        else
                        {
                            $.each(data.articles, function() {
                                addDOMArticle(this.id, this.active, this.title, this.preview, this.content, this.pref, this.preview_img, this.seo_description, this.seo_keywords, this.added);
                            });
                        }
                    }
                    else
                    {
                        console.log('error');
                        toastr.error(articles_msg_error, articles_msg_error_body);
                    }
                },
            complete:
                function () {
                    App.unblockUI(articles);
                }
        });
    }

    return {
        init: function ()
        {
            $('.reload[rel="articles"]').click(function () {
                refreshTable();
            });

            $('body').on('click', '[action="edit"]', function () {
                var id = $(this).attr('pk');

                editDOMArticle(id);
            });

            $('body').on('click', '[action="enable"]', function () {
                var id = $(this).attr('pk');

                changeArticleStatus(id, 1);
            });

            $('body').on('click', '[action="disable"]', function () {
                var id = $(this).attr('pk');

                changeArticleStatus(id, 0);
            });

            $('body').on('click', '[action="delete"]', function () {
                var id = $(this).attr('pk');
                var title = $('[field="title"][pk="'+id+'"]').html();

                $('button[name="delete_article"]').attr('pk', id);
                $('a.article_title').html('"'+title+'"');

                $('#delete').modal();
            });

            $('body').on('click', 'button[name="delete_article"]', function () {
                var id = $(this).attr('pk');

                deleteArticle(id);
                $('#delete').modal('hide');
            });

            $('body').on('click', 'button[name="edit_article"]', function () {
                var id = $(this).attr('pk');

                saveArticle(id);
            });

            $('body').on('click', 'button[name="cancel_article"]', function () {
                $('#edit_article_form').hide();

                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            });

            $('body').on('click', 'button[name="add_article"]', function () {
                addArticle();
            });

            $('body').on('click', 'button[name="picker_add_preview_img"]', function () {

                preview_img_field = 'add_preview_img';

                $('#elfinder_body').elfinder({
                    url : '/assets/plugins/elfinder/php/connector.php',
                    getFileCallback : function(file) {
                        $('input[name="'+preview_img_field+'"]').val(file);
                        $('#elfinder_modal').modal('hide');
                    },
                    resizable: false
                }).elfinder('instance');

                $('#elfinder_modal').modal();
            });

            $('body').on('click', 'button[name="picker_edit_preview_img"]', function () {

                preview_img_field = 'edit_preview_img';

                $('#elfinder_body').elfinder({
                    url : '/assets/plugins/elfinder/php/connector.php',
                    getFileCallback : function(file) {
                        $('input[name="'+preview_img_field+'"]').val(file);
                        $('#elfinder_modal').modal('hide');
                    },
                    resizable: false
                }).elfinder('instance');

                $('#elfinder_modal').modal();
            });

            // filepicker
//            $('input[name="add_preview_img"]').filePicker({
//                dataSource  : '/assets/plugins/filepicker-master/example/example.php',
//                baseDirectory   : '/proj',
//                afterSelectFile : function(data) {
//                    console.log(data);
//                }
//            });

            // обновляем страницу ajax-запросом
            refreshTable();
        }
    }

}();
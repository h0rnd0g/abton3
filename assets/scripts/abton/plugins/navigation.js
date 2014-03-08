var a3_Plugin = function () {

    var menu = $('#menu');

    var addDOMMenuItem = function (has_children, node, subpref, id, title, pref, content, page_title, seo_keywords, seo_description) {
        var children = '';

        if (has_children)
            children = '<ol class="dd-list" pk="' + id + '"></ol>';

        console.log(content);

        node.append(
            '<li class="dd-item dd3-item" data-id="' + id + '">' +
                '<div class="dd-handle dd3-handle"></div>' +
                '<div class="dd3-content">' +
                    '<a href="javascript:;" action="edit" pk="' + id + '"><i class="icon-pencil"></i></a>' +
                    '<a href="javascript:;" action="delete" pk="' + id + '"><i class="icon-trash"></i></a>' +
                    '&nbsp;&nbsp;<a href="'+subpref+'/'+pref+'" target="_blank">' + title + '</a>' +
                    '<div style="display: none;" field="content" pk="' + id + '">' + content + '</div>' +
                    '<div style="display: none;" field="pref" pk="' + id + '">' + pref + '</div>' +
                    '<div style="display: none;" field="title" pk="' + id + '">' + title + '</div>' +
                    '<div style="display: none;" field="page_title" pk="' + id + '">' + page_title + '</div>' +
                    '<div style="display: none;" field="keywords" pk="' + id + '">' + seo_keywords + '</div>' +
                    '<div style="display: none;" field="description" pk="' + id + '">' + seo_description + '</div>' +
                '</div>' +
                children +
            '</li>'
        );
    }

    var savePage = function (id) {
        App.blockUI($('#edit_navigation_form'));

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'edit_page',
                el_id: id,
                title: $('[name="edit_title"]').val(),
                page_title: $('[name="edit_page_title"]').val(),
                pref: $('[name="edit_pref"]').val(),
                content: CKEDITOR.instances.edit_content.getData(),
                seo_description: $('[name="edit_description"]').val(),
                seo_keywords: $('[name="edit_keywords"]').val()
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        $('#edit_navigation_form').hide();

                        $('html, body').animate({
                            scrollTop: 0
                        }, 500);

                        //refreshTree();
                        window.location = '';
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

    var editNavigation = function (id) {
        var title = $('[field="title"][pk="'+id+'"]').html();
        var page_title = $('[field="page_title"][pk="'+id+'"]').html();
        var pref = $('[field="pref"][pk="'+id+'"]').html();
        var content = $('[field="content"][pk="'+id+'"]').html();
        var keywords = $('[field="keywords"][pk="'+id+'"]').html();
        var description = $('[field="description"][pk="'+id+'"]').html();

        CKEDITOR.instances.edit_content.setData(content);
        $('[name="edit_title"]').val(title);
        $('[name="edit_page_title"]').val(page_title);
        $('[name="edit_pref"]').val(pref);
        $('[name="edit_keywords"]').val(keywords);
        $('[name="edit_description"]').val(description);

        $('button[name="edit_page"]').attr('pk', id);

        $('#edit_navigation_form').slideDown();

        $('html, body').animate({
            scrollTop: 0
        }, 500);

        App.unblockUI($('#edit_navigation_form'));
    }

    var generateTree = function (tree, node, subpref)
    {
        $.each(tree, function() {
            if (this.children.length > 0)
            {
                addDOMMenuItem(true, node, subpref, this.fields.id, this.fields.title, this.fields.pref, this.fields.content, this.fields.page_title, this.fields.seo_keywords, this.fields.seo_description);
                generateTree(this.children, $('ol[pk="'+this.fields.id+'"]'), subpref+'/'+this.fields.pref);
            }
            else
            {
                addDOMMenuItem(false, node, subpref, this.fields.id, this.fields.title, this.fields.pref, this.fields.content, this.fields.page_title, this.fields.seo_keywords, this.fields.seo_description);
            }

        });
    }

    var updateSrt = function (e) {
        var list = e.length ? e : $(e.target);
        var status = list.nestable('serialize');

        App.blockUI(menu);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'update_srt',
                tree: status
            },
            success:
                function (data) {
                    if (data.result)
                    {
                    }
                    else
                    {
                    }
                },
            complete:
                function () {
                    App.unblockUI(menu);
                }
        });

        console.log(status);
    }

    var deleteNavigation = function (id) {
        App.blockUI(menu);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'delete_page',
                page_id: id
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        //refreshTree();
                        window.location = '';
                    }
                    else
                    {
                        console.log('error');
                        App.unblockUI(menu);
                    }
                },
            complete:
                function () {
                }
        });

    }

    var addNavigation = function () {
        App.blockUI($('#add'));

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'add_page',
                active: 1,
                title: $('[name="add_title"]').val(),
                title2: $('[name="add_page_title"]').val(),
                pref: $('[name="add_pref"]').val(),
                content: CKEDITOR.instances.add_content.getData(),
                seo_description: $('[name="add_description"]').val(),
                seo_keywords: $('[name="add_keywords"]').val()
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        $('button[name="reset_add"]').click();
                        //refreshTree();
                        CKEDITOR.instances.add_content.setData('');

                        window.location = '';
                    }
                    else
                    {
                        console.log('error');
                    }
                },
            complete:
                function () {
                    App.unblockUI($('#add'));
                }
        });
    }

    var refreshTree = function () {
        App.blockUI(menu);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'get_menu_group',
                group_id: 1,
                parent_id: 0
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        menu.empty();

                        if (data.menu.length == 0)
                        {
                            menu.append('Список елементів меню порожній');
                        }
                        else
                        {
                            generateTree(data.menu, menu, '');

                            $('#menu_tree').nestable({
                                dropCallback: function(details) {
                                    var destID = details.destId;
                                    if (destID == null)
                                        destID = 0;

                                    $.ajax({
                                        type: 'POST',
                                        url: ajax_url,
                                        data: {
                                            type: 'move_menu',
                                            menu_id: details.sourceId,
                                            new_sub: destID
                                        },
                                        success:
                                            function (data) {
                                                if (data.result)
                                                {
                                                    //
                                                }
                                                else
                                                {
                                                    //
                                                }
                                            },
                                        complete:
                                            function () {
                                            }
                                    });
                                }
                            }).on('change', updateSrt);
                            $('#menu_tree').nestable('collapseAll');
                        }
                    }
                    else
                    {
                    }
                },
            complete:
                function () {
                    App.unblockUI(menu);
                }
        });
    }

    return {
        init: function ()
        {
            $('body').on('click', 'button[name="add_navigation"]', function () {
                addNavigation();
            });

            $('body').on('click', 'button[name="edit_page"]', function () {
                var id = $(this).attr('pk');

                savePage(id);
            });

            $('body').on('click', 'a[action="delete"]', function () {
                var id = $(this).attr('pk');

                $('button[name="delete_navigation"]').attr('pk', id);

                $('#delete').modal();
            });

            $('body').on('click', 'a[action="edit"]', function () {
                var id = $(this).attr('pk');

                editNavigation(id);
            });

            $('body').on('click', 'button[name="delete_navigation"]', function () {
                var id = $(this).attr('pk');

                deleteNavigation(id);
                $('#delete').modal('hide');
            });


            // обновляем страницу ajax-запросом
            refreshTree();
        }
    }
}();

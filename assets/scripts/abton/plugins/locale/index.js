var a3_Plugin = function () {

    var locales = $('#container_locales');

    var dt_locales = $('#dt_locales').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": true
    });

    var refreshLocales = function (id) {
        App.blockUI(locales);

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'get_locales',
                article_id: id
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        dt_locales.fnClearTable();

                        var dt_data = [];
                        $.each(data.locales, function (index, value) {

                        });

                        dt_locales.fnAddData(dt_data);
                    }
                    else
                    {
                        console.log(data);
                    }
                },
            complete:
                function () {
                    App.unblockUI(locales);
                }
        });
    }

    return {
        init: function ()
        {
            refreshLocales();

            $('.reload').click(function () {
                if ($(this).attr('data') == 'locales')
                    refreshLocales();
            });
        }
    }
}();
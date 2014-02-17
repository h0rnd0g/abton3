var a3_Plugin = function () {

//    var _lang_array;
//    var _test_db_ajax;
//    var _install_ajax;

    var testDBConnection = function () {
        var result = false;

        $.ajax({
            type: 'POST',
            async: false, // так как функция должна возвращать результат выполнения ajax-запроса
            url: _test_db_ajax,
            data: {
                hostname: $('[name="mysql-hostname"]').val(),
                login: $('[name="mysql-login"]').val(),
                password: $('[name="mysql-password"]').val(),
                db: $('[name="mysql-database"]').val()
            },
            success:
                function (data) {
                    if (data.result)
                    {
                        // соединение прошло успешно
                        toastr.info(_lang_array['test_success_message'], _lang_array['test_success_title']);

                        result = true;
                    }
                    else
                    {
                        // невозможно установить соединение
                        toastr.error(_lang_array['test_error_message'], _lang_array['test_error_title']);
                    }
                }
        });

        return result;
    }

    var refreshTable = function () {
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                type: 'get_articles'
            },
            success:
                function (data) {
//                    if (data.result)
//                    {
//                        // соединение прошло успешно
//                        //toastr.info(_lang_array['test_success_message'], _lang_array['test_success_title']);
//
//                    }
//                    else
//                    {
//                        console.log('error');
//                        // невозможно установить соединение
//                        //toastr.error(_lang_array['test_error_message'], _lang_array['test_error_title']);
//                    }
                }
        });
    }

    return {
        init: function ()
        {
            // обновляем страницу ajax-запросом
            refreshTable();
        }
    }

}();
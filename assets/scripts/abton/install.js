var a3_Install = function () {

    var _lang_array;
    var _test_db_ajax;
    var _install_ajax;

    var testDBConnection = function () {
        $.post(_test_db_ajax,
            {
                hostname: $('[name="mysql-hostname"]').val(),
                login: $('[name="mysql-login"]').val(),
                password: $('[name="mysql-password"]').val(),
                db: $('[name="mysql-database"]').val()
            })
            .success( function (data) {
                if (data.result)
                {
                    // соединение прошло успешно
                    toastr.info(_lang_array['test_success_message'], _lang_array['test_success_title']);
                }
                else
                {
                    // невозможно установить соединение
                    toastr.error(_lang_array['test_error_message'], _lang_array['test_error_title']);
                }
            });
    }

    var installCMS = function () {
        $.post(_install_ajax,
            {
                data: $('form').serialize()
            })
            .success( function (data) {

                if (data.result)
                {
                    toastr.success(_lang_array['install_success_message'], _lang_array['install_success_title']);
                }
                else
                {
                    // ошибка
                }
            });
    }

    var validateFieldsEmpty = function (additional_selector) {
        var no_errors = true;

        var _selector = '';
        if (additional_selector !== undefined)
            _selector = additional_selector;


        // все поля с классом "not-empty" и дополнительным селектором (если задан) не должны быть пустыми ...
        $('.not-empty'+_selector).each(function (index) {
            var caption = $('[for='+$(this).attr('name')+']');

            if ($(this).val() == '')
            {
                var msg = _lang_array['validate_field_empty'].replace( ":field", caption.text() );
                toastr.error(msg, _lang_array['validate_error']);

                caption.css('color', '#F00');

                // ... иначе есть ошибка
                no_errors = false;
            }
            else
                caption.css('color', '#000');
        });

        return no_errors;
    }

    return {
        init: function (lang_array, test_db_ajax, install_ajax)
        {
            _lang_array = lang_array;
            _test_db_ajax = test_db_ajax;
            _install_ajax = install_ajax;

            $('#submit-install').click(function () {
                // если нету ошибок (все поля заполнены), то пробуем установить систему
                if (validateFieldsEmpty())
                    installCMS();
            });

            $('#test-connection').click(function () {
                // проверяем соединение с БД по указанным данным, если заполнены необходимые поля блока настроек БД
                if (validateFieldsEmpty('.mysql-group'))
                    testDBConnection();
            });
        }
    }

}();
var a3_Install = function () {

    var _lang_array;
    var _test_db_ajax;

    var testDBConnection = function () {
        $.post(_test_db_ajax,
            {
                hostname: $('#mysql-hostname').val(),
                login: $('#mysql-login').val(),
                password: $('#mysql-password').val(),
                db: $('#mysql-database').val()
            })
            .success( function (data) {
                if (data)
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

    var validateFieldsEmpty = function () {
        var hostname = $('#mysql-hostname').val();

        $('.not-empty').each(function (index) {
            var caption = $('[for='+$(this).attr('id')+']');

            if ($(this).val() == '')
            {
                var msg = _lang_array['validate_field_empty'].replace( ":field", caption.text() );
                toastr.error(msg, _lang_array['validate_error']);

                caption.css('color', '#F00');
            }
            else
                caption.css('color', '#000');
        });
    }

    return {
        init: function (lang_array, test_db_ajax)
        {
            _lang_array = lang_array;
            _test_db_ajax = test_db_ajax;

            $('#submit-install').click(function () {
                validateFieldsEmpty();
            });

            $('#test-connection').click(function () {
                testDBConnection();
            });
        }
    }

}();
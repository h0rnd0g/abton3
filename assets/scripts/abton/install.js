var a3_Install = function () {

    var _lang_array;
    var _test_db_ajax;
    var _install_ajax;

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

    var installCMS = function () {
        // проверка на отключенность одного из checkbox (если выбрана всего лишь один язык локализации)
        // причина подобной проверки: отключенные элементы не возвращает serialize() формы
        var checked = $('.misc-langs:checked');
        var flag = false;
        if (checked.prop('disabled', true))
        {
            checked.prop('disabled', false);
            flag = true;
        }

        $.post(_install_ajax,
            {
                data: $('form').serialize()
            })
            .success( function (data) {
                if (data.result)
                {
                    toastr.success(_lang_array['install_success_message'], _lang_array['install_success_title']);

                    setTimeout(function () {
                        // location.href = '/' + data.root;
                    }, 3000);
                }
                else
                {
                    // ошибка
                }
            });

        // если есть отметка о изменениях активности элемента, то возвращаем назад
        if (flag)
            checked.prop('disabled', true);
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
                // если нету ошибок (все поля заполнены)
                if (validateFieldsEmpty())
                    // ... тогда пробуем проверить соединение с БД
                    if (testDBConnection())
                        installCMS(); // раз получилось установить соединение с БД, то пробуем установить систему
            });

            $('#test-connection').click(function () {
                // проверяем соединение с БД по указанным данным, если заполнены необходимые поля блока настроек БД
                if (validateFieldsEmpty('.mysql-group'))
                    testDBConnection();
            });

            // обработчики элементов форм выбора локализации
            $('.misc-langs').click(function () {
                var combo_element = $('.misc-langs-list[value="'+$(this).val()+'"]');
                var status = $(this).prop('checked');

                // если выбран только один язык, то его checkbox становится не активным
                // (всегда должен быть хотя бы один выбранный язык) и наоборот
                var checked = $('.misc-langs:checked');
                if (checked.length == 1)
                    checked.prop('disabled', true);
                else
                    checked.prop('disabled', false);

                // изменяем выбранный язык, если текущий был заблокирован
                var select = $('[name="misc-l10n-default"]');
                if (select.val() == combo_element.val())
                    select.val(checked.val());

                // если соответствующий checkbox не отмечен, то элемент списка заблокирован (и наоборот)
                combo_element.prop('disabled', !status);
            });
        }
    }

}();
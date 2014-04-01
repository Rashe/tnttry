var Devochki = Devochki ? Devochki : {};

Devochki.user = (function($){
    function formSubmit(typeForm, settings){
        var s = $.extend({
            form: '', user_pass: '', email: '', csrf: '', submitB: '', errorM: '', successFn: ''
        }, settings || {});

        var typeInput = typeForm == 'login' ? 'password' : 'username';

        s.form.on('submit', function(e){
            e.preventDefault();

            var notValidEmail = validation(s.email, 'email'),
                notValidUserPass = validation(s.user_pass, typeInput);
            if(notValidEmail || notValidUserPass){
                !!notValidEmail && setError(s.email, notValidEmail);
                !!notValidUserPass && setError(s.user_pass, notValidUserPass);
                s.submitB.prop({ disabled: true });
                return;
            }

            var data = {
                email: s.email.val(),
                csrf_test_name: s.csrf.val()
            };
            data[typeInput] = s.user_pass.val();

            $.ajax({
                type: 'POST',
                url: s.form.attr('action'),
                data: data,
                success: function(response){
                    if(response == 'success'){
                        typeof s.successFn == 'function' && s.successFn();
                    } else {
                        s.errorM.show();
                        s.submitB.prop({ disabled: true });
                    }
                }
            });
        });

        $('input', s.form).on('focus', function(){
            $(this).siblings('i.error').remove();
            s.errorM.hide();
            !$('i.error', s.form).length && s.submitB.prop({ disabled: false });
        });
    }

    function validation(input, type){
        var inputType = {
                username: { _reqiured: true, _regexp: false, _trim: true },
                password: { _reqiured: true, _regexp: /^[0-9a-zA-Z]{5,10}$/, _trim: false },
                email:    { _reqiured: true, _regexp: /^[\w\d._-]+@[\w\d.-]+\.[\w]{2,4}$/, _trim: true }
            },
            error = false;

        if(!(type = inputType[type])) return false;

        type._trim && input.val($.trim(input.val()));
        if(type._reqiured && input.val() == '') error = 'empty';
        if(!error && type._regexp && !type._regexp.test(input.val())) error = 'format';

        return error;
    }

    function setError(e, err){
        e.closest('fieldset').append('<i class="error">' + e.data(err) + '</i>');
//        e[0].setCustomValidity(e.data(err));
    }

    return {
        login: function (settings) { formSubmit('login', settings); },
        forgotPassword: function (settings) { formSubmit('forgotPassword', settings); },
        getForgotPasswordForm: function (url, fn) {
            $.ajax({
                url: url,
                success: function (form) { !!fn && typeof fn == 'function' && fn(form); }
            });
        }
    };
})(jQuery);
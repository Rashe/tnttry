var Devochki = Devochki ? Devochki : {};

Devochki.user = (function($){
    var user = {};

    user.init = function(settings){
        var s = $.extend({
            email: '',
            password: '',
            csrf: '',
            submitB: '',
            loginError: '',
            errors: {}
        }, settings || {});

        s.email = $(s.email);
        s.password = $(s.password);
        s.csrf = $(s.csrf);
        s.submitB = $(s.submitB);
        s.loginError = $(s.loginError);
        s.form = s.submitB.closest('form');

        s.submitB.on('click', function(e){
            e.preventDefault();

            var notValid = validation(s.email, s.password);
            if(notValid){
                !!notValid[0] &&
                    s.email.closest('fieldset').append('<i class="error">' + s.errors[notValid[0]] + '</i>');

                !!notValid[1] &&
                    s.password.closest('fieldset').append('<i class="error">' + s.errors[notValid[1]] + '</i>');

                s.submitB.prop({ disabled: true });
                return false;
            }

            loginRequest({
                form: s.form,
                email: s.email.val(),
                password: s.password.val(),
                csrf: s.csrf.val(),
                errorL: s.loginError,
                submitB: s.submitB
            });
        });

        $('input', s.form).on('focus', function(){
            $(this).siblings('i.error').remove();
            s.loginError.hide();
            !$('i.error', s.form).length && s.submitB.prop({ disabled: false });
        });
    };

    function validation(email, password){
        var emailRegexp = /^[\w\d._-]+@[\w\d.-]+\.[\w]{2,4}$/,
            passwordRegexp = /^[0-9a-z]{5,10}$/i,
            emailError = false, passwordError = false;

        email.val($.trim(email.val()));

        if(email.val() == '') emailError = 'empty';
        if(password.val() == '') passwordError = 'empty';

        if(!emailError && !emailRegexp.test(email.val())) emailError = 'formatEmail';
        if(!passwordError && !passwordRegexp.test(password.val())) passwordError = 'formatPassword';

        return !!emailError || !!passwordError ? [emailError, passwordError] : false;
    }

    function loginRequest(o){
        var s = $.extend({ form: '', email: '', password: '', csrf: '', errorL: '', submitB: '' }, o || {});

        $.ajax({
            type: 'POST',
            url: s.form.attr('action'),
            data: {
                email: s.email,
                password: s.password,
                csrf_test_name: s.csrf
            },
            success: function(data){
                if(data == 'success'){
                    window.location = s.form.data('home');
                } else {
                    s.errorL.show();
                    s.submitB.prop({ disabled: true });
                }
            }
        });
    }

    return user;
})(jQuery);
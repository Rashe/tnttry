var Devochki = Devochki ? Devochki : {};

Devochki.user = (function($){
    var user = {};

    user.init = function(settings){
        var s = $.extend({
            email: '',
            password: '',
            csrf: '',
            submitB: '',
            loginError: ''
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
                !!notValid[0] && setError(s.email, notValid[0]);
                !!notValid[1] && setError(s.password, notValid[1]);
                s.submitB.prop({ disabled: true });
                return;
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
            emailError = '', passwordError = '';

        email.val($.trim(email.val()));

        if(email.val() == '') emailError = 'empty';
        if(password.val() == '') passwordError = 'empty';

        if(!emailError && !emailRegexp.test(email.val())) emailError = 'format';
        if(!passwordError && !passwordRegexp.test(password.val())) passwordError = 'format';

        return !!emailError || !!passwordError ? [emailError, passwordError] : false;
    }

    function setError(e, err){
        e.closest('fieldset').append('<i class="error">' + e.data(err) + '</i>');
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
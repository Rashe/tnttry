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

            var notValid = validationLogin(s.email, s.password);
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

    function validation(input, type){
        var inputType = {
                username: { _reqiured: true, _regexp: false, _trim: true },
                password: { _reqiured: true, _regexp: /^[0-9a-z]{5,10}$/i, _trim: false },
                email:    { _reqiured: true, _regexp: /^[\w\d._-]+@[\w\d.-]+\.[\w]{2,4}$/, _trim: true }
            },
            error = false;

        if(!(type = inputType[type])) return false;

        type._trim && input.val($.trim(input.val()));
        if(type._reqiured && input.val() == '') error = 'empty';
        if(!error && type._regexp && !type._regexp.test(input.val())) error = 'format';

        return error;
    }
    function validationLogin(email, password){
        email = validation(email, 'email');
        password = validation(password, 'password');
        return !!email || !!password ? [email, password] : false;
    }
    function validationForgotPassword(email, username){
        email = validation(email, 'email');
        username = validation(username, 'username');
        return !!email || !!username ? [email, username] : false;
    }

    function setError(e, err){
        e.closest('fieldset').append('<i class="error">' + e.data(err) + '</i>');
//        e[0].setCustomValidity(e.data(err));
    }

    function getForgotPasswordForm(){
        // todo: get forgot password form by ajax and replace login form
    }

    return user;
})(jQuery);
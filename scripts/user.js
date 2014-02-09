var Devochki = Devochki ? Devochki : {};

Devochki.user = (function($){
    var user = {};

    user.init = function(settings){
        var s = $.extend({
            email: '',
            password: '',
            submitB: '',
            errors: {}
        }, settings || {});

        s.email = $(s.email);
        s.password = $(s.password);
        s.submitB = $(s.submitB);
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

            loginRequest(s.email, s.password);
        });

        $('input', s.form).on('focus', function(){
            $(this).siblings('i.error').remove();
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

    function loginRequest(email, password){

    }

    return user;
})(jQuery);
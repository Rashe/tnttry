$(function(){
    var body = $('body'),
        loginForm = $('#login-form');

    !!loginForm && Devochki.user.login({
        form: loginForm,
        email: $('[name="email"]', loginForm),
        user_pass: $('[name="password"]', loginForm),
        csrf: $('[name="csrf_test_name"]', loginForm),
        submitB: $('[name="submit"]', loginForm),
        errorM: $('#loginError', loginForm),
        successFn: function(){
            window.location = loginForm.data('home');
        }
    });

    $('#forgotPassword').on('click', function(e){
        e.preventDefault();
        var _this = $(this);

        Devochki.user.getForgotPasswordForm(_this.attr('href'), function(forgotPasswordForm){
            _this.add(loginForm).hide();
            $('.loginWrapper').append(forgotPasswordForm);

            var fpForm = $('#forgotPassword-form');

            Devochki.user.forgotPassword({
                form: fpForm,
                user_pass: $('[name="username"]', fpForm),
                email: $('[name="email"]', fpForm),
                csrf: $('[name="csrf_test_name"]', fpForm),
                submitB: $('[name="submit"]', fpForm),
                errorM: $('#forgotPasswordError', fpForm),
                successFn: function(){
                    fpForm.hide();
                    loginForm.show();
                }
            });
        });
    });
});
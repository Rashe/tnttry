$(function(){
    var body = $('body'),
        loginForm = $('#login-form');

    !!loginForm && Devochki.user.init({
        email: $('[name="email"]', loginForm),
        password: $('[name="password"]', loginForm),
        csrf: $('[name="csrf_test_name"]', loginForm),
        submitB: $('[name="submit"]', loginForm),
        loginError: $('#loginError', loginForm)
    });

    $('#forgotPassword').on('click', function(e){
        e.preventDefault();
        var _this = $(this);
        Devochki.user.getForgotPasswordForm(_this.attr('href'), function(formFP){
            $('.loginWrapper').append(formFP);
            _this.add(loginForm).hide();
        });
    });
});
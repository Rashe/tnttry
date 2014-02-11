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

});
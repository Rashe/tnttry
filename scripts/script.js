$(function(){
    var body = $('body'),
        loginForm = $('#login-form');

    !!loginForm && Devochki.user.init({
        email: $('[name="email"]', loginForm),
        password: $('[name="password"]', loginForm),
        submitB: $('[name="submit"]', loginForm),
        errors: {
            empty: 'This field is required',
            formatEmail: 'Format of email is not valid',
            formatPassword: 'Password should be 5 - 10 chars'
        }
    });

});
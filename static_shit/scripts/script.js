$(document).ready(function(){
    window.Login.init();
    window.AfterLogin.init();
    window.Registration.init();




    //masonry
    var $container = $('#container');
// initialize
    $container.masonry({
//        columnWidth: 300,
        itemSelector: '.item'
    });

});

/**
 * Login
 */
(function(){
    var Login = function(){
        var _login = this;

        var settings = {
            dev: false
        }

        var selectors = {
            wrapper:        '.loginWrapper',
            form:           '#login-form',
            submitBtn:      '#login-form input[type="submit"]',
            emailInput:     '#login-form input[type="email"]',
            passwordInput:  '#login-form input[type="password"]'
        };

        var classes = {
            hidden: 'hidden'
        }

        var texts = {

        };

        this.init = function(){
            _login.dev();
            _login.submit();
        };

        this.dev = function(){
            if(settings.dev){
                $(selectors.regFormWrap).removeClass(classes.hidden);
            }
        };

        /**
         * Submit login
         */
        this.submit = function(){
            $(selectors.submitBtn).click(function(e){
                e.preventDefault();
                $.ajax({
//                    type: 'POST',
                    url: 'login',
                    data: {
                        email: $(selectors.emailInput).val(),
                        password: $(selectors.passwordInput).val()
                    },
                    beforeSend: function( xhr ){
                        $(selectors.wrapper).addClass('ajaxLoader');
                        $(selectors.form).addClass('hidden');
                    },
                    success: function(data, textStatus, jqXHR){
                        var response = $.parseJSON(data);

                        $(selectors.wrapper).removeClass('ajaxLoader');
                        document.cookie="username=John Smith; expires=Thu, 18 Dec 2013 12:00:00 GMT; path=/";
                        if(response.login == 1){
                            location.reload();
                        } else {
                            $(selectors.form).removeClass('hidden');
                        }
                    }

                });
            });
        };
    };

    window.Login = new Login();
})();

/**
 * After Login
 */
(function(){
    var AfterLogin = function(){
        var _afterLogin = this;

        var selectors = {
            logoutBtn : '#logout'
        };

        this.init = function(){
            _afterLogin.updateUserCookies();
        };

        this.updateUserCookies = function(){
            $(selectors.logoutBtn).click(function(e){
                $.ajax({
                    url: 'login',
                    data: {logout: true},
                    success: function(data, textStatus, jqXHR){
                        location.reload();
                    }
                });
            });
        };
    };

    window.AfterLogin = new AfterLogin();
})();

/**
 * Registration
 */
(function(){
    var Registration = function(){
        var _registration = this;

        var settings = {
            dev: false
        }

        var selectors = {
            regLink:        '.loginWrapper form a.regLink',
            regFormWrap:    '.registrationWrapper',
            regForm:        '#registration-form',
            regSubmit:      '#registration-form input[type="submit"]'
        };

        var classes = {
            hidden: 'hidden'
        }

        var texts = {
            registerHover: 'Да хочу! Отрегестрируй меня полностью.'
        };

        this.init = function(){
            _registration.dev();
            _registration.hoverLink();
            _registration.clickLink();
        };

        this.dev = function(){
            if(settings.dev){
                $(selectors.regFormWrap).removeClass(classes.hidden);
            }
        };

        this.hoverLink = function(){
            $(selectors.regLink).hover( function(){
                $(this).text(texts.registerHover)
            }, function(){
                $(this).text($(this).attr('placeholder'));
            });
        };

        this.clickLink = function(){
            $(selectors.regLink).click(function(e){
                e.preventDefault();
                $(selectors.regFormWrap).removeClass(classes.hidden);
            });
        };

        this.regAjaxSubmit = function(){
            $(selectors.regSubmit).click(function(e){
                e.preventDefault();

            });
        }
    }

    window.Registration = new Registration();
})();


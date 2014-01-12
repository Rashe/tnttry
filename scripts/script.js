$(document).ready(function(){
    window.Login.init();
    window.Registration.init();

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
            emailInput: '#login-form input[type="email"]',
            passwordInput: '#login-form input[type="password"]'
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

        this.submit = function(){
            $(selectors.submitBtn).click(function(e){
                e.preventDefault();
                console.log('click');
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
                        var response = JSON.stringify(data);
//                        console.log('data: ' + JSON.stringify(data));
//                        console.log('textStatus: ' + textStatus);
//                        console.log('jqXHR: ' + JSON.stringify(jqXHR));

                        $(selectors.wrapper).removeClass('ajaxLoader');

                        if(response == ''){
                            $(selectors.wrapper).html('Can\'t login');
                        } else {
                            location.reload();
                        }
                    }

                });
            });
        };
    }

    window.Login = new Login();
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
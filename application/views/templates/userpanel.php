<?php
if($username) {

    echo $username . ' | New Posts | Profile | <a id="logout" href="'. base_url() . 'index.php/logout">Logout</a>';

} else {

    echo form_open('login', array(
            'id' => 'login-form',
            'data-home' => ''
        )) .

        anchor(base_url() . 'index.php/registration', 'Хочешь голых сисек маленький проказник? :)', array('class' => 'regLink', 'placeholder' => 'Хочешь голых сисек маленький проказник? :)')) .

        form_fieldset() .
        form_input(array(
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email',
            'data-empty' => 'This field is required',
            'data-format' => 'Format of email is not valid'
        )) .
        form_fieldset_close() .

        form_fieldset() .
        form_input(array(
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password',
            'data-empty' => 'This field is required',
            'data-format' => 'Password should be 5 - 10 chars'
        )) .
        form_fieldset_close() .

        form_submit('submit', 'Login') .

        '<span id="loginError">Email or password is wrong. Try again or register.</span>' .

        form_close() .

    '<a href="' . base_url() . 'index.php/get_forgot_password" id="forgotPassword">Forgot Your Password?</a>';
}
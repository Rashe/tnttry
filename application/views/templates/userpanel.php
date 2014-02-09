<?php
if($loggedIn) {

    echo $username . ' | New Posts | Profile | <a id="logout" href="'. base_url() . 'index.php/logout">Logout</a>';

} else {

    $o = form_open('login', array('id' => 'login-form')) .

        anchor(base_url() . 'index.php/registration', 'Хочешь голых сисек маленький проказник? :)', array('class' => 'regLink', 'placeholder' => 'Хочешь голых сисек маленький проказник? :)')) .

        form_fieldset() .
        form_input(array(
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        )) .
        form_fieldset_close() .

        form_fieldset() .
        form_input(array(
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password'
        )) .
        form_fieldset_close() .

        form_submit('submit', 'Login');

    if ($login_fail) $o .= 'Username or password is wrong. Try again or register.';

    echo $o . form_close();
}
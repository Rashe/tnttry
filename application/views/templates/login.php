<?php
echo '<div id="login_block">' . validation_errors() . '</div>' .

    form_open('login') .
//    form_fieldset() .
//    form_label('Email', 'email') .
    form_input(array(
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Email'
    )) .
//    form_fieldset_close() .

//    form_fieldset() .
//    form_label('Password', 'password') .
    form_input(array(
        'name' => 'password',
        'placeholder' => 'Password'
    )) .
//    form_fieldset_close() .

    form_submit('submit', 'Login') .

    form_close();



<?php
echo form_open('forgot_password', array(
        'id' => 'forgotPassword-form'
    )) .

    form_fieldset() .
    form_input(array(
        'name' => 'username',
        'placeholder' => 'Username',
        'data-empty' => 'This field is required'
    )) .
    form_fieldset_close() .

    form_fieldset() .
    form_input(array(
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Email',
        'data-empty' => 'This field is required',
        'data-format' => 'Format of email is not valid'
    )) .
    form_fieldset_close() .

    form_submit('submit', 'Get New Password') .

    '<span id="forgotPasswordError">Username or email is wrong. Try again or register.</span>' .

    form_close();

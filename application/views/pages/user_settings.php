<?php
echo '<div id="validationErrors">' . validation_errors() . '</div>' .

    form_open('user_settings') .

    form_fieldset() .
    form_label('Email', 'email') .
    form_input(array(
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'example@domain.com'
    )) .
    form_fieldset_close() .

    form_fieldset() .
    form_label('Password', 'password') .
    form_input(array(
        'name' => 'password'
    )) .
    form_fieldset_close() .

    form_submit('submit', 'Update Settings') .

    form_close();

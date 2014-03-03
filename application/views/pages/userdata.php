<?php
echo form_open('userdata', array('id' => 'userdata')) .

    form_fieldset() .
    form_label('Email', 'email') .
    form_input(array(
        'name'        => 'email',
        'type'        => 'email',
        'placeholder' => 'example@domain.com',
        'value'       => set_value('email', $email)
    )) .
    form_error('email') .
    form_fieldset_close() .

    form_fieldset() .
    form_label('Password', 'password') .
    form_input(array(
        'name'  => 'password',
        'value' => set_value('password')
    )) .
    form_error('password') .
    form_fieldset_close() .

    form_submit('submit', 'Change userdata') .

form_close();

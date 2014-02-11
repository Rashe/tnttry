<?php
echo form_open('registration', array('id' => 'registration'), array('antiBot' => '')) .

form_fieldset() .
form_label('Username', 'username') .
form_input(array(
    'name' => 'username',
    'value' => set_value('username')
)) .
form_error('username') .
form_fieldset_close() .

form_fieldset() .
form_label('Email', 'email') .
form_input(array(
    'name' => 'email',
    'type' => 'email',
    'placeholder' => 'example@domain.com',
    'value' => set_value('email')
)) .
form_error('email') .
form_fieldset_close() .

form_fieldset() .
form_label('Password', 'password') .
form_input(array(
    'name' => 'password',
    'value' => set_value('password')
)) .
form_error('password') .
form_fieldset_close() .

form_fieldset() .
form_checkbox(array(
    'name'        => 'tc',
    'id'          => 'tc',
    'value'       => 'accept',
    'checked'     => false
)) .
form_label('Terms & Conditions', 'tc') .
form_error('tc') .
form_fieldset_close() .

form_submit('submit', 'Create account') .
form_close();



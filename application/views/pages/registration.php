<?php

$errors = '<div id="validationErrors"><p>' . validation_errors() . '</p>';
foreach($error as $err){
    $errors .= '<p>' . $err . '</p>';
}
$errors .= '</div>';
echo $errors .

form_open('registration', array('id' => 'registration'), array('antiBot' => '')) .

form_fieldset() .
form_label('Username', 'username') .
form_input(array(
    'name' => 'username'
)) .
form_fieldset_close() .

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

form_fieldset() .
form_checkbox(array(
    'name'        => 'tc',
    'id'          => 'tc',
    'value'       => 'accept',
    'checked'     => false
)) .
form_label('Terms & Conditions', 'tc') .
form_fieldset_close() .

form_submit('submit', 'Create account') .

form_close();



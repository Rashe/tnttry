<?php
echo '<div id="login_block">' . validation_errors() . '</div>' .

    form_open('login', array('id' => 'login-form')) .

    anchor(base_url().'index.php/registration', 'Хочешь голых сисек маленький проказник? :)', array('class' => 'regLink', 'placeholder' => 'Хочешь голых сисек маленький проказник? :)')).

    form_input(array(
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Email'
    )) .

    form_input(array(
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Password'
    )) .

    form_submit('submit', 'Login') .

    form_close();



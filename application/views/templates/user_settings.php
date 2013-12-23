<?php

echo '<label>UserName :</label><div class="username">' . $userall[0]['username'] . '</div>';
echo '<label>E-mail :</label><div class="email">' . $userall[0]['email'] . '</div>';
echo '<div id="validationErrors">' . validation_errors() . '</div>' .




    form_open('user_settings') .
    form_fieldset() .
    form_label('New Password', 'password') .
    form_input(array(
        'name' => 'password'
    )) .
    form_fieldset_close() .

    form_submit('submit', 'Update Settings') .

    form_close();

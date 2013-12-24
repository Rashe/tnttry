<?php
echo '<div class="upload_block">' .

    form_open('make_post') .
    form_fieldset() .
    form_label('file url', 'post_body') .
    form_input(array(
        'name' => 'post_body',
        'placeholder' => 'some url lol'
    )) .
    form_fieldset_close() .
    form_submit('submit', 'Upload') .

    form_close() .
    '</div>';



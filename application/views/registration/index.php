<?php echo form_open('registration/index', array('id' => 'registration')); ?>

<label for="username">Username</label>
<input type="text" name="username">

<label for="email">Email</label>
<input type="text" name="email">

<label for="password">Password</label>
<input type="text" name="password">

<?php echo validation_errors(); ?>

<input type="submit" name="submit" value="Create account">

</form>

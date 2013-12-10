<?php echo form_open('registration', array('id' => 'registration'), array('antiBot' => '')); ?>

<label for="username">Username</label>
<input type="text" name="username">

<label for="email">Email</label>
<input type="email" name="email">

<label for="password">Password</label>
<input type="text" name="password">

<?php echo validation_errors(); ?>

<input type="submit" name="submit" value="Create account">

</form>

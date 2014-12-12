<form action="<?PHP echo $lang; ?>/registration/submit" method="POST" id="login">
    <h1><?PHP echo $this->_('registration'); ?></h1>
    <fieldset id="inputs">
        <input id="realname" name="realname" type="text" placeholder="<?PHP echo $this->_('name_field'); ?>" autofocus required>
        <?PHP echo $error_realname; ?>
        <input id="username" name="username" type="text" placeholder="<?PHP echo $this->_('login_field'); ?>" required>
        <?PHP echo $error_username; ?>
        <input id="useremail" name="useremail" type="text" placeholder="<?PHP echo $this->_('email_field'); ?>" required>
        <?PHP echo $error_useremail; ?>
        <input id="password" name="password" type="password" placeholder="<?PHP echo $this->_('password_field'); ?>" required>
        <?PHP echo $error_password; ?>
        <input id="passwordconfirm" name="passwordconfirm" type="password" placeholder="<?PHP echo $this->_('password_confirm_field'); ?>" required>
        <?PHP //echo $recaptcha; ?>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" name="submit" id="submit" value="<?PHP echo $this->_('registration_submit'); ?>">
        <a href="<?PHP echo $lang; ?>/"><?PHP echo $this->_('authorization'); ?></a>
    </fieldset>
</form>
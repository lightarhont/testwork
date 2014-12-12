<form action="<?PHP echo $lang ?>/auth/postdata" method="POST" id="login">
    <h1><?PHP echo $this->_('login_form'); ?></h1>
    <fieldset id="inputs">
        <input id="username" name="username" type="text" placeholder="<?PHP echo $this->_('login_field'); ?>" autofocus required>   
        <input id="password" name="password" type="password" placeholder="<?PHP echo $this->_('password_field'); ?>" required>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="<?PHP echo $this->_('login_submit'); ?>">
    </fieldset>
</form>
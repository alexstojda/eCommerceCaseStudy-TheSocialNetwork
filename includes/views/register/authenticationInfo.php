<html>
<form action='<?= URL . "register/doAuthInfo" ?>' method=POST>
    <table>
        <tr>
            <td>
                <label>Username: </label>
            </td>
            <td>
                <input required type="text" pattern="^([A-z]|\d){2,16}$" name=username
                       id=username title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['username'])) {
                        echo "value='" . $this->newUser['username'] . "'";
                    } ?> />
            </td>
            <td style="color: red">
                <?php if (isset($this->usernameError)) echo $this->usernameError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password: </label>
            </td>
            <td>
                <input required type="password" pattern="^([A-z]|\d){6,16}$" name=password
                       id=password title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['password'])) {
                        echo "value='" . $this->newUser['password'] . "'";
                    } ?>/>
            </td>
            <td style="color: red">
                <?php if (isset($this->passwordError)) echo $this->passwordError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label> Confirm Password: </label>
            </td>
            <td>
                <input required type="password" pattern="^([A-z]|\d){6,16}$"
                       name=confPassword id=confPassword
                       title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['password'])) {
                        echo "value='" . $this->newUser['password'] . "'";
                    } ?>/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email: </label>
            </td>
            <td>
                <input required type="email" pattern="^\S+@\S+\.\S+$"
                       name="email" id="email"
                    title="Email must be a valid email"
                    <?php if (isset($this->newUser['email'])) {
                        echo "value='" . $this->newUser['email'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->emailError)) echo $this->emailError; ?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submitAccount id=submitAccount value='Continue'/>
            </td>
        </tr>
    </table>
</form>

</html>
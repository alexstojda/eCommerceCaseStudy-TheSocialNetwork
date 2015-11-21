<html>
<form action='<?= URL . "register/doAuthInfo" ?>' method=POST>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Username:</span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               required type="text" pattern="^([A-z]|\d){2,16}$" name=username
               id=username title="Between 6 and 16 alphanumeric characters"
            <?php if (isset($this->newUser['username'])) {
                echo "value='" . $this->newUser['username'] . "'";
            } ?> style="width:200px"/>
        <p style="color: red">  <?php if (isset($this->usernameError)) echo $this->usernameError; ?></p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Password: </span>
        <input type="password" class="form-control" aria-describedby="basic-addon1"
               required type="password" pattern="^([A-z]|\d){6,16}$" name=password
               id=password title="Between 6 and 16 alphanumeric characters"
            <?php if (isset($this->newUser['password'])) {
                echo "value='" . $this->newUser['password'] . "'";
            } ?> style="width:200px"/>
        <p style="color: red">
            <?php if (isset($this->passwordError)) echo $this->passwordError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Confirm Password: </span>
        <input type="password" class="form-control" aria-describedby="basic-addon1"
               required type="password" pattern="^([A-z]|\d){6,16}$"
               name=confPassword id=confPassword
               title="Between 6 and 16 alphanumeric characters"
            <?php if (isset($this->newUser['password'])) {
                echo "value='" . $this->newUser['password'] . "'";
            } ?> style="width:200px"/>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Email: </span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               required type="email" pattern="^\S+@\S+\.\S+$"
               name="email" id="email"
               title="Email must be a valid email"
               <?php if (isset($this->newUser['email'])) {
                   echo "value='" . $this->newUser['email'] . "'";
               } ?>style="width:250px"/>

        <p style="color: red">
            <?php if (isset($this->emailError)) echo $this->emailError; ?>
        </p>
    </div>
<input type="submit" name="submitAccount" id="submitAccout" value="Continue" class="btn btn-primary btn-lg" >

 <?php   /*


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
        </tr>*/
    ?>
</form>

</html>
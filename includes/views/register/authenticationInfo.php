<html>
<div class="jumbotron container-fluid">
    <h3>Registration (1/3) : Authentication Information</h3><br/>

    <form class="form-horizontal" action='<?= URL . "register/doAuthInfo" ?>' method=POST>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Username:</label>

            <div class="com-sm-10 col-md-8">
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                       required type="text" pattern="^([A-z]|\d){2,16}$" name=username
                       id=username title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['username'])) {
                        echo "value='" . $this->newUser['username'] . "'";
                    } ?>/>
            </div>
            <p style="color: red">  <?php if (isset($this->usernameError)) echo $this->usernameError; ?></p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Password:</label>

            <div class="col-sm-10 col-md-8">
                <input type="password" class="form-control" aria-describedby="basic-addon1"
                       required type="password" pattern="^([A-z]|\d){6,16}$" name=password
                       id=password title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['password'])) {
                        echo "value='" . $this->newUser['password'] . "'";
                    } ?>/>
            </div>
            <p class="">
                <?php if (isset($this->passwordError)) echo $this->passwordError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Confirm Password:</label>

            <div class="col-sm-10 col-md-8">
                <input type="password" class="form-control" aria-describedby="basic-addon1"
                       required type="password" pattern="^([A-z]|\d){6,16}$"
                       name=confPassword id=confPassword
                       title="Between 6 and 16 alphanumeric characters"
                    <?php if (isset($this->newUser['password'])) {
                        echo "value='" . $this->newUser['password'] . "'";
                    } ?>/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Email: </label>

            <div class="col-sm-10 col-md-8">
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                       required type="email" pattern="^\S+@\S+\.\S+$"
                       name="email" id="email"
                       title="Email must be a valid email"
                    <?php if (isset($this->newUser['email'])) {
                        echo "value='" . $this->newUser['email'] . "'";
                    } ?>/>
            </div>
            <p style="color: red">
                <?php if (isset($this->emailError)) echo $this->emailError; ?>
            </p>
        </div>
        <div class="col-sm-10 col-md-8 col-sm-offset-9 col-md-offset-9">
            <input type="submit" name="submitAccount" id="submitAccout" value="Continue" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>
</html>
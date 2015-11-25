<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-24
 * Time: 3:23 PM
 */
?>
<form method="post" action="<?= URL . 'register/doUpdateUser/' . $_SESSION['id'] ?>">
    <div class="container-fluid">
        <div class="row">
            <div
                class=" col-xs-10 col-sm-6 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->usernameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?= $this->usernameError ?>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="uname"><strong>Username:</strong></span>
                                    <input type="text" class="form-control" aria-describedby="uname"
                                            type="text" pattern="^([A-z]|\d){2,16}$" name=username
                                           id=username title="Between 6 and 16 alphanumeric characters"
                                        <?php if (isset($this->user['user'])) {
                                            echo "placeholder='" . $this->user['user'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->passwordError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->passwordError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="pword"><strong>Password: </strong></span>
                                    <input type="password" class="form-control" aria-describedby="pword"
                                            type="password" pattern="^([A-z]|\d){6,16}$" name=password
                                           id=password title="Between 6 and 16 alphanumeric characters"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <div class="input-group">
                                    <span class="input-group-addon" id="conpword"><strong>Confirm
                                            Password: </strong></span>
                                    <input type="password" class="form-control" aria-describedby="conpword"
                                            type="password" pattern="^([A-z]|\d){6,16}$"
                                           name=confPassword id=confPassword
                                           title="Between 6 and 16 alphanumeric characters"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->emailError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->emailError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="maile"><strong>Email: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="maile"
                                            type="email" pattern="^\S+@\S+\.\S+$"
                                           name="email" id="email"
                                           title="Email must be a valid email"
                                        <?php if (isset($this->user['email'])) {
                                            echo "placeholder='" . $this->user['email'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <!-- /////////////////////////// USER INFO \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->firstNameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->firstNameError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="fname"><strong>First Name: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="fname"
                                           name=first_name id=first_name
                                           pattern="^([A-z]){2,20}$" title="Minimum 2 letters" 
                                        <?php if (isset($this->user['first_name'])) {
                                            echo "placeholder='" . $this->user['first_name'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->lastNameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->lastNameError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="lname"><strong>Last Name: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="lname"
                                           name=last_name id=last_name pattern="^([A-z]){2,20}$"
                                           title="Minimum 2 letters" 
                                        <?php if (isset($this->user['last_name'])) {
                                            echo "placeholder='" . $this->user['last_name'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->genderError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->genderError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="gen"><strong>Gender: </strong></span>
                                    <select name="gender_id" id="gender_id" class="form-control" aria-describedby="gen" >
                                        <option value="">Select a gender...</option>
                                        <?php
                                        foreach ($this->genders as $gender) {
                                            if (isset($this->user['gender']) && $this->user['gender'] == $gender['gender_id'])
                                                echo '<option selected value=\'' . $gender['gender_id'] . '\'>' . $gender['gender_desc']
                                                    . '</option>';
                                            else
                                                echo '<option value="' . $gender['gender_id'] . '">' . $gender['gender_desc']
                                                    . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->dobError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->dobError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="lname"><strong>Date of Birth: </strong></span>
                                    <input type="date" name=date_of_birth id="date_of_birth" class="form-control"
                                           aria-describedby="basic-addon1"
                                           pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$"
                                           title="yyyy-mm-dd"
                                           max="<?= date_sub(date_create(),
                                               date_interval_create_from_date_string('13 years'))->format('Y-m-d') ?>"
                                           
                                        <?php if (isset($this->user['birth'])) {
                                            echo "value='" . $this->user['birth'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->phoneError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->phoneError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="phoneNum"><strong>Phone Number: </strong></span>
                                    <input type="phone" class="form-control" aria-describedby="phoneNum"
                                           id="phone" name="phone" 
                                           pattern="^([+\-().]|\d){8,}$"
                                           title="Valid phone number "
                                        <?php if (isset($this->user['phone'])) {
                                            echo "value='" . $this->user['phone'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->addressError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->addressError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="addr"><strong>Street Address: </strong></span>
                                    <input class="form-control" aria-describedby="addr"
                                           type="text" name="address" id="address"
                                           pattern="^.{4,20}$"  title="Minimum 4 characters"
                                        <?php if (isset($this->user['address'])) {
                                            echo "placeholder='" . $this->user['address'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="cty"><strong>City: </strong></span>
                                    <input class="form-control" aria-describedby="cty"
                                           type="text" name="city" id="city"
                                           pattern="^.{4,20}$"  title="Minimum 4 characters"
                                        <?php if (isset($this->user['city'])) {
                                            echo "placeholder='" . $this->user['city'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="state"><strong>Province/State: </strong></span>
                                    <input class="form-control" aria-describedby="state"
                                           type="text" name="province" id="province" pattern="^.{4,20}$"
                                            title="Minimum 4 characters"
                                        <?php if (isset($this->user['province'])) {
                                            echo "placeholder='" . $this->user['province'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="cntry"><strong>Country: </strong></span>
                                    <select class="form-control" id="country" name="country" aria-describedby="cntry" >
                                        <option>Select a country...</option>
                                        <?php foreach ($this->countries as $country) {
                                            if (isset($this->user['country']) && $this->user['country'] == $country['country_ISO_ID'])
                                                echo '<option selected="selected" value=\'' . $country['country_ISO_ID'] . '\' >'
                                                    . $country['country_name'] . '</option>';
                                            echo '<option value=' . $country['country_ISO_ID'] . '> '
                                                . $country['country_name'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="state"><strong>Postal Code / Zip Code: </strong></span>
                                    <input class="form-control" aria-describedby="basic-addon1"
                                           type=text name=postalcode id=postalcode
                                           pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"
                                           
                                           title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"
                                        <?php if (isset($this->user['postalcode'])) {
                                            echo "placeholder='" . $this->user['postalcode'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary btn-lg" >Update my Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


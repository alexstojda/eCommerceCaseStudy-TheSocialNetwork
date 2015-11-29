<div class="jumbotron container-fluid">
    <h3>Registration (2/3) : Personal Information</h3><br/>

    <form class="form-horizontal" action='<?= URL . 'register/doUserInfo' ?>' method=post enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">First Name: </label>

            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                       name=first_name id=first_name
                       pattern="^([A-z]){2,20}$" title="Minimum 2 letters" required
                    <?php if (isset($this->newUser['first_name'])) {
                        echo "value='" . $this->newUser['first_name'] . "'";
                    } ?> />
            </div>
            <p style="color: red">  <?php if (isset($this->firstNameError)) echo $this->firstNameError; ?></p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Last Name: </label>

            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                       name=last_name id=last_name pattern="^([A-z]){2,20}$"
                       title="Minimum 2 letters" required
                    <?php if (isset($this->newUser['last_name'])) {
                        echo "value='" . $this->newUser['last_name'] . "'";
                    } ?>/>
            </div>
            <p style="color: red">
                <?php if (isset($this->lastNameError)) echo $this->lastNameError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label" for="gender_id">Gender: </label>

            <div class="col-sm-4 col-md-4">
                <select name="gender_id" id="gender_id" class="form-control" required>
                    <option value="">Select a gender...</option>
                    <?php
                    foreach ($this->genders as $gender) {
                        if (isset($this->newUser['gender_id']) && $this->newUser['gender_id'] == $gender['gender_id'])
                            echo '<option selected value=\'' . $gender['gender_id'] . '\'>' . $gender['gender_desc']
                                . '</option>';
                        else
                            echo '<option value="' . $gender['gender_id'] . '">' . $gender['gender_desc']
                                . '</option>';
                    }
                    ?>
                </select>
            </div>
            <p style="color: red">
                <?php if (isset($this->genderError)) echo $this->genderError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Date of birth: </label>

            <div class="col-sm-4 col-md-4">
                <input type="date" name=date_of_birth id="date_of_birth" class="form-control"
                       aria-describedby="basic-addon1"
                       pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$"
                       title="yyyy-mm-dd"
                       max="<?= $this->maxDate->format('Y-m-d') ?>"
                       min="<?= $this->minDate->format('Y-m-d') ?>"
                       required
                    <?php if (isset($this->newUser['date_of_birth'])) {
                        echo "value='" . $this->newUser['date_of_birth'] . "'";
                    } ?> />
            </div>
            <p style="color: red">
                <?php if (isset($this->dobError)) echo $this->dobError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Profile Picture: </label>

            <div class="col-sm-4 col-md-4">
                <input type="file" name="picture" id="picture" class="form-control upload" accept="image/*"
                       required
                    <?php if (isset($this->newUser['picture'])) {
                        echo "value='" . $this->newUser['picture'] . "'";
                    } ?> />
            </div>
            <p style="color: red">
                <?php if (isset($this->picError)) echo $this->picError; ?>
            </p>
        </div>
        <div class="col-sm-1 col-md-1  col-sm-offset-6 col-md-offset-6">
            <input type="submit" name="submitInfo" id="submitInfo" value="Next" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>
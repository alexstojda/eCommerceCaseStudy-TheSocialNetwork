<div class="jumbotron container-fluid">
    <h3>Registration (3/3) : Address Information</h3><br/>

    <form class="form-horizontal" action='<?= URL . 'register/doAddressInfo' ?>' method=POST>

        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Phone Number: </label>

            <div class="col-sm-4 col-md-4">
                <input type="phone" class="form-control" aria-describedby="basic-addon1"
                       id="phone" name="phone" required
                       pattern="^([+\-().]|\d){8,}$"
                       title="Valid phone number required"
                    <?php if (isset($this->newUser['phone'])) {
                        echo "value='" . $this->newUser['phone'] . "'";
                    } ?> />
            </div>
            <p style="color: red">
                <?php if (isset($this->phoneError)) echo $this->phoneError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Street Address: </label>

            <div class="col-sm-4 col-md-4">
                <input class="form-control" aria-describedby="basic-addon1"
                       type="text" name="address" id="address"
                       pattern="^.{4,20}$" required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['address'])) {
                        echo "value='" . $this->newUser['address'] . "'";
                    } ?> />
            </div>
            <p style="color: red">
                <?php if (isset($this->addressError)) echo $this->addressError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">City: </label>

            <div class="col-sm-4 col-md-4">
                <input class="form-control" aria-describedby="basic-addon1"
                       type="text" name="city" id="city"
                       pattern="^.{4,20}$" required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['city'])) {
                        echo "value='" . $this->newUser['city'] . "'";
                    } ?>/>
            </div>
            <p style="color: red">
                <?php if (isset($this->cityError)) echo $this->cityError; ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Province/State: </label>

            <div class="col-sm-4 col-md-4">
                <input class="form-control" aria-describedby="basic-addon1"
                       type="text" name="province" id="province" pattern="^.{4,20}$"
                       required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['province'])) {
                        echo "value='" . $this->newUser['province'] . "'";
                    } ?> />
            </div>
            <p style="color: red">
                <?php if (isset($this->provinceError)) echo $this->provinceError ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label" for="country">Country: </label>

            <div class="col-sm-4 col-md-4">
                <select class="form-control" id="country" name="country" required>
                    <option>Select a country...</option>
                    <?php foreach ($this->countries as $country) {
                        if (isset($this->newUser['country']) && $this->newUser['country'] == $country['country_ISO_ID'])
                            echo '<option selected="selected" value=\'' . $country['country_ISO_ID'] . '\' >'
                                . $country['country_name'] . '</option>';
                        echo '<option value=' . $country['country_ISO_ID'] . '> '
                            . $country['country_name'] . '</option>';
                    } ?>
                </select>
            </div>
            <p style="color: red">
                <?php if (isset($this->provinceError)) echo $this->provinceError ?>
            </p>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Postal/Zip Code: </label>

            <div class="col-sm-4 col-md-4">
                <input class="form-control" aria-describedby="basic-addon1"
                       type=text name=postalcode id=postalcode
                       pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"
                       required
                       title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"
                    <?php if (isset($this->newUser['postalcode'])) {
                        echo "value='" . $this->newUser['postalcode'] . "'";
                    } ?>/>
            </div>
            <p style="color: red">
                <?php if (isset($this->codeError)) echo $this->codeError; ?>
            </p>
        </div>
        <div class="col-sm-1 col-md-1  col-sm-offset-5 col-md-offset-5">
            <input type="submit" name="submitAddress" id="submitAddress" value="Continue"
                   class="btn btn-primary btn-lg">
        </div>
    </form>
</div>
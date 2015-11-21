<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-13
 * Time: 9:27 AM
 */
?>
<html>
<form action='<?= URL . 'register/doAddressInfo' ?>' method=POST>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Phone Number: </span>
        <input type="phone" class="form-control" aria-describedby="basic-addon1"
               id="phone" name="phone" required
               pattern="^([+\-().]|\d){8,}$"
               title="Valid phone number required"
            <?php if (isset($this->newUser['phone'])) {
                echo "value='" . $this->newUser['phone'] . "'";
            } ?> style="width:230px"/>
        <p style="color: red">
            <?php if (isset($this->phoneError)) echo $this->phoneError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Street Address: </span>
        <input class="form-control" aria-describedby="basic-addon1"
               type="text" name="address" id="address"
               pattern="^.{4,20}$" required title="Minimum 4 characters"
            <?php if (isset($this->newUser['address'])) {
                echo "value='" . $this->newUser['address'] . "'";
            } ?> style="width:230px"/>
        <p style="color: red">
            <?php if (isset($this->addressError)) echo $this->addressError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >City          :</span>
        <input class="form-control" aria-describedby="basic-addon1"
               type="text" name="city" id="city"
               pattern="^.{4,20}$" required title="Minimum 4 characters"
            <?php if (isset($this->newUser['city'])) {
                echo "value='" . $this->newUser['city'] . "'";
            } ?> style="width:230px"/>
        <p style="color: red">
            <?php if (isset($this->addressError)) echo $this->addressError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Province/State :</span>
        <input class="form-control" aria-describedby="basic-addon1"
               type="text" name="province" id="province" pattern="^.{4,20}$"
               required title="Minimum 4 characters"
               <?php if (isset($this->newUser['province'])) {
                   echo "value='" . $this->newUser['province'] . "'";
               } ?> style="width:230px"/>
        <p style="color: red">
            <?php if (isset($this->provinceError)) echo $this->provinceError ?>
        </p>
    </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Country :</span>
        <select id="country" name="country" required style="width:230px">
            <option>Select a country...</option>
            <?php
            foreach ($this->countries as $country) {
                if (isset($this->newUser['country']) && $this->newUser['country'] == $country['country_ISO_ID'])
                    echo '<option selected="selected" value=\'' . $country['country_ISO_ID'] . '\' >'
                        . $country['country_name'] . '</option>';
                echo '<option value=' . $country['country_ISO_ID'] . '> '
                    . $country['country_name'] . '</option>';
            }
            ?>
        </select>
        <p style="color: red">
            <?php if (isset($this->provinceError)) echo $this->provinceError ?>
        </p>
    </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Postal/Zip code: </span>
        <input class="form-control" aria-describedby="basic-addon1"
               type=text name=postalcode id=postalcode
               pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"
               required
               title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"
               <?php if (isset($this->newUser['postalcode'])) {
                   echo "value='" . $this->newUser['postalcode'] . "'";
               } ?> style="width:230px"/>
        <p style="color: red">
            <?php if (isset($this->codeError)) echo $this->codeError; ?>
        </p>
    </div>
    <input type="submit" name="submitAddress"  id="submitAddress" value="Continue" class="btn btn-primary btn-lg" >

</form>
</html>
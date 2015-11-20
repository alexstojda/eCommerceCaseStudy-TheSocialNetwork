<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-18
 * Time: 2:37 PM
 */
?>
<form action='<?= URL . 'register/doUserInfo' ?>' method=post>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >First Name: </span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               name=first_name id=first_name
               pattern="^([A-z]){2,20}$" title="Minimum 2 letters" required
            <?php if (isset($this->newUser['first_name'])) {
                echo "value='" . $this->newUser['first_name'] . "'";
            } ?> style="width:200px"/>
        <p style="color: red">  <?php if (isset($this->firstNameError)) echo $this->firstNameError; ?></p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Last Name: </span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               name=last_name id=last_name pattern="^([A-z]){2,20}$"
               title="Minimum 2 letters" required
            <?php if (isset($this->newUser['last_name'])) {
                echo "value='" . $this->newUser['last_name'] . "'";
            } ?> style="width:200px"/>
        <p style="color: red">
            <?php if (isset($this->lastNameError)) echo $this->lastNameError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Gender:</span>
        <select name="gender_id" id="gender_id" required>
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
        <p style="color: red">
            <?php if (isset($this->genderError)) echo $this->genderError; ?>
        </p>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Date of birth: </span>
        <input type="date" name=date_of_birth id="date_of_birth" class="form-control" aria-describedby="basic-addon1"
               pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$"
               title="yyyy-mm-dd"
               max="<?= date_sub(date_create(),
                   date_interval_create_from_date_string('13 years'))->format('Y-m-d') ?>"
               required
            <?php if (isset($this->newUser['date_of_birth'])) {
                echo "value='" . $this->newUser['date_of_birth'] . "'";
            } ?> style="width: 150px"/>
        <p style="color: red">
            <?php if (isset($this->dobError)) echo $this->dobError; ?>
        </p>
    </div>

    <input type="submit" name="submitInfo" id="submitInfo" value="Next" class="btn btn-primary btn-lg" >

</form>
<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-18
 * Time: 2:37 PM
 */
?>
<form action='<?= URL . 'register/doUserInfo' ?>' method=post>
    <table>
        <tr>
            <td>
                <label for="first_name">First Name: </label>
            </td>
            <td>
                <input type=text name=first_name id=first_name
                       pattern="^([A-z]){2,20}$" title="Minimum 2 letters" required
                    <?php if (isset($this->newUser['first_name'])) {
                        echo "value='" . $this->newUser['first_name'] . "'";
                    } ?> />
            </td>
            <td>
                <?php if (isset($this->firstNameError)) echo $this->firstNameError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="last_name">Last Name: </label>
            </td>
            <td>
                <input type=text name=last_name id=last_name pattern="^([A-z]){2,20}$"
                       title="Minimum 2 letters" required
                    <?php if (isset($this->newUser['last_name'])) {
                        echo "value='" . $this->newUser['last_name'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->lastNameError)) echo $this->lastNameError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="gender_id">Gender: </label>
            </td>
            <td>
                <select name="gender_id" id="gender_id" required>
                    <option value="">Select a gender...</option>
                    <?php
                    foreach ($this->genders as $gender) {
                        if ($this->newUser['gender'] == $gender['gender_id'])
                            echo '<option selected value="' . $gender['gender_id'] . '">' . $gender['gender_desc']
                                . '</option>';
                        else
                            echo '<option value="' . $gender['gender_id'] . '">' . $gender['gender_desc']
                                . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td>
                <?php if (isset($this->genderError)) echo $this->genderError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date_of_birth">Date of birth: </label>
            </td>
            <td>
                <input type="date" name=date_of_birth id="date_of_birth"
                       pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$"
                       title="yyyy-mm-dd"
                       max="<?= date_sub(date_create(),
                           date_interval_create_from_date_string('13 years'))->format('Y-m-d') ?>"
                       required
                    <?php if (isset($this->newUser['date_of_birth'])) {
                        echo "value='" . $this->newUser['date_of_birth'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->dobError)) echo $this->dobError; ?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submitInfo value='Continue'/>
            </td>
        </tr>
    </table>
</form>
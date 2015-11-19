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
    <table>
        <tr>
            <td>
                <label for="phone">Phone Number: </label>
            </td>
            <td>
                <input type="tel" id="phone" name="phone" required
                       pattern="^([+\-().]|\d){8,}$"
                       title="Valid phone number required"
                    <?php if (isset($this->newUser['phone'])) {
                        echo "value='" . $this->newUser['phone'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->phoneError)) echo $this->phoneError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="address">Street Address: </label>
            </td>
            <td>
                <input type="text" name="address" id="address"
                       pattern="^.{4,20}$" required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['address'])) {
                        echo "value='" . $this->newUser['address'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->addressError)) echo $this->addressError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="city">City: </label>
            </td>
            <td>
                <input type="text" name="city" id="city"
                       pattern="^.{4,20}$" required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['city'])) {
                        echo "value='" . $this->newUser['city'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->cityError)) echo $this->cityError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="province">Province/State</label>
            </td>
            <td>
                <input type="text" name="province" id="province" pattern="^.{4,20}$"
                       required title="Minimum 4 characters"
                    <?php if (isset($this->newUser['province'])) {
                        echo "value='" . $this->newUser['province'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->provinceError)) echo $this->provinceError ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="country">Country</label>
            </td>
            <td>
                <select id="country" name="country" required>
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
            </td>
            <td>
                <?php if (isset($this->countryError)) echo $this->countryError; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="postalcode">Postal/Zip code:</label>
            </td>
            <td>
                <input type=text name=postalcode id=postalcode
                       pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"
                       required
                       title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"
                    <?php if (isset($this->newUser['postalcode'])) {
                        echo "value='" . $this->newUser['postalcode'] . "'";
                    } ?>/>
            </td>
            <td>
                <?php if (isset($this->codeError)) echo $this->codeError; ?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submitAddress value='Continue'/>
            </td>
        </tr>
    </table>
</form>
</html>
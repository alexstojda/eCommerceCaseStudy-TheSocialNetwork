<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-13
 * Time: 9:27 AM
 */
$address = null;
$city = null;
$province = null;
$countryISOID = null;
$code = null;
?>
<html>
<form action='<?= URL . 'register/doProfileInfo' ?>' method=POST>
    <table>
        <tr>
            <td>
                <label for="address">Street Address: </label>
            </td>
            <td>
                <input type="text" name="address" id="address" value=''
                       pattern="^.{4,20}$" required title="Minimum 4 characters"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="city">City: </label>
            </td>
            <td>
                <input type="text" name="city" id="city" value=''
                       pattern="^.{4,20}$" required title="Minimum 4 characters"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="province">Province/State</label>
            </td>
            <td>
                <input type="text" name="province" id="province" pattern="^.{4,20}$"
                       required title="Minimum 4 characters" value=''/>
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

                        if ($countryISOID != null && $countryISOID == $country['country_iso_id'])
                            echo '<option value=' . $country['country_iso_id'] . 'selected >'
                                . $country['country_name'] . '</option>';
                        echo '<option value=' . $country['country_iso_id'] . '> '
                            . $country['country_name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type=text name=code id=code
                       pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"
                       required value=''
                       title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"/>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submitAddress value=Continue/>
            </td>
        </tr>
    </table>
</form>
</html>
<html>
<form action='<?= URL . "register/doAuthInfo" ?>' method=POST>
    <table>
        <tr>
            <td>
                <label>Username: </label>
            </td>
            <td>
                <input type="text" pattern="^([A-z]|\d){2,16}$" name=username
                       id=username title="Between 6 and 16 alphanumeric characters"
                       value='' />
            </td>
        </tr>
        <tr>
            <td>
                <label>Password: </label>
            </td>
            <td>
                <input type="password" pattern="^([A-z]|\d){6,16}$" name=password
                       id=password title="Between 6 and 16 alphanumeric characters" />
            </td>
        </tr>
        <tr>
            <td>
                <label> Confirm Password: </label>
            </td>
            <td>
                <input type="password" pattern="^([A-z]|\d){6,16}$"
                       name=confPassword id=confPassword
                       title="Between 6 and 16 alphanumeric characters" />
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submitAccount id=page1submit value=Continue />
            </td>
        </tr>
    </table>
</form>

</html>
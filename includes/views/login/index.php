<html>
<body>
<?php if(isset($this->errorMessage)) { ?>
    <h2 style="color: red;"><?= $this->errorMessage ?></h2>
<?php } ?>
<h2></h2>
    <form id="doLogin" method="post" action="<?= URL . 'login/doLogin' ?>">
        <table>
            <tr>
                <td>
                    <label for="username">Username: </label>
                </td>
                <td>
                    <input type="text" name="username" id="username" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password: </label>
                </td>
                <td>
                    <input type="password" name="password" id="password" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="doLogin" value="Login">
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

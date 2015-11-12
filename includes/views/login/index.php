
<html>
<body>
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
        </table>
    </form>

</body>
</html>

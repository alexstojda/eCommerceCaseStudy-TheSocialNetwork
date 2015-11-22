<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/22/2015
 * Time: 11:34 AM
 */
?>

<html>
<div class="jumbotron" align="center">
    <h1>Create your own Group</h1>
</div>
<form action='<?= URL . "groups/create" ?>' method=POST>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1" >Name:</span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               required type="text" pattern="^([a-zA-Z0-9\s]){1,40}$" name=name
               id=name title="Max 40 characters"

        />
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Description: </span>
        <input type="text" class="form-control" aria-describedby="basic-addon1"
               required type="password" pattern="^{1,250}$" name=description
               id=description title="Max 250 characters"
           />
    </div>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">Privacy: </span>
        <select id="privacy" name="privacy" required style="width:230px">
            <option selected value="0">Public</option>
            <option value="1">Friends</option>
            <option value="2">Invite Only</option>

        </select>
    </div>

    <input type="submit" name="submitGroup" id="submitGroup" value="Create Group" class="btn btn-primary btn-lg" >


</form>

</html>

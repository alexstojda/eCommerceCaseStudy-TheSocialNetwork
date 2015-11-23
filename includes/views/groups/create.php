<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/22/2015
 * Time: 11:34 AM
 */
?>
<div class="jumbotron container-fluid">
    <h1 align="center">Create your own Group</h1>
    <form class="form-horizontal" action='<?= URL . "groups/create" ?>' method=POST>

        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Name: </label>
            <div class="col-sm-4 col-md-4">
            <input type="text" class="form-control" aria-describedby="basic-addon1"
                   required type="text" pattern="^([a-zA-Z0-9\s]){1,40}$" name=name
                   id=name title="Max 40 characters"
            />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Description: </label>
            <div class="col-sm-4 col-md-4">
            <input type="text" class="form-control" aria-describedby="basic-addon1"
                   required type="password" pattern="^{1,250}$" name=description
                   id=description title="Max 250 characters"
               />
            </div>
        </div>
        <div  class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Privacy: </label>
            <div class="col-sm-4 col-md-4">
            <select class="form-control" id="privacy" name="privacy" required>
                <option selected value="0">Public</option>
                <option value="1">Friends</option>
                <option value="2">Invite Only</option>
            </select>
            </div>
        </div>
        <div class="col-sm-1 col-md-1  col-sm-offset-6 col-md-offset-6">
            <input type="submit" name="submitGroup" id="submitGroup" value="Create Group" class="btn btn-primary btn-lg" >
        </div>
    </form>
</div>
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

    <div class="row">

        <form class="form-horizontal col-xs-8 col-sm-8 col-md-8 col-lg-8" action='<?= URL . "groups/create" ?>'
              method=POST>

            <div class="form-group">
                <label class="col-sm-2 col-md-2 control-label">Name: </label>

                <div class="col-sm-6 col-md-6">
                    <input type="text" class="form-control" aria-describedby="basic-addon1"
                           required pattern="^([a-zA-Z0-9\s]){1,40}$" name=name
                           id=name title="Max 40 characters"
                        />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-md-2 control-label">Description: </label>

                <div class="col-sm-6 col-md-6">
                    <input type="text" class="form-control" aria-describedby="basic-addon1"
                           required pattern="^{1,250}$" name=description
                           id=description title="Max 250 characters"
                        />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-md-2 control-label" for="privacy">Privacy: </label>

                <div class="col-sm-6 col-md-6">
                    <select class="form-control" id="privacy" name="privacy" required>
                        <option selected value="0">Public</option>
                        <option value="1">Friends</option>
                        <option value="2">Invite Only</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-1 col-md-1  col-sm-offset-4 col-md-offset-4">
                <input type="submit" name="submitGroup" id="submitGroup" value="Create Group"
                       class="btn btn-primary btn-lg">
            </div>
        </form>

        <div
            class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 ">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge"></span>
                    <a href="<?= URL ?>groups">Groups</a>
                </li>
                <li class="list-group-item">
                    <span class="badge"></span>
                    <a href="<?= URL ?>groups/create">Create group</a>
                </li>

            </ul>
        </div>

    </div>
</div>
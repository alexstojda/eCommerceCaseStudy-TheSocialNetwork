<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/23/2015
 * Time: 4:44 PM
 */
?>

<div class="jumbotron container-fluid">
    <h1 align="center">Update <?= $this->name ?></h1>
    <form class="form-horizontal" action='<?= URL . "groups/update" ?>' method=POST>

        <div class="form-group">
            <label class="col-sm-2 col-md-2 control-label">Description: </label>
            <div class="col-sm-8 col-md-8">
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                       required type="password" pattern="^{1,250}$" name=description
                       id=description title="Max 250 characters" value="<?= $this->description?>"
                />
            </div>
        </div>
        <div  class="form-group">
            <label class="col-sm-4 col-md-4 control-label">Privacy: </label>
            <div class="col-sm-2 col-md-2">
                <select class="form-control" id="privacy" name="privacy" required>
                    <option <?php if($this->privacy === '0') echo'selected'; ?>value="0">Public</option>
                    <option <?php if($this->privacy === '1') echo'selected';  ?> value="1">Friends</option>
                    <option <?php  if($this->privacy === '2') echo'selected'; ?> value="2">Invite Only</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1 col-md-1  col-sm-offset-6 col-md-offset-6">

            <input type="submit" name="submitGroup" id="submitGroup" value="Update Group" class="btn btn-primary btn-lg" >
            <input type="hidden" name="g"  value= "<?= $_POST['g'] ?>" />
            <input type="hidden" name="member_id" value="<?= $_POST['member_id'] ?>" />
            </form>
        </div>
    </form>
</div>

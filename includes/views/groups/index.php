<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 7:53 PM
 */
?>

<div class="row">
    <div class="jumbotron col-xs-6 col-sm-6 col-md-6 col-lg-6 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a>Your Groups</a></li>
            <?php
            if (isset($this->groups) AND count($this->groups) > 0) {
            /**
             * lists all groups user is in
             */
            foreach ($this->groups as $group) {
                ?>
                <li role="presentation"><a
                        href=<?= URL . "groups/group?g=" . $group['group_id'] . ">" . $group['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <?php
        } else { ?>
            <tr>
                <td colspan="3">Looks like you aren't in any groups</td>
            </tr>
        <?php } ?>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
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
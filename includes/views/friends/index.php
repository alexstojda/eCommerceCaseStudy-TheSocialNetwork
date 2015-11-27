<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/27/2015
 * Time: 10:09 AM
 */

?>

<div class="row">
    <div class="jumbotron col-xs-6 col-sm-6 col-md-6 col-lg-6 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a>Your Friends</a></li>
            <?php
            if (isset($this->friends) AND count($this->friends) > 0) {

            foreach ($this->friends as $friend) {
                ?>
                <li role="presentation"><a
                        href=<?= URL . "wall?u=" . $friend['uid'] . ">" . $friend['first_name'] . " ". $friend['last_name']?></a></li>
                <?php
            }
            ?>
        </ul>
        <?php
        } else { ?>
            <tr>
                <td colspan="3">Looks like you have no friends</td>
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

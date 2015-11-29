<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-29
 * Time: 11:28 AM
 */

?>
<div class="row">

    <div
        class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Pokes Sent</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($this->uniquePokesSent as $poke) { ?>
                        <a href="<?= URL . 'wall?u='. $poke['id'] . '&' ?>" class="list-group-item">
                            <span class="badge">Total Pokes: <?= $poke['count'] ?></span>
                            <?= $poke['first_name'] . ' ' . $poke['last_name'] ?><br/>
                            <span style="text-decoration: underline; font-size: 12px;">Last poked at:  <?= $poke['poke_time'] ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Pokes Received</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($this->uniquePokesReceived as $poke) { ?>
                        <a href="<?= URL . 'wall?u='. $poke['id'] . '&' ?>" class="list-group-item">
                            <span class="badge">Total Pokes: <?= $poke['count'] ?></span>
                            <?= $poke['first_name'] . ' ' . $poke['last_name'] ?><br/>
                            <span style="text-decoration: underline; font-size: 12px;">Last poked you at:  <?= $poke['poke_time'] ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

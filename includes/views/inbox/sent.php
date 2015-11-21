<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-20
 * Time: 7:03 PM
 */
?>
<div class="panel panel-default" style="width: 50%; margin-right: auto; margin-left: auto; ">
    <div class="panel-heading">
        <h3 class="panel-title" style="font-size: 25px">Messages</h3>
        <ul class="nav nav-tabs">
            <li role="presentation">
                <a href="<?= URL . 'inbox' ?>">Inbox</a>
            </li>
            <li role="presentation" class="active">
                <a href="<?= URL . 'inbox/sent' ?>">Sent</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <?php foreach ($this->sentMessages as $message) { ?>
                <a href="<?= URL . 'inbox/u/' . $message['to_user_id'] ?>" class="list-group-item">
                    <h4 class="list-group-item-heading">
                        <?= $message['first_name'] . ' ' . $message['last_name'] ?>
                    </h4>

                    <p class="list-group-item-text" style="color: #7b7b7b">
                        <?= nl2br($message['message']) ?>
                    </p>
                </a>
            <?php } ?>
        </div>
    </div>
</div>

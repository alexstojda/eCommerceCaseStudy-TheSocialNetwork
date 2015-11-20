<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 9:55 PM
 */
?>
<div class="panel panel-default" style="width: 50%; margin-right: auto; margin-left: auto; ">
    <div class="panel-heading">
        <h3 class="panel-title">Messages</h3>
        <ul class="nav nav-tabs">
            <!-- TODO-alex make links actually do things -->
            <li role="presentation" class="active">
                <a href="<?= URL . 'inbox' ?>">Inbox</a>
            </li>
            <li role="presentation">
                <a href="<?= URL . 'inbox/sent' ?>">Sent</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <?php foreach ($this->receivedMessages as $message) { ?>
                <a href="<?= URL . 'inbox/u/' . $message['from_user_id'] ?>" class="list-group-item">
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

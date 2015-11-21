<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-20
 * Time: 7:07 PM
 */
?>
<?php if(isset($this->error)) { ?>
    <div class="alert alert-danger alert-dismissible" role="alert" style="width: 50%; margin-right: auto; margin-left: auto; ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error</strong> <?= $this->error ?>
    </div>
<?php } ?>
<div class="panel panel-default" style="width: 50%; margin-right: auto; margin-left: auto; ">
    <div class="panel-heading">
        <h3 class="panel-title" style="font-size: 25px">Messages</h3>
        <ul class="nav nav-tabs">
            <li role="presentation">
                <a href="<?= URL . 'inbox' ?>">Inbox</a>
            </li>
            <li role="presentation">
                <a href="<?= URL . 'inbox/sent' ?>">Sent</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <h4 class="panel-title" style="padding-bottom: 15px; font-size: 18px;">Conversation
            with <?= $this->name['first_name'] . ' ' . $this->name['last_name'] ?></h4>

        <div class="list-group">
            <?php
            foreach ($this->messages as $message) {
                if ($message['from_user_id'] == Session::get('id')) { ?>
                    <a class="list-group-item" style="text-align: right; background-color: rgba(0, 83, 255, 0.16)">
                        <h4 class="list-group-item-heading" style="font-size: 16px;"><?= $message['message'] ?></h4>

                        <p class="list-group-item-text"><?= $message['timesent'] ?></p>
                    </a>
                <?php } else { ?>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading" style="font-size: 16px;"><?= $message['message'] ?></h4>

                        <p class="list-group-item-text"><?= $message['timesent'] ?></p>
                    </a>
                <?php }
            } ?>
            <a class="list-group-item" style="height: 200px">
                <div class="container-fluid">
                    <div class="row">
                            <div class="form-group">
                                <form action="<?= URL ?>inbox/doMessage" method="post">
                                    <label>
                                        <textarea class="form-control" name="message" rows="4" style="width: 890px; background-color: rgba(0, 83, 255, 0.1)"
                                                  required></textarea>
                                    </label>

                                    <input type="hidden" name="from_id" value="<?= $this->fromid ?>" />
                                    <input type="hidden" name="to_id"   value="<?= $this->toid   ?>" />

                                    <div class="input-group-btn" align="right">
                                        <button type="submit" class="btn btn-default" aria-haspopup="true"
                                                aria-expanded="false">Send!
                                        </button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

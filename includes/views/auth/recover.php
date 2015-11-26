<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-26
 * Time: 10:26 AM
 */
$mail = new PHPMailer();

?>
<div class="container-fluid">
    <div class="row">
        <div
            class=" col-xs-10 col-sm-8 col-md-8 col-lg-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Forgot my password</strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="<?= URL . 'auth/sendRecovery' ?>">
                        <?php if (isset($this->emailError)) { ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <p><?= $this->emailError ?></p>
                            </div>
                        <?php } ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="maile"><strong>Email: </strong></span>
                            <input class="form-control" aria-describedby="maile"
                                   type="email" pattern="^\S+@\S+\.\S+$"
                                   name="email" id="email"
                                   title="Email must be a valid email"
                                <?php if (isset($this->user['email'])) {
                                    echo "placeholder='" . $this->user['email'] . "'";
                                } ?>/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

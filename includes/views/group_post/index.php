<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 10:31 PM
 */
?>

<div class="panel panel-default ">

    <div class="panel-heading">
        <a href="<?= URL . 'wall?u=' . $this->post->getPostBy() ?>">
            <img class="media-object thumbnail" src="http://www.gravatar.com/avatar/?d=mm&f=y" alt="..."
                 style="display: inline; height: 5%; margin: 0">
        </a>
        <a href="<?= URL . 'wall?u=' . $this->post->getPostBy() ?>"><?= $this->post->getPostByName(); ?></a>
    </div>
    <div class="media">
        <div class="media-left">
        </div>
        <div class="media-body">
            <h4 class="media-heading"></h4>

            <p><?= $this->post->getPostText() ?></p>
            <?php
            if ($this->post->getPostImage())
                echo '<img class="media-object thumbnail" src= ' . $this->post->getPostImage() . ' alt="..." style="display: inline; height: 50%;">';

            ?>
            <p><strong><i><?= $this->post->getDate() ?></strong></i></p>

            <!--  TODO comments -->
        </div>

    </div>


</div>



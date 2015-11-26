<div class="panel panel-default " xmlns="http://www.w3.org/1999/html">
    <div class="panel-heading">
        <a href="#" data-toggle="modal" data-target="#lightbox">
            <img class="media-object thumbnail" src="<?= URL . $this->post->getPostByImg() ?>" alt="..."
                 style="float: left;display: inline-block; height: 4em; margin: 0 8px 0 0;">
        </a>
        <b><a href="<?= URL . 'wall?u=' . $this->post->getPostBy(); ?>"><?= $this->post->getPostByName(); ?> </a></b>
        <?php if (!isset($_GET['u']) && !isset($_GET['g']) && $this->post->getPostBy() !== $this->post->getPostTo()) { ?>
            <i class="fa fa-chevron-right"></i>
            <b><a href="<?= URL . 'wall?u=' . $this->post->getPostTo(); ?>"><?= $this->post->getPostToName(); ?> </a></b>
        <?php } ?>
        <br/>
        <strong><i><?= $this->post->getDate() ?></i></strong>
        <?php
        if ((isset($sessionUser) && $sessionUser !== 3) || (strcmp(Session::get('my_user')['id'], $this->post->getPostBy()) === 0) || (isset($_GET['u']) && (strcmp(Session::get('my_user')['id'], $_GET['u']) === 0))) {
            echo '<form  action="' . URL . 'post/deletePost" method="post" style="display:inline; float:right">
                    <button class="btn btn-default" type="submit" name="postID" value="' . $this->post->getPostID() . '">Delete post</button>';
            if (isset($_GET['g'])) {
                echo '<input type="hidden" value=1 name="is_group"/>';
            }

            echo '<input type="hidden" name="origin" value="' . (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                    (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public'))) . '"/>';
            echo '</form></br>';
        }
        ?>

    </div>
    <div class="media">
        <div class="media-body media-right">
            <p><?= $this->post->getPostText() ?></p>
            <?php $img = $this->post->getPostImage();
            if (isset($img))
                echo '<a href="#" data-toggle="modal" data-target="#lightbox">' .
                    '<img class="media-object thumbnail" src= ' . URL . $img . ' alt="..." style="display: inline; height: 15em;"></a>'; ?>
        </div>
    </div>

    <div class="panel-footer">
        <div class="container-fluid">
            <div class="row">
                <?php //LOADS ALL COMMENTS
                if ($this->post->getComments() !== null) {
                    /** @var _Post $comment */
                    foreach ($this->post->getComments() as $comment) { ?>
                        <div class="panel panel-collapse">
                            <div class="media" style="padding: 0.4em; margin: 0;">
                                <div class="media-left">
                                    <a href="#" data-toggle="modal" data-target="#lightbox">
                                        <img class="media-object thumbnail" src="<?= URL . $comment->getPostByImg() ?>"
                                             alt="..." style="display: inline-block; height: 3.5em; margin: 0">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p>
                                        <b><a href="<?= URL . 'wall?u=' . $comment->getPostBy(); ?>"><?= $comment->getPostByName(); ?></a></b>
                                        <?= $comment->getPostText() ?>
                                        <?php
                                        if ((isset($sessionUser) && $sessionUser !== 3) || (strcmp(Session::get('my_user')['id'], $this->post->getPostBy()) === 0) || (isset($_GET['u']) && (strcmp(Session::get('my_user')['id'], $_GET['u']) === 0))) {
                                            echo '<form  action="' . URL . 'post/deletePost" method="post" style="display:inline; float:right">
                    <button class="btn btn-default" type="submit" name="postID" value="' . $comment->getPostID() . '">Delete post</button>';
                                            if (isset($_GET['g'])) {
                                                echo '<input type="hidden" value=1 name="is_group"/>';
                                            }
                                            echo '<input type="hidden" name="origin" value="' . (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                                    (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public'))) . '"/>';
                                            echo '</form></br>';
                                        } ?>
                                    </p>
                                    <?php $img = $comment->getPostImage();
                                    if (isset($img))
                                        echo '<a href="#" data-toggle="modal" data-target="#lightbox">' .
                                            '<img class="media-object thumbnail" src= ' . URL . $img . ' alt="..." style="display: inline; height: 12em;"></a>';
                                    ?>
                                </div>
                                <div class="media-bottom">
                                    <strong><i><?= $comment->getDate() ?></i></strong>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="form-group"> <!-- REPLY TO A POST -->
                    <form
                        action="<?= URL ?>post/doPost?u=<?= $this->post->getPostBy() . '&' . (isset($_GET['g']) ? 'g=' . $_GET['g'] . '&' : '')
                        ?>reply=<?= $this->post->getPostID() //(isset($_GET['u']) ? 'u='.$_GET['u'].'&' : '')    ?>"
                        method="post" style=" display:inline;" enctype="multipart/form-data">
                        <textarea class="form-control" name="post" rows="2" required
                                  placeholder="<?= ($this->post->getComments() !== null ? 'Reply to this post?' : 'Be the first to comment on this post!'); ?>"
                                  style=" display:inline; background-color: white"></textarea>

                        <div class="input-group-btn" align="right" aria-hidden="true">
                            <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">
                                Reply
                            </button>
                            <div class="fileUpload btn btn-default" style="margin:0">
                                <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                                <input type="file" name="picture" class="upload" accept="image/*"/>
                                <input type="hidden" name="origin"
                                       value="<?= (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                           (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public'))); ?>"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>


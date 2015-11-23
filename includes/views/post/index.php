<div class="panel panel-default "  >
    <div class="panel-heading">
        <img class="media-object thumbnail" src="<?=URL.$this->post->getPostByImg()?>" alt="..." style="float: left;display: inline-block; height: 4em; margin: 0px 8px 0px 0px;">
        <a href="<?= URL . 'wall?u='. $this->post->getPostBy();?>"><?= $this->post->getPostByName(); ?></a></br>
        <strong align="left"><i><?= $this->post->getDate() ?></strong></i>
    </div>
	<div class="media" >

  		<div class="media-body media-right">
    		<p><?= $this->post->getPostText() ?></p>
			<?php  $img = $this->post->getPostImage(); if( isset($img) )
				echo '<img class="media-object thumbnail" src= '.URL.$img . ' alt="..." style="display: inline; height: 15em;">';
            //LOADS ALL COMMENTS
            if($this->post->getComments() !== null) {
                    foreach($this->post->getComments() as $comment) { ?>
                    <div class="panel panel-collapse"  >
                        <div class="media" style="padding: 0.4em; margin: 0;">
                            <div class="media-left">
                                <img class="media-object thumbnail" src="<?= $comment->getPostByImg()?>" alt="..." style="display: inline-block; height: 3.5em; margin: 0px">
                            </div>
                            <div class="media-body">
                                <p>
                                <b><a href="<?= URL . 'wall?u='.  $this->post->getPostBy();?>"><?= $comment->getPostByName(); ?></a></b>
                                <?= $comment->getPostText() ?></p>
                                <?php $img = $comment->getPostImage(); if( isset($img))
                                    echo '<img class="media-object thumbnail" src= '.URL.$img . ' alt="..." style="display: inline; height: 12em;">';
                                ?>
                            </div>
                            <div class="media-bottom">
                                <strong><i><?= $comment->getDate() ?></strong></i>
                            </div>
                        </div>
                    </div>

            <?php }} ?>
        </div>
    </div>
    <!-- REPLY TO A POST -->
    <div class="panel-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="form-group">
                    <form action="<?= URL ?>post/doPost?reply=<?= $this->post->getPostID()?>" method="post"  style=" display:inline;" enctype="multipart/form-data">
                        <textarea class="form-control" name="post" rows="2" required
                                  placeholder="<?= ($this->post->getComments() !== null ? 'Reply to this post?' : 'Be the first to comment on this post!'); ?>"
                                  style=" display:inline; background-color: white"></textarea>
                        <div class="input-group-btn" align="right" aria-hidden="true">
                            <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Reply</button>
                            <div class="fileUpload btn btn-default" style="font-size:23px; margin:0">
                                <span><i class="fa fa-camera" aria-hidden="true" ></i></span>
                                <input type="file" name="picture" class="upload" accept="image/*"/>
                                <input type="hidden" name="origin" value="<?=(isset($_GET['u']) ? 'wall?u='.$_GET['u'] : //Convoluted origin identification
                                    (isset($_GET['g']) ? ltrim($_GET['url'], 'public').'?g='.$_GET['g'] : ltrim($_GET['url'], 'public')));?>"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</br>


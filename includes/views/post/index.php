<?php //http://www.devnetwork.net/viewtopic.php?f=50&t=113253
function time_passed($timestamp){
    //type cast, current time, difference in timestamps
    $timestamp      = (int) strtotime($timestamp);
    $current_time   = time();
    $diff           = $current_time - $timestamp;

    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );

    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}
?>
<div class="panel panel-default " xmlns="http://www.w3.org/1999/html">
    <div class="panel-heading">
        <a href="#" data-toggle="modal" data-target="#lightbox">
            <img  class="media-object thumbnail" src="<?=URL.$this->post->getPostByImg()?>" alt="..." style="float: left;display: inline-block; height: 4em; margin: 0px 8px 0px 0px;">
        </a>
        <a href="<?= URL . 'wall?u='. $this->post->getPostBy();?>"><?= $this->post->getPostByName(); ?></a></br>
        <strong align="left" tool><i><?= time_passed($this->post->getDate()) ?></strong></i>
    </div>
	<div class="media" >

  		<div class="media-body media-right">
    		<p><?= $this->post->getPostText() ?></p>
			<?php  $img = $this->post->getPostImage(); if( isset($img) )
				echo '<a href="#" data-toggle="modal" data-target="#lightbox">'.
                        '<img class="media-object thumbnail" src= '.URL.$img . ' alt="..." style="display: inline; height: 15em;"></a>';
            //LOADS ALL COMMENTS
            if($this->post->getComments() !== null) {
                    foreach($this->post->getComments() as $comment) { ?>
                    <div class="panel panel-collapse"  >
                        <div class="media" style="padding: 0.4em; margin: 0;">
                            <div class="media-left">
                                <a href="#" data-toggle="modal" data-target="#lightbox">
                                    <img class="media-object thumbnail" src="<?=URL.$comment->getPostByImg()?>" alt="..." style="display: inline-block; height: 3.5em; margin: 0px"></a>
                                </a>
                            </div>
                            <div class="media-body">
                                <p>
                                <b><a href="<?= URL . 'wall?u='.  $comment->getPostBy();?>"><?= $comment->getPostByName(); ?></a></b>
                                <?= $comment->getPostText() ?></p>
                                <?php $img = $comment->getPostImage(); if( isset($img))
                                    echo '<a href="#" data-toggle="modal" data-target="#lightbox">'.
                                        '<img class="media-object thumbnail" src= '.URL.$img . ' alt="..." style="display: inline; height: 12em;"></a>';
                                ?>
                            </div>
                            <div class="media-bottom">
                                <strong><i><?= time_passed($comment->getDate()) ?></strong></i>
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
                    <form action="<?=URL?>post/doPost?u=<?=$this->post->getPostBy().'&'.(isset($_GET['g']) ? 'g='.$_GET['g'].'&' : '')
                          ?>reply=<?= $this->post->getPostID() //(isset($_GET['u']) ? 'u='.$_GET['u'].'&' : '') ?>"
                          method="post"  style=" display:inline;" enctype="multipart/form-data">
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


<?php /*
<tr>
    <td colspan="2"><a href="<?= URL . 'wall?u='. $this->post->getPostBy()?>"><?= $this->post->getPostByName(); ?></a></td>
</tr>
<tr>
    <td class="gg-kixb" rowspan="2"><?= $this->post->getPostText() ?></br></br></br>
        <strong><i><?= $this->post->getDate() ?></strong></i></td>
    <td class="gg-kixb">Like / Dislike</td>
</tr>
<tr>
    <td class="gg-pxng">Post's Karma</td>
</tr>
<!--TODO: REDO POST LOOK AND WALL TOO-->
*/?>
<div class="panel panel-default"  style="width:60%; margin:auto auto;">

  	<div class="panel-heading">    
	  	<a href="<?= URL . 'wall?u='. $this->post->getPostBy()?>">
	      <img class="media-object" src="..." alt="..." style="display: inline;">
	    </a>
	    <a href="<?= URL . 'wall?u='. $this->post->getPostBy()?>"><?= $this->post->getPostByName(); ?></a>
	</div>
	<div class="media" >
		<div class="media-left">
  		</div>
  		<div class="media-body">
    		<h4 class="media-heading"></h4>
    		<p><?= $this->post->getPostText() ?></p>
    		<p> <strong><i><?= $this->post->getDate() ?></strong></i></p>
  		</div>
	</div>
</div>
</br>


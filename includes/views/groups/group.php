<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 10:08 PM
 */
$sessionUser;
$owner= [];
$admin=[];
$normal=[];
foreach($this->members as $this->member){
    if( (strcmp($this->member['user_status'], "owner") === 0)  ){
        array_push( $owner, $this->member);
        if(strcmp($this->member['user_id'], SESSION::get('id'))==0)
            $sessionUser = 1;
    }
    elseif(strcmp($this->member['user_status'], "admin") === 0) {
        array_push( $admin, $this->member);
        if(strcmp($this->member['user_id'], SESSION::get('id'))==0)
            $sessionUser = 2;
    }
    else{
        array_push( $normal, $this->member);
        if(strcmp($this->member['user_id'], SESSION::get('id'))==0)
            $sessionUser = 3;
    }
}
?>
<div>
	<h1 align="center"><?=$this->name ?> Group Wall</h1>
    <?php
    if(isset($sessionUser) && $sessionUser === 1) {
        echo '<form action="'. URL . 'groups/delete?g=' . $_GET['g'].'" method="post">';

        echo '<button type="submit" name = "delete_group" >Delete Group</button>';
        echo '</form>';
    }
    elseif(isset($sessionUser)){
        echo '<form action="'. URL . 'groups/leave?g=' . $_GET['g'].'" method="post">';
        echo '<button type="submit"  value="' . $this->member['user_id'] . '" name = "leave_id" >Leave Group</button>';
        echo '</form>';
    }
    ?>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
            <div class="form-group">
                <form action="<?= URL ?>post/doPost?g=<?= $_GET['g'] ?>" method="post"  style=" display:inline;" enctype="multipart/form-data">
                <textarea class="form-control" name="post" rows="2" required placeholder="<?=
                    'Share your thoughts with '.$this->name?>?"
                  style=" display:inline; background-color: white"></textarea>
                        <div class="input-group-btn" align="right" aria-hidden="true">
                            <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Post</button>
                            <div class="fileUpload btn btn-default" style="font-size:23px; margin:0">
                                <span><i class="fa fa-camera" aria-hidden="true" ></i></span>
                                <input type="file" name="picture" class="upload" accept="image/*"/>
                                <input type="hidden" name="origin" value="<?=ltrim($_GET['url'], 'public').'?g='.$_GET['g'];?>"/>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class=" jumbotron col-md-3 col-lg-3 col-xs-1 col-sm-1">
            <div class="media">
                <h4 class="media-heading">Group Description</h4>
                <p><?= $this->description?></p>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <?php
            if (isset($this->posts) AND count($this->posts) > 0 ) {
                foreach($this->posts as $this->post) {
                    include PATH . 'views/post/index.php';
                }
            } else { ?>
                <h4 class="bg-warning">
                    Sorry but it looks like no one posted in your group yet
                </h4>
            <?php } ?>
        </div>
        <div class="jumbotron col-md-3 col-lg-3 col-xs-1 col-sm-1">
            <div class="media">
                <h4 class="media-heading">Group Members</h4>
                <ul><?php
                    echo '<p class="media-heading">Group Owner</p>';
                    foreach($owner as $this->member){
                        echo '<li><a href="'. URL .'wall?u='. $this->member['user_id'] .'">'. $this->member['name'] .'</a></li>';
                    }
                    echo '<p class="media-heading">Group Admins</p>';
                    if(!empty($admin)) {
                        foreach ($admin as $this->member) {
                            if(isset($sessionUser) && $sessionUser === 1) {
                                echo '<form action="'. URL . 'groups/removeAdmin?g=' . $_GET['g'].'" method="post">';
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                                echo '<button type="submit" name="admin_id" value="' . $this->member['user_id'] . '">Remove Admin</button></form>';
                            }
                            else{
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . ' </a></li>';
                            }

                        }
                    }
                    else echo '<p> No Admins </p>';
                    echo '<p class="media-heading">Group Members</p>';
                    if(!empty($normal)) {
                        foreach ($normal as $this->member) {
                            if(isset($sessionUser)) {
                                echo '<form action="'. URL . 'groups/makeAdmin?g=' . $_GET['g'].'" method="post">';
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                                echo '<button type="submit" name = "admin_id" value="' . $this->member['user_id'] . '">Make Admin</button></form>';
                                echo'<form action="'. URL . 'groups/kick?g=' . $_GET['g'].'" method="post">';
                                echo '<button type="submit" name = "member_id" value="' . $this->member['user_id'] . '">kick</button></form>';
                            }
                            else{
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                            }

                        }
                    } else
                        echo '<p> No Members </p>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>
<br />
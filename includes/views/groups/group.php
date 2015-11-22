<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 10:08 PM
 */

$owner= [];
$admin=[];
$normal=[];
foreach($this->members as $this->member){
    if( (strcmp($this->member['user_status'], "owner") === 0)  ){
        array_push( $owner, $this->member);
    }
    elseif(strcmp($this->member['user_status'], "admin") === 0) {
        array_push( $admin, $this->member);
    }
    else{
        array_push( $normal, $this->member);
    }
}
?>
<script>
	function myFunction() {
        if(document.getElementById("demo").style.display == "inline")
            document.getElementById("demo").style.display = "none";
        else
            document.getElementById("demo").style.display = "inline";
    }
</script>
<div>
	<h1 align="center"><?php echo $this->name ?> Group Wall</h1>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xs-1 col-sm-1">
            <div class="media">
                <h4 class="media-heading">Group Description</h4>
                <p><?= $this->description?></p>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <div class="form-group">
                <form action="<?= URL ?>groups/post?g=<?= $_GET['g'] ?>" method="post"  style=" display:inline;" enctype="multipart/form-data">
                    <textarea class="form-control" name="post" rows="2" required  style=" display:inline; background-color: white"></textarea>

                    <div class="input-group-btn" align="right"  aria-hidden="true">

                        <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Post
                        </button>


                        <button type="button"  onclick="myFunction()" class="btn btn-default btn-lg" style="height: inherit">
                            <input id="demo" name="picture" type="file" accept="image/*" style="display: none; height: inherit; width: 105px; overflow: hidden; z-index: 5">
                            <i class="fa fa-camera" aria-hidden="true" ></i>

                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-1 col-sm-1">
            <div class="media">
                <h4 class="media-heading">Group Members</h4>
                <ul>
                    <?php

                    echo '<p class="media-heading">Group Owner</p>';
                    foreach($owner as $this->member){
                        echo '<li><a href="'. URL .'wall?u='. $this->member['user_id'] .'">'. $this->member['name'] .'</a></li>';
                    }
                    echo '<p class="media-heading">Group Admins</p>';
                    if(!empty($admin)) {
                        foreach ($admin as $this->member) {
                            echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                        }
                    }
                    else
                        echo '<p> No Admins </p>';
                    echo '<p class="media-heading">Group Members</p>';
                    if(!empty($normal)) {
                        foreach ($normal as $this->member) {
                            echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                        }
                    }
                    else
                        echo '<p> No Members </p>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
            <?php
            if (isset($this->posts) AND count($this->posts) > 0 ) {
                foreach($this->posts as $this->post) {
                    include PATH . 'views/group_post/index.php';
                }
            } else { ?>
                <tr>
                    <td colspan="3">Sorry but it looks like no one posted on your wall yet..</td>
                </tr>
            <?php } ?>
            </table>

        </div>
    </div>
</div>

</div>
<br />
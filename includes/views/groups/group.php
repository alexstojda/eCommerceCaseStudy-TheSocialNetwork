<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 10:08 PM
 */

$sessionUser = null;
$owner = [];
$admin = [];
$normal = [];
/**
 * divides all members into 1 of three categories
 * also checks to see if the current user is a member of this group
 */
foreach ($this->members as $this->member) {
    if ((strcmp($this->member['user_status'], "owner") === 0)) {
        array_push($owner, $this->member);
        if (strcmp($this->member['user_id'], Session::get('my_user')['id']) == 0)
            $sessionUser = 1;
    } elseif (strcmp($this->member['user_status'], "admin") === 0) {
        array_push($admin, $this->member);
        if (strcmp($this->member['user_id'], Session::get('my_user')['id']) == 0)
            $sessionUser = 2;
    } else {
        array_push($normal, $this->member);
        if (strcmp($this->member['user_id'], Session::get('my_user')['id']) == 0)
            $sessionUser = 3;
    }
}
?>
<div>
    <h1 align="center"><?= $this->name ?> Group Wall</h1>
</div>

<?php if (isset($sessionUser)) { ?>
    <div class="container-fluid">
        <div class="row">
            <div
                class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
                <div class="form-group">
                    <form action="<?= URL ?>post/doPost?g=<?= $_GET['g'] ?>" method="post" style=" display:inline;"
                          enctype="multipart/form-data">
                <textarea class="form-control" name="post" rows="2" required placeholder="<?=
                'Share your thoughts with ' . $this->name ?>?"
                          style=" display:inline; background-color: white"></textarea>

                        <div class="input-group-btn" align="right" aria-hidden="true">
                            <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">
                                Post
                            </button>
                            <div class="fileUpload btn btn-default" style=" margin:0">
                                <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                                <input type="file" name="picture" class="upload" accept="image/*"/>
                                <input type="hidden" name="origin"
                                       value="<?= ltrim($_GET['url'], 'public/') . '?g=' . $_GET['g']; ?>"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    Controller::anAlert('You\'re not a member of this group, therefore you can\'t post. Maybe join ' . $this->name . ' group?', 'warning');
} ?>

<div class="container-fluid">
    <div class="row">
        <div class=" jumbotron col-md-3 col-lg-3 col-xs-1 col-sm-1">
            <div class="media">
                <h4 class="media-heading">Group Description</h4>

                <p><?= $this->description ?></p>
                <?php
                /**
                 * If the user is an admin or the owner, they have the button to modify the group appear
                 */
                if (isset($sessionUser) && $sessionUser !== 3) {

                    echo '<form action="' . URL . 'groups/update"  method="post">';
                    echo '<button type="submit" name = "member_id" value="' . $this->member['user_id'] . '">Modify Group Information</button>
                    <input type="hidden" name="g" value= "' . $_GET['g'] . '""></input></form>';
                }
                ?>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <?php
            if (isset($this->posts) AND count($this->posts) > 0) {
                foreach ($this->posts as $this->post) {
                    /** @noinspection PhpIncludeInspection */
                    /** @noinspection PhpIncludeInspection */
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
                    foreach ($owner as $this->member) {
                        /**
                         * outputs link to owners wall
                         */
                        echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                    }
                    echo '<p class="media-heading">Group Admins</p>';
                    if (!empty($admin)) {
                        foreach ($admin as $this->member) {
                            /**
                             * outputs list of all admins of the group and links to each admin's wall
                             */
                            if (isset($sessionUser) && $sessionUser === 1) {
                                echo '<form action="' . URL . 'groups/removeAdmin?g=' . $_GET['g'] . '" method="post">';
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                                echo '<button type="submit" name="admin_id" value="' . $this->member['user_id'] . '">Remove Admin</button></form>';
                            } else {
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . ' </a></li>';
                            }

                        }
                    } else echo '<p> No Admins </p>';
                    echo '<p class="media-heading">Group Members</p>';
                    if (!empty($normal)) {
                        foreach ($normal as $this->member) {
                            if (isset($sessionUser) && $sessionUser !== 3) {
                                /**
                                 *  outputs list of all other members of the group and links to each wall
                                 */
                                echo '<form action="' . URL . 'groups/makeAdmin?g=' . $_GET['g'] . '" method="post">';
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                                echo '<button class="btn btn-default" type="submit" name = "admin_id" value="' . $this->member['user_id'] . '">Make Admin</button></form>';
                                echo '<form action="' . URL . 'groups/kick?g=' . $_GET['g'] . '" method="post">';
                                echo '<button class="btn btn-default" type="submit" name = "member_id" value="' . $this->member['user_id'] . '">kick</button></form>';
                            } else {
                                echo '<li><a href="' . URL . 'wall?u=' . $this->member['user_id'] . '">' . $this->member['name'] . '</a></li>';
                            }

                        }
                    } else
                        echo '<p> No Members </p>';

                    if (isset($sessionUser) && $sessionUser === 1) {
                        echo '<form action="' . URL . 'groups/delete?g=' . $_GET['g'] . '" method="post">';

                        echo '<button class="btn btn-default" type="submit" name = "delete_group" >Delete Group</button>';
                        echo '</form>';
                    } elseif (isset($sessionUser)) {
                        echo '<form action="' . URL . 'groups/leave?g=' . $_GET['g'] . '" method="post">';
                        echo '<button class="btn btn-default" type="submit"  value="' . $this->member['user_id'] . '" name = "leave_id" >Leave Group</button>';
                        echo '</form>';
                    } else {
                        echo '<form action="' . URL . 'groups/join?g=' . $_GET['g'] . '" method="post">';
                        echo '<button class="btn btn-default" type="submit"  value="' . Session::get('my_user')['id'] . '" name = "user_id" >Join Group</button>';
                        echo '</form>';
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<br/>
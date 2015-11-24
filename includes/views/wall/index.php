<div>
    <h1 align="center"><?= $this->name ?>'s Wall</h1>
</div>

<div class="container-fluid" style="padding-bottom: 30px; margin-left: auto; margin-right: auto; ">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 col-xs-offset-2 col-sm-offset-2">
            <div class="btn-group btn-group-justified" role="group" aria-label="UserActions">
                <a class="btn btn-default" style="width: 33%" href="<?= URL . 'pokes/doPoke/' . $this->id ?>">Poke <br/>  <i class="fa fa-hand-o-right fa-2x"></i></a>
                <a class="btn btn-default" style="width: 33%" href="<?= URL . 'inbox/u/' . $this->id ?>">Message  <br/>  <i class="fa fa-envelope fa-2x"></i></a>
                <!-- TODO make friends and unfriends work -->
                <a class="btn btn-default" style="width: 33%">Friend/Unfriend <br/>   <i class="fa fa-users fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-right: 0px; margin-left: auto;">
    <div class="row">
        <div
            class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
            <div class="form-group">
				<form action="<?=URL?>post/doPost?u=<?= $_GET['u'] ?>" method="post"  style=" display:inline;" enctype="multipart/form-data">
                    <textarea class="form-control" name="post" rows="2" required placeholder="<?=
                    ($_GET['u']!==Session::get('my_user')['id']) ? 'Share your thoughts with '.$this->name : 'What\'s on your mind'?>?"
                              style=" display:inline; background-color: white"></textarea>
                    <div class="input-group-btn" align="right" aria-hidden="true">
						<button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Post</button>
                        <div class="fileUpload btn btn-default" style="font-size:23px; margin:0">
                            <span><i class="fa fa-camera" aria-hidden="true" ></i></span>
                            <input type="file" name="picture" class="upload" accept="image/*"/>
                            <input type="hidden" name="origin" value="<?=ltrim($_GET['url'], 'public').'?u='.$_GET['u'];?>"/>
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </div>
</div>

<!-- GO GET ALL WALL POSTS ROW-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
		    <div id="posts"></div></br><h3 class="failed text-danger"></h3>
            <div class="panel-body" align="right">
                <button class="btn btn-lg btn-inverse loadStories"
                 onclick="loadMore()">More Stories</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var post_ids = <?= json_encode($this->posts_to_load)?>;
    var increase = 2; //CHANGE VALUE TO MODIFY NUMBER OF POSTS LOADED PER CLICK
    var limit = increase;
    function loadMore() {
        for(c = limit-increase; c < limit; c++) {
            if (c < post_ids.length) {
                $.ajax({
                    url: '<?=URL?>post',
                    type: 'GET',
                    data: {'id': post_ids[c]}, // An object with the key 'submit' and value 'true;
                    success: function (result) {
                        $("#posts").append(result);
                    }
                });
            } else {
                $(".failed").html("No more posts can be loaded.");
            }
        }
        limit += increase;
    }
    $(function() { //runs method once on load cos logic.
        loadMore();
    });
</script>

<br/>
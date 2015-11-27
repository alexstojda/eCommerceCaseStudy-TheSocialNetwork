<div class="container-fluid">
    <div class="row">

        <div
            class=" col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
            <div class="form-group">
                <form action="<?= URL ?>post/doPost" method="post" style=" display:inline;"
                      enctype="multipart/form-data">
                    <textarea class="form-control" name="post" rows="2" required placeholder="What's on your mind?"
                              style=" display:inline; background-color: white"></textarea>

                    <div class="input-group-btn" align="right" aria-hidden="true">

                        <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Post
                        </button>
                        <div class="fileUpload btn btn-default" style="margin:0">
                            <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                            <input type="file" name="picture" class="upload" accept="image/*"/>
                            <input type="hidden" name="origin" value="<?= ltrim($_GET['url'], 'public/'); ?>"/>
                        </div>
                    </div>
                </form>
            </div>
            <div id="posts">
                <?php
                if (isset($this->posts) AND count($this->posts) > 0) {
                    foreach ($this->posts as $this->post) {
                        /** @noinspection PhpIncludeInspection */
                        /** @noinspection PhpIncludeInspection */
                        include PATH . 'views/post/index.php';
                    }
                } else { ?>
                    <h4>Sorry but it looks like no one posted on your wall yet..</h4>
                <?php } ?>
            </div>
        </div>
        <div
            class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">15</span>
                    Notifications
                </li>
                <li class="list-group-item">
                    <span class="badge">6</span>
                    Friend Requests
                </li>
                <li class="list-group-item">
                    <span class="badge">9</span>
                    Group stuff
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- fixing slow page loads by limiting post loading... -->
<script type="text/javascript">
 $(document).ready(function($) {
     var start = <?= count($this->posts)?>;
     $(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height()) {
            loadMore(start);
        }
     });

     function loadMore(increase) {
         $.ajax({
             url: '<?=URL.(ltrim($_GET['url'],'public/'))?>/loadPosts',
             type: 'POST',
             data: {'u'    : <?=(isset($_GET['u']) ? $_GET['u'] : Session::get('my_user')['id'])?>,
                 'off'  : start,
                 'quantity' : increase
             }, // An object with the key 'submit' and value 'true;
             success: function (result) {
                 $("#posts").append(result);
                 start += increase;
             }
        });
     }
 });
</script>
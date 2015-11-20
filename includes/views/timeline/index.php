<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/20/2015
 * Time: 1:11 PM
 */
?>
<script>
    function myFunction() {
        if(document.getElementById("demo").style.display == "inline")
            document.getElementById("demo").style.display = "none";
        else
            document.getElementById("demo").style.display = "inline";
    }
</script>
<div class="row">
    <div  class=" col-xs-6 col-sm-6 col-md-6 col-lg-6 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

            <div class="form-group" >
                <form action="<?= URL ?>timeline/" method="post"  style=" display:inline;" enctype="multipart/form-data">
                    <textarea value="Tell us what's up..." class="form-control" name="post" rows="2" required  style=" display:inline; background-color: white"></textarea>

                    <div class="input-group-btn" align="right"  aria-hidden="true">

                        <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Post
                        </button>

                        <!-- TODO-Evan: THIS NEEDS TO BE A FILE UPLOAD.... WHY DOES IT SUBMIT FORM????>
                             <input type="file" accept="image/*" name="file" title="Attach a Photo" style=" background: transparent;
border: none !important;
font-size:0;">
                style="display: none"		 -->

                        <button type="button"  onclick="myFunction()" class="btn btn-default btn-lg" style="height: inherit">
                            <input id="demo" name="picture" type="file" accept="image/*" style="display: none; height: inherit; width: 105px; overflow: hidden; z-index: 5">
                            <i class="fa fa-camera" aria-hidden="true" ></i>

                        </button>
                    </div>
                </form>
            </div>



            <?php
            if (isset($this->posts) AND count($this->posts) > 0 ) {
                foreach($this->posts as $this->post) {
                    include PATH . 'views/post/index.php';

                }
            } else { ?>
                <tr>
                    <td colspan="3">Sorry but it looks like no one posted on your wall yet..</td>
                </tr>
            <?php } ?>




    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1"> col-md-offset-1
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

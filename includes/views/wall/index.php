<script>
	function myFunction() {
        if(document.getElementById("demo").style.display == "inline")
		    document.getElementById("demo").style.display = "none";
        else
            document.getElementById("demo").style.display = "inline";
	}
</script>
<div>
	<h1 align="center"><?php echo $this->name ?>'s Wall</h1>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
            <div class="form-group">
				<form action="<?= URL ?>wall/post?u=<?= $_GET['u'] ?>" method="post"  style=" display:inline;" enctype="multipart/form-data">
                    <textarea class="form-control" name="post" rows="2" required  style=" display:inline; background-color: white"></textarea>

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
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-xs-offset-1 col-sm-offset-1">
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
	</table>

      </div>
    </div>
</div>

	</div>
<br />
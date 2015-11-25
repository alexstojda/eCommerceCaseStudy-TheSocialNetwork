</div>


<!-- Modal -->
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- fixing slow page loads by limiting post loading... -->
<script type="text/javascript">
    var increase = 5; //CHANGE VALUE TO MODIFY NUMBER OF POSTS LOADED PER CLICK
    var start = increase;
    function loadMore() {
        $.ajax({
            url: '<?=URL?>wall/loadPosts',
            type: 'POST',
            data: {'u'    : <?=(isset($_GET['u']) ? $_GET['u'] : Session::get('my_user')['id'])?>,
                   'off'  : start
            }, // An object with the key 'submit' and value 'true;
            success: function (result) {
                $("#posts").append(result);
                start += increase;
            }
        });
    }
    function refresh() {
        $.ajax({
            url: '<?=URL?>wall/loadPosts',
            type: 'POST',
            data: {'u'        : <?=(isset($_GET['u']) ? $_GET['u'] : Session::get('my_user')['id'])?>,
                   'quantity' : start
            }, // An object with the key 'submit' and value 'true;
            success: function (result) {
                $("#posts").html(result);
                //start = increase;
            }
        });
    }
    setInterval(refresh, 25*1000);
</script>

<!-- source: http://bootsnipp.com/snippets/featured/bootstrap-lightbox-->
<script type="text/javascript">
    $(document).ready(function() {
        var $lightbox = $('#lightbox');

        $('[data-target="#lightbox"]').on('click', function(event) {
            var $img = $(this).find('img'),
                src = $img.attr('src'),
                alt = $img.attr('alt'),
                css = {
                    'maxWidth': $(window).width() - 100,
                    'maxHeight': $(window).height() - 100
                };
            $lightbox.find('.close').addClass('hidden');
            $lightbox.find('img').attr('src', src);
            $lightbox.find('img').attr('alt', alt);
            $lightbox.find('img').css(css);
        });

        $lightbox.on('shown.bs.modal', function (e) {
            var $img = $lightbox.find('img');

            $lightbox.find('.modal-dialog').css({'width': $img.width()});
            $lightbox.find('.close').removeClass('hidden');
        });
    });
</script>

<div id="footer">
    <p>&copy;TeamBana 2014-2015 | <a href="#">Site Map</a> | <a href="#">Contact Us</a> |
        <a href="http://facebook.com/devteambana"><i class="fa fa-facebook-square fa-2x"></i></a></p>
</div>

</body>
</html>
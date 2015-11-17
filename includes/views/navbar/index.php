<!-- partial view navbar-->
<!-- Bootstrap component-->

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>home">BanaBook</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo URL; ?>home">Home <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>

            <!-- USER UID IN SEARCH TO NAVIGATE AND TEST WALLS-->
        <?php if (Session::get('my_user')) : ?>
            <form class="navbar-form navbar-left" role="search" action="wall" method="get">
                <div class="form-group">
                    <input type="text" name="u" class="form-control" required placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <!-- Change corner link to either logout or login depending on session-->
                <?php if (Session::get('my_user')) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Hi <?= Session::get('my_user')['first_name']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL; ?>wall">Go to my Wall</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo URL ?>auth/doLogout">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Bootstrap modal component-->
<!-- calls login/index.php for fancy login thing -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php require_once PATH . 'views/auth/index.php' ?>
        </div>
    </div>
</div>
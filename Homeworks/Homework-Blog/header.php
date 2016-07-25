
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="post.php">My Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $array = $tools->getAll('blog_post_category');
                if (isset($_GET['category'])){
                    $categoryId = $_GET['category'];
                    $style = 'class="active"';
                }
                foreach ($array as $key => $value){
                    if (isset($categoryId)){

                        if ($value['id'] == $categoryId){
                            echo '<li ' . $style . ' ><a href="post.php?category=' . $value['id'] . '">' . $value['title'] . '</a></li>';
                        } else {
                            echo '<li><a href="post.php?category=' . $value['id'] . '">' . $value['title'] . '</a></li>';
                        }

                    } else {
                        echo '<li><a href="post.php?category=' . $value['id'] . '">' . $value['title'] . '</a></li>';
                    }
                }
                ?>
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control round" placeholder="Search" name="search">
                </div>
            </form>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>

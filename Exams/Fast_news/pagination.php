<div class="row text-center">
    <div class="col-xs-12">
        <nav>
            <ul class="pagination">
                <li>
                    <?php
                    if ($page == 0){
                        echo '<a class="pagination-lock" aria-label="Previous">';
                    } else {
                        echo '<a href="' . '?category=' . $categoryId . '&page=' . ($page - 1) . '" aria-label="Previous">';
                    }
                    ?>
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for($i=0;$i<$pageCount;$i++){
                    if ($i == $page){
                        $style = 'style="font-weight: bold;"';
                    } else {
                        $style = 'style="font-weight: 0;"';
                    }
                    echo '<li><a ' . $style . 'href="?category=' . $categoryId . '&page=' . $i . '">' . ($i + 1) . '</a></li>';
                }
                ?>
                <li>
                    <?php
                    if ($page == ($pageCount - 1)){
                        echo '<a class="pagination-lock" aria-label="Next">';
                    } else {
                        echo '<a href="' . '?category=' . $categoryId . '&page=' . ($page + 1) . '" aria-label="Next">';
                    }
                    ?>
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
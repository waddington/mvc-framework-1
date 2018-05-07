<?php
// The view showing website news
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 21:09
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">News</h3>
    </div>
    <div class="panel-body">
        <?php
        foreach ($newsData as $key => $newsDatum) {
            echo "<p><strong>$key. </strong>$newsDatum</p>";
        }
        ?>
    </div>
</div>

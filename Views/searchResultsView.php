<?php
// My view to display search results
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 18:44
 */
?>
<h1>Search Results</h1>

<p>You searched: <?php echo $searchParam; ?></p>
<table class="table table-responsive">
    <?php
    // Looping through the data and printing it out with links to the individual posts
    foreach ($searchData as $datum) {
        $content = "<tr><td><p><strong>".$datum['p_title']."</strong></p>";
        $content .= "<p>".postAdminPreview($datum['p_content'], 300)."...</p>";
        $content .= "<a href='index.php?page=singlepost&id=".$datum['p_id']."' target='_blank' class='btn-default btn'>Read more</a>";
        $content .= "</td></tr>";
        echo $content;
    }
    ?>
</table>

<?php
// My view that shows content scraped from another website
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 25/04/17
 * Time: 13:28
 */
?>

<h1>Web Scraping</h1>

<table class="table table-responsive">
    <thead>
    <th><strong>This is a page shows the titles of the first page of results, scraped with PHP, from a Google search of "Goldsmiths".</strong></th>
    </thead>
    <?php
    // Looping through an array of th data and echoing it out
    foreach ($scrapeData as $datum) {
        $result = "<tr><td>";
        $result .= $datum;
        $result .= "</td></tr>";

        echo $result;
    }
    ?>
</table>

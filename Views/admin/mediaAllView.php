<?php
// This is my media library vew
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 20:22
 */
?>
<!-- A button to upload a new item -->
<h1>All Media <a href="<?php echo BD; ?>/admin.php?page=media&modifier=upload" class="btn btn-default">Upload</a></h1>
<div class="row">
<?php
$rowCounter = 1;
$itemCounter = 1;

// Looping through each media item
foreach ($mediaData as $mediaItem) {
    // Here I create the grid cell that is visible for each item
    $content = "<div class='col-md-2 col-sm-4 col-xs 4'><div class='thumbnail'>";
    $content .= "<img src='".$mediaItem['m_filelocation'].$mediaItem['m_filename']."' alt='".$mediaItem['m_title']."' class='img-responsive' >";
    $content .= "<div class='caption'><p><strong>".$mediaItem['m_title']."</strong></p>";
    $content .= "<p><button type='button' class='btn btn-default' data-toggle='modal' data-target='#img-".$mediaItem['m_id']."'>Info</button></p></div>";
    $content .= "</div></div>";
    echo $content;

    // Here I am creating another div for each item which is the popup modal that contains more information
    // To improve on this I would only have this code once and populate the data with javascript and maybe ajax
    $modal = "<div class='modal fade' id='img-".$mediaItem['m_id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>";
    $modal .= "<div class='modal-dialog' role='document'>";
    $modal .= "<div class='modal-content'>";
    $modal .= "<div class='modal-header'><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
    $modal .= "<h4>".$mediaItem['m_title']."</h4></div>";
    $modal .= "<div class='modal-body'>";
    $modal .= "<div class='row'><div class='col-md-8'><img class='img-responsive' src='".$mediaItem['m_filelocation'].$mediaItem['m_filename']."' alt='".$mediaItem['m_title']."'></div>";
    $modal .= "<div class='col-md-4'>";
    $modal .= "<p><strong>Title: </strong>".$mediaItem['m_title']."</p>";
    $modal .= "<p><strong>Category: </strong>".$mediaItem['c_name']."</p>";
    $modal .= "<p><strong>File-type: </strong>".$mediaItem['m_type']."</p>";
    $modal .= "<p><strong>Embed Code: </strong><code style='overflow-wrap: break-word'>&lt;img src='".$mediaItem['m_filelocation'].$mediaItem['m_filename']."' alt='".$mediaItem['m_title']."' class='img-responsive'&gt;</code></p>";
    $modal .= "</div></div>";
    $modal .= "</div></div></div></div>";
    echo $modal;
}
?>
</div>

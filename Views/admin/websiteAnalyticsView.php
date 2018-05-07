<?php
// The view showing website analytics data
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 20:20
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Analytics</h3>
    </div>
    <div class="panel-body">
        <p><strong>Pageviews: </strong><?php echo $analyticsData['page-views']; ?></p>
        <p><strong>Bounce Rate: </strong><?php echo $analyticsData['bounce-rate']; ?></p>
        <p><strong>Unique Sessions: </strong><?php echo $analyticsData['uniq-sess']; ?></p>
        <p><strong>Avg. Session Duration: </strong><?php echo $analyticsData['avg-sess']; ?> (hh:mm:ss)</p>
    </div>
</div>


<h2>View All Profiles</h2>

<?php 
$count = 0;

foreach ($profile as $profileitem) { ?>
	<a href="../profiles/view/<?php echo $profileitem['Profile']['id']; ?>/<?php echo strtolower(str_replace(" ", "-", $profileitem['Profile']['profile_displayName'])); ?>">
		<?php echo ++$count.' '; ?>
		<?php echo $profileitem['Profile']['profile_displayName']; ?>
	</a>
	<br>
<?php } ?>
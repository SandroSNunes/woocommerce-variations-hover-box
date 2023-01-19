<?php
/**
 * This is an example of a shortcode view.
 * 
 * This can be copied to the child theme or the parent theme in order to fully customize it.
 */

$title = $atts['title'] ? $atts['title'] : 'Some title';

?>
<div class="variations-hover-box">
	<h3><?php echo $title; ?></h3>
	...
</div>
<?php
/**
 * The sidebar left
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrapsasswp
 */

if (!is_active_sidebar('sidebar-left')) {
    return;
}
?>

		<aside id="secondary" class="widget-area col-md-3 col-md-pull-9">
			<div class="well">
				<?php dynamic_sidebar('sidebar-left');?>
			</div>
		</aside><!-- #secondary -->

	</div><!-- .row -->
</div><!-- .container -->
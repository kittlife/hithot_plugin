<?php
defined( 'WPINC' ) || exit;

?>
<div class="wrap hithot-settings">
	<h2 class="hithot-h2"><?php echo __( 'hithot Settings', 'hithot' ); ?></h2>
	<span class="hithot-desc">
		v<?php echo HITHOT_VER; ?>
	</span>

	<hr class="wp-header-end">

	<form method="post" action="<?php menu_page_url( 'hithot' ); ?>" class="hithot-relative">
	<?php wp_nonce_field( 'hithot' ); ?>

	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><?php echo __( 'Enable Counter', 'hithot' ); ?></th>
			<td>
				<p><label><input type="checkbox" name="hithot" value="1" <?php echo get_option( 'hithot' ) ? 'checked' : ''; ?> /> <?php echo __( 'Enable', 'hithot' ); ?></label></p>
				<p class="description">
					<?php echo __( 'Disclosure: After enabled this option, frontend pages/posts will be enqueued an AJAX js to update and show the counter from HitHot.org. This service is free. The data posted to HitHot.org only contains post ID and domain. No private data sent.', 'hithot' ); ?>
				</p>
			</td>
		</tr>
	</table>

	<p class="submit">
		<?php submit_button(); ?>
	</p>
	</form>
</div>

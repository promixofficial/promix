<?php
/**
 * Provide a meta box view for the settings page
 *
 * @link http://suitpress.com
 * @since 1.0.0
 *
 * @package Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */
?>
<?php
/**
 * Meta Box
 *
 * Renders a single meta box.
 *
 * @since 1.0.0
*/
?>
<?php
$post_meta['url'] = !empty($post_meta['url']) ? esc_url($post_meta['url']) : null;
$post_meta['alt'] = (!empty($post_meta['url']) && !empty($post_meta['alt'])) ? esc_attr($post_meta['alt']) : null;
$post_meta['caption'] = (!empty($post_meta['url']) && !empty($post_meta['caption'])) ? esc_attr($post_meta['caption']) : null;
?>
<div class="preview-wrapper" <?php if (empty($post_meta['url'])) { ?>style="display:none;"<?php } ?>">
	<div class="hide-if-no-js">
		<?php if (!empty($post_meta['url'])) { ?>
			<p><img src="<?php echo $post_meta['url']; ?>" class="attachment-266x266" alt="<?php echo $post_meta['alt']; ?>"></p>
		<?php } ?>
		<p><strong><?php _e('Caption', $this->plugin_name); ?></strong></p>
		<p>
			<label class="screen-reader-text" for="<?php echo $this->plugin_slug . '[caption]'; ?>"><?php _e('Caption', $this->plugin_name); ?></label>
			<textarea name="<?php echo $this->plugin_slug . '[caption]'; ?>" id="<?php echo $this->plugin_slug . '[caption]'; ?>" placeholder="<?php _e('Caption', $this->plugin_name); ?>"><?php echo $post_meta['caption']; ?></textarea>
		</p>
		<p><strong><?php _e('Alt Text', $this->plugin_name); ?></strong></p>
		<p>
			<label class="screen-reader-text" for="<?php echo $this->plugin_slug . '[alt]'; ?>"><?php _e('Alt Text', $this->plugin_name); ?></label>
			<input type="text" name="<?php echo $this->plugin_slug . '[alt]'; ?>" id="<?php echo $this->plugin_slug . '[alt]'; ?>" value="<?php echo $post_meta['alt']; ?>" placeholder="<?php _e('Alt Text', $this->plugin_name); ?>">
		</p>
	</div>
	<p class="hide-if-no-js">
		<a href="javascript:;" class="remove-post-thumbnail"><?php _e('Remove featured image', $this->plugin_name); ?></a>
	</p>
</div>
<div class="push-wrapper" <?php if (!empty($post_meta['url'])) { ?>style="display:none;"<?php } ?>">
	<p class="hide-if-no-js">
		<input type="text" name="<?php echo $this->plugin_slug . '[url]'; ?>" value="<?php echo $post_meta['url']; ?>" placeholder="<?php _e('Enter the Image URL', $this->plugin_name); ?>">
		<input type="button" value="<?php _e('Add', $this->plugin_name); ?>" class="button">
	</p>
</div>
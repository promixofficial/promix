<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link http://suitpress.com
 * @since 1.0.0
 *
 * @package Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author SuitPress <developer@suitpress.com>
 */
class External_Featured_Image_Admin_Meta_Box {
	/**
	 * The slug of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_slug The slug of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct($plugin_slug, $plugin_name, $version) {
		$this->plugin_slug = $plugin_slug;
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Adds a box to the main column on the Post and Page edit screens.
	 *
	 * @since 1.0.0
	 */
	public function add_meta_box() {
		$options = get_option($this->plugin_slug);
		$field = 'post_type';

		if (!empty($options[$field])) {
			foreach ((array)$options[$field] as $key => $value) {
				if ($value) {
					add_meta_box($this->plugin_slug, __('External Featured Image', $this->plugin_name), array($this, 'render_meta_box'), $key, 'side', 'default');
				}
			}
		}
	}

	/**
	 * Render Meta Box content.
	 *
	 * @since 1.0.0
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box() {
		global $post;

		$post_meta = get_post_meta($post->ID, '_' . $this->plugin_slug, true);
		wp_nonce_field($this->plugin_slug . '_nonce', $this->plugin_slug . '_nonce');

		require_once plugin_dir_path(__FILE__) . 'partials/external-featured-image-meta-box-display.php';
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function meta_box_fields_save($post_id) {
		if (!isset($_POST[$this->plugin_slug . '_nonce']) || !wp_verify_nonce($_POST[$this->plugin_slug . '_nonce'], $this->plugin_slug . '_nonce')) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!empty($_POST[$this->plugin_slug]['url'])) {
			$array = $_POST[$this->plugin_slug];
			foreach ((array)$array as $key => $value) {
				if (!empty($array[$key])) {
					$array[$key] = ($key == 'url') ? esc_url($array[$key]) : wp_strip_all_tags($array[$key]);
				}
			}
			update_post_meta($post_id, '_' . $this->plugin_slug, $array);
		} else {
			delete_post_meta($post_id, '_' . $this->plugin_slug, $array);
		}
	}
}
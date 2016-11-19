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
class External_Featured_Image_Admin_Settings {
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
	 * Render checkbox content.
	 *
	 * @since 1.0.0
	 */
	public function render_checkbox_field($array) {
		$output = '<fieldset>';

		if (!empty($array['legend'])) {
			$output .= '<legend class="screen-reader-text"><span>' . $array['legend'] . '</span></legend>';
		}

		if (!empty($array['items'])) {
			foreach ($array['items'] as $key => $value) {
				$output .= '<label for="' . $value['id'] . '">';
				$output .= '<input type="checkbox" value="' . $value['value'] . '" id="' . $value['id'] . '" name="' . $value['name'] . '"' . $value['checked'] . ' />';
				$output .= $value['label'];
				$output .= '</label>';
				$output .= '<br>';
			}
		}

		if (!empty($array['description'])) {
				$output .= '<p class="description">' . $array['description'] . '</p>';
		}

		$output .= '</fieldset>';

		return $output;
	}

	/**
	 * Reset theme defaults and registers support for various WordPress features.
	 */
	public function remove_post_type_support() {
		$options = get_option($this->plugin_slug);
		$field = 'post_type';

		if (!empty($options[$field])) {
			foreach ($options[$field] as $post_type => $value) {
				remove_post_type_support($post_type, 'thumbnail');
			}
		}
	}

	/**
	 * Add extra submenus and menu options to the admin panel's menu structure.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		add_options_page(__('External Featured Image', $this->plugin_name), __('External Featured Image', $this->plugin_name), 'manage_options', $this->plugin_name, array($this, 'add_options_page'));
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since 1.0.0
	 */
	public function register_setting() {
		register_setting($this->plugin_slug . '-group', $this->plugin_slug);

		add_settings_section('general_setting_section', __('General Settings', $this->plugin_name), array($this, 'general_setting_section_callback'), $this->plugin_name);
		add_settings_field('post_type_field', __('Post Types', $this->plugin_name), array($this, 'post_type_field_callback'), $this->plugin_name, 'general_setting_section');
		add_settings_field('remove_featured_image_field', __('Remove Featured Image', $this->plugin_name), array($this, 'remove_featured_image_field_callback'), $this->plugin_name, 'general_setting_section');
		add_settings_field('relative_url_field', __('Relative URL', $this->plugin_name), array($this, 'relative_url_field_callback'), $this->plugin_name, 'general_setting_section');

		add_settings_section('uninstall_setting_section', __('Uninstall Settings', $this->plugin_name), array($this, 'uninstall_setting_section_callback'), $this->plugin_name);
		add_settings_field('remove_option_field', __('Remove options and Post Meta', $this->plugin_name), array($this, 'remove_option_field_callback'), $this->plugin_name, 'uninstall_setting_section');
	}

	/**
	 * Add sub menu page to the Settings menu.
	 *
	 * @since 1.0.0
	 */
	public function add_options_page() {
		require_once plugin_dir_path(__FILE__) . 'partials/external-featured-image-settings.php';
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function general_setting_section_callback() {
		//_e("Please check the appropriate box below if there's a post type that you want to include in your site.", $this->plugin_name);
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function post_type_field_callback() {
		$options = get_option($this->plugin_slug);
		$field = 'post_type';
		$value = 1;

		$post_types = get_post_types(array('public' => true), 'objects');
		$excluded_post_types = array('attachment', 'revision', 'nav_menu_item');

		foreach ((array)$post_types as $key => $post_type) {
			if (in_array($post_type->name, $excluded_post_types)) {
				continue;
			}

			$items[$key]['label'] = $post_type->label;
			$items[$key]['id'] = $field . '_' . $post_type->name;
			$items[$key]['name'] = $this->plugin_slug . '[' . $field . '][' . $post_type->name . ']';
			$items[$key]['value'] = $value;
			$items[$key]['checked'] = checked($value, $options[$field][$post_type->name], 0);
		}

		$output = $this->render_checkbox_field(array(
			'legend' => __('Select Post Types', $this->plugin_name),
			'items' => $items
		));

		echo $output;
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function relative_url_field_callback() {
		$options = get_option($this->plugin_slug);
		$field = 'relative_url';
		$value = 1;

		$items[$field]['label'] = __('Enable', $this->plugin_name);
		$items[$field]['id'] = $this->plugin_slug . '_' . $field;
		$items[$field]['name'] = $this->plugin_slug . '[' . $field . ']"';
		$items[$field]['value'] = $value;
		$items[$field]['checked'] = checked($value, $options[$field], 0);

		$output = $this->render_checkbox_field(array(
			'legend' => __('Enable', $this->plugin_name),
			'items' => $items,
			'description' => __('Overrides that functionality and forces it to use relative URL.', $this->plugin_name)
		));

		echo $output;
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function remove_featured_image_field_callback() {
		$options = get_option($this->plugin_slug);
		$field = 'remove_featured_image';
		$value = 1;

		$items[$field]['label'] = __('Enable', $this->plugin_name);
		$items[$field]['id'] = $this->plugin_slug . '_' . $field;
		$items[$field]['name'] = $this->plugin_slug . '[' . $field . ']"';
		$items[$field]['value'] = $value;
		$items[$field]['checked'] = checked($value, $options[$field], 0);

		$output = $this->render_checkbox_field(array(
			'legend' => __('Enable', $this->plugin_name),
			'items' => $items,
			'description' => __('Remove support for post thumbnail (featured image)', $this->plugin_name)
		));

		echo $output;
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function uninstall_setting_section_callback() {
		//_e("Please check the appropriate box below if there's a post type that you want to include in your site.", $this->plugin_name);
	}

	/**
	 * Function that fills the section with the desired content. The function should echo its output.
	 *
	 * @since 1.0.0
	 */
	public function remove_option_field_callback() {
		$options = get_option($this->plugin_slug);
		$field = 'remove_option';
		$value = 1;

		$items[$field]['label'] = __('Enable', $this->plugin_name);
		$items[$field]['id'] = $this->plugin_slug . '_' . $field;
		$items[$field]['name'] = $this->plugin_slug . '[' . $field . ']"';
		$items[$field]['value'] = $value;
		$items[$field]['checked'] = checked($value, $options[$field], 0);

		$output = $this->render_checkbox_field(array(
			'legend' => __('Enable', $this->plugin_name),
			'items' => $items,
			'description' => __('This tool will delete option when uninstalling via plugins > Delete.', $this->plugin_name)
		));

		echo $output;
	}
}
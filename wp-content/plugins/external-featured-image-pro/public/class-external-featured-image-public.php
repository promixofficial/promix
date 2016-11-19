<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link http://suitpress.com
 * @since 1.0.0
 *
 * @package Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Plugin_Name
 * @subpackage Plugin_Name/public
 * @author SuitPress <developer@suitpress.com>
 */
class External_Featured_Image_Public {
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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct($plugin_slug, $plugin_name, $version) {
		$this->plugin_slug = $plugin_slug;
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugin-name-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the javascript for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugin-name-public.js', array('jquery'), $this->version, false);
	}

	/**
	 * Removes the http or https protocols and the domain. Keeps the path '/' at the beginning, so it isn't a true relative link, but from the web root base.
	 *
	 * @since 1.0.0
	 */
	public function relative_url($link) {
		$options = get_option($this->plugin_slug);
		$field = 'relative_url';

		if (!empty($options[$field])) {
			preg_match('|https?://([^/]+)(/.*)|i', $link, $matches);

			if (!isset($matches[1]) || !isset($matches[2])) {
				return $link;
			} elseif (($matches[1] === $_SERVER['SERVER_NAME']) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']) {
				return wp_make_link_relative($link);
			} else {
				return $link;
			}
		} else {
			return $link;
		}
	}

	/**
	 * Returns a boolean if a post has a external featured image (formerly known as Post Thumbnail) inserted (true) or not (false).
	 *
	 * @since 1.0.0
	 */
	public function has_external_thumbnail($post_id = null) {
		$thumbnail = $this->get_external_thumbnail_metadata($post_id);

		if (empty($thumbnail['url'])) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Retrieve thumbnail meta field for post ID.
	 *
	 * @since 1.0.0
	 */
	public function get_external_thumbnail_metadata($post_id = null) {
		$post_id = (null === $post_id) ? get_the_ID() : $post_id;

		$post_meta = get_post_meta($post_id, '_' . $this->plugin_slug, true);
		$post_meta['url'] = !empty($post_meta['url']) ? $this->relative_url(esc_url($post_meta['url'])) : null;
		$post_meta['alt'] = (!empty($post_meta['url']) && !empty($post_meta['alt'])) ? esc_attr($post_meta['alt']) : null;
		$post_meta['caption'] = (!empty($post_meta['url']) && !empty($post_meta['caption'])) ? esc_attr($post_meta['caption']) : null;

		if (empty($post_meta['url']) || strlen($post_meta['url']) == 0) {
			return false;
		} else {
			return $post_meta;
		}
	}

	/**
	 * Returns the tag with the external featured image.
	 *
	 * @since 1.0.0
	 */
	public function get_external_thumbnail($post_id = null, $size = false, $attr = array()) {
		global $_wp_additional_image_sizes;

		if (!$this->has_external_thumbnail($post_id)) {
			return false;
		}

		if (is_array($size)) {
			$width = $size[0];
			$height = $size[1];
		} else if (isset($_wp_additional_image_sizes[$size])) {
			$width = $_wp_additional_image_sizes[$size]['width'];
			$height = $_wp_additional_image_sizes[$size]['height'];
			$additional_classes = 'attachment-' . $size . ' ';
		}

		$width = ($width && $width > 0) ? "width:${width}px;" : '';
		$height = ($height && $height > 0) ? "height:${height}px;" : '';

		if (isset($attr['class'])) {
			$additional_classes .= $attr['class'];
		}

		$thumbnail = $this->get_external_thumbnail_metadata($post_id);
		$style = isset($attr['style']) ? 'style="' . $attr['style'] . '" ' : null;

		if (is_feed()) {
			$html = sprintf('<img src="%s" %s' . 'class="%s wp-post-image" '. 'alt="%s" />', $thumbnail['url'], $style, $additional_classes, $thumbnail['alt']);
		} else {
			$html = sprintf('<img src="%s" %s' . 'class="%s wp-post-image" '. 'alt="%s" />', $thumbnail['url'], $style, $additional_classes, $thumbnail['alt']);
		}

		return $html;
	}

	/**
	 * Overriding filter the post thumbnail HTML.
	 *
	 * @since 1.0.0
	 */
	public function post_thumbnail_html($html, $post_id, $post_image_id, $size, $attr) {
		if ($this->has_external_thumbnail($post_id)) {
			$html = $this->get_external_thumbnail($post_id, $size, $attr);
		}

		return $html;
	}

	/**
	 * Setting a featured image for all posts imported from external url.
	 *
	 * @since 1.0.0
	 */
	public function the_post($post) {
		$post_id = is_array($post) ? $post['ID'] : $post->ID;

		$external_thumbnail = $this->has_external_thumbnail($post_id);
		$wordpress_thumbnail = get_post_meta($post_id, '_thumbnail_id', true);

		if ($external_thumbnail && !$wordpress_thumbnail) {
			update_post_meta($post_id, '_thumbnail_id', '_'. $this->plugin_slug);
		}

		if (!$external_thumbnail && $wordpress_thumbnail == '_' . $this->plugin_slug) {
			delete_post_meta($post_id, '_thumbnail_id');
		}
	}
}
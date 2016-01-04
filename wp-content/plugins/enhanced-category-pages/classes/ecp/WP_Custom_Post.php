<?php

namespace ecp;

defined( 'ABSPATH' ) OR exit;

abstract class WP_Custom_Post {
	protected $_name;
	protected $_name_plural;
	protected $_translation_domain;
	public $id;

	//private $meta;

	public function __construct($translation_domain = "")
    {
		$this->_translation_domain = $translation_domain;
		if ($this->_name)
        {
			//add filter to insure the text $_name is displayed when user updates/inserts
			add_filter('post_updated_messages', array(&$this, 'updated_messages'));
		}
	}

	public function updated_messages($messages) {
		global $post, $post_ID;
		$_uname = ucfirst($this->_name);
		$revision = isset($_GET['revision']) ? (int) isset($_GET['revision']) : 0;
		//$_uname_plural = ucfirst($this->_name_plural);

		$messages[$this->get_safe_name()] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => $this->translate('Successfully updated. <!--a href="%s">View</a-->', $_uname, esc_url(get_permalink($post_ID)), $this->_name),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => $this->translate('Successfully updated', $_uname),
			5 => $revision ? $this->translate('Restored to revision from %s', $_uname, wp_post_revision_title($revision, false)) : false,
			6 => $this->translate('Published. <a href="%s">View</a>', $_uname, esc_url(get_permalink($post_ID)), $this->_name),
			7 => $this->translate('Saved.', $_uname),
			8 => $this->translate('Submitted. <a target="_blank" href="%s">Preview</a>', $_uname, esc_url(add_query_arg('preview', 'true', get_permalink($post_ID))), $this->_name),
			9 => $this->translate('Scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview</a>', $_uname, date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID)), $this->_name),
			10 => $this->translate('Draft updated. <a target="_blank" href="%s">Preview</a>', $_uname, esc_url(add_query_arg('preview', 'true', get_permalink($post_ID))), $this->_name),
		);

		return $messages;
	}

	public function get_name() {
		return $this->_name;
	}

	//translates all parameters and then they are sprintf-ed in the first parameter
	protected function translate($str1) {
		$str1;
		$translation = '';

		$args = func_get_args();

		//translate each string received as argument
		array_walk($args, function (&$str, $index, $translation_domain) {
			$index;
			$str = __($str, $translation_domain);
		}, $this->_translation_domain);

		$translation = call_user_func_array('sprintf', $args);

		return $translation;
	}

	public function get_safe_name() {
		return sanitize_key($this->_name);
	}
}

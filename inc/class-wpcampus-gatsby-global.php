<?php

/**
 * The class that sets up
 * global plugin functionality.
 *
 * This class is initiated on every page
 * load and does not have to be instantiated.
 *
 * @class       WPCampus_Gatsby_Global
 * @package     WPCampus_Gatsby
 */
final class WPCampus_Gatsby_Global {

	/**
	 * We don't need to instantiate this class.
	 */
	protected function __construct() { }

	/**
	 * Registers all of our hooks and what not.
	 */
	public static function register() {
		$plugin = new self();

		// Filter the field to include form choices.
		add_filter( 'acf/load_field/name=wpc_gatsby_form', [ $plugin, 'load_gravity_form_field_choices' ] );

		// Register custom fields for the REST API.
		add_action( 'rest_api_init', [ $plugin, 'register_rest_fields' ] );

	}

	/**
	 * Modifies ACF field to include list
	 * of choices for our Gravity forms.
	 */
	public function load_gravity_form_field_choices( $field ) {

		// Reset choices.
		$field['choices'] = [];

		// Get list of forms.
		$forms = class_exists( 'GFAPI' ) ? GFAPI::get_forms() : [];

		if ( empty( $forms ) ) {
			return $field;
		}

		foreach ( $forms as $form ) {

			$form_id = $form['id'];
			if ( empty( $form_id ) ) {
				continue;
			}

			$form_title = $form['title'];
			if ( empty( $form_title ) ) {
				continue;
			}

			$field['choices'][ $form_id ] = $form_title;

		}

		return $field;
	}

	/**
	 * Register custom fields for REST API.
	 */
	public function register_rest_fields() {

		register_rest_field(
			[
				'post',
				'page',
				'podcast',
			],
			'wpc_gatsby',
			[
				'get_callback' => [ $this, 'get_wpc_gatsby_meta' ],
			]
		);
	}

	/**
	 * Add data to "wpc_gatsby" API field.
	 *
	 * @param $object
	 * @param $field_name
	 *
	 * @return array
	 */
	public function get_wpc_gatsby_meta( $object, $field_name ) {

		$disable = get_post_meta( $object['id'], 'wpc_gatsby_disable_build', true );
		$disable = ! empty( $disable );

		$template = get_post_meta( $object['id'], 'wpc_gatsby_template', true );

		$forms = [];
		if ( 'form' === $template ) {
			$post_forms = get_post_meta( $object['id'], 'wpc_gatsby_form', true );
			if ( ! empty( $post_forms ) && is_array( $post_forms ) ) {
				$forms = array_map('intval', $post_forms );
			}
		}

		return [
			'disable'  => $disable,
			'template' => $template,
			'forms'    => $forms,
		];
	}
}

WPCampus_Gatsby_Global::register();

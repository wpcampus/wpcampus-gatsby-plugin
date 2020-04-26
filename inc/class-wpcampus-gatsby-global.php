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

		// Register custom fields for the REST API.
		add_action( 'rest_api_init', [ $plugin, 'register_rest_fields' ] );

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

		return [
			'disable' => $disable,
		];
	}
}

WPCampus_Gatsby_Global::register();

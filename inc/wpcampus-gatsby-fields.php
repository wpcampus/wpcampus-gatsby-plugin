<?php

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group(
	[
		'key'                   => 'group_5ea39a3d338d0',
		'title'                 => 'WPCampus: Gatsby',
		'fields'                => [
			[
				'key'               => 'field_5ea39a4d0595b',
				'label'             => 'Disable for build',
				'name'              => 'wpc_gatsby_disable_build',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'message'           => 'Disable content from being included in Gatsby build',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			],
			[
				'key'               => 'field_5ea4ceec272bb',
				'label'             => 'Template',
				'name'              => 'wpc_gatsby_template',
				'type'              => 'select',
				'instructions'      => 'By default, will use template assigned to post type.',
				'required'          => 0,
				'conditional_logic' => 0,
				'choices'           => [
					'form'    => 'Form',
					'library' => 'Library',
				],
				'default_value'     => [],
				'allow_null'        => 1,
				'multiple'          => 0,
				'ui'                => 1,
				'ajax'              => 0,
				'return_format'     => 'value',
				'placeholder'       => '',
			],
		],
		'location'              => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				],
			],
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				],
			],
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'podcast',
				],
			],
		],
		'menu_order'            => - 10,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'left',
		'instruction_placement' => 'field',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	]
);

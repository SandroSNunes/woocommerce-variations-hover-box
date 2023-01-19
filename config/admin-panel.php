<?php
/**
 * Admin panel configuration strucutre.
 */

defined( 'WVHB' ) || exit;

$config = [

    'general' => [
        'label'    => __( 'Woo Variations Hover Box', 'wvhb' ),
        'sections' => [

            'general' => [
                'title'       =>  '',
                'description' => '',
                'fields'      => [

                    'wvhb_attribute_name' => [
                        'title'       => __( 'Product attribute', 'wvhb' ),
                        'description' => __( 'The product attribute to show on the hover box.', 'wvhb' ),
                        'type'        => 'select-product-attributes',
                        'default'     => ''
					],

					'wvhb_style' => [
                        'title'       => __( 'Style', 'wvhb' ),
                        'description' => __( 'The style of the hover box and its elements.', 'wvhb' ),
						'type'        => 'select',
						'options'     => [
							'1' => 'Big box + Big buttons + Background Hovering',
							'2' => 'Big box + Small buttons + Background Hovering',
							'3' => 'Small box + Small buttons + Background Hovering',
							'4' => 'Big box + Big buttons + Border Hovering',
							'5' => 'Big box + Small buttons + Border Hovering',
							'6' => 'Small box + Small buttons + Border Hovering',
						],
                        'default'     => '1',
					],

					'wvhb_always_visible' => [
                        'title'       => __( 'Hover box always visible', 'wvhb' ),
                        'description' => __( 'Whether the hover box is always visible or only when hovering the products.', 'wvhb' ),
                        'type'        => 'checkbox',
                        'default'     => '',
					],

					'wvhb_title_visible' => [
                        'title'       => __( 'Title visible', 'wvhb' ),
                        'description' => __( 'Whether the title is visible.', 'wvhb' ),
                        'type'        => 'checkbox',
                        'default'     => '1',
					],

					'wvhb_title' => [
                        'title'       => __( 'Title', 'wvhb' ),
                        'description' => __( 'Title of the hover box above the variations buttons.', 'wvhb' ),
                        'type'        => 'text',
                        'default'     => __( 'Quick add', 'wvhb' ),
					],

                    'wvhb_check_mark_delay' => [
                        'title'       => __( 'Check mark delay', 'wvhb' ),
                        'description' => __( 'The time in milliseconds that the check mark will show after a variation has been added to the cart.', 'wvhb' ),
                        'type'        => 'number',
                        'default'     => '1500',
					],

				],
			],

		],
	],
	
];

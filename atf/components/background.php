<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/17/13
 * Time: 5:18 PM
 */

function themename_customize_register($wp_customize){

	//  =============================
	//  = Radio Input               =
	//  =============================
	$wp_customize->add_setting('bootstrap_theme_options[background_size]', array(
		'default'        => 'cover',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	));

	$wp_customize->add_control('bootstrap_background_size', array(
		'label'      => __('Background size', 'bootstrap'),
		'section'    => 'background_image',
		'settings'   => 'bootstrap_theme_options[background_size]',
		'type'       => 'radio',
		'choices'    => array(
			'cover' => 'Cover',
			'100% auto' => 'Розтягнути по ширині',
			'auto 100%' => 'Розтягнути по висоті',
			'auto auto' => 'В натуральний розмір',
		),
	));


}

add_action('customize_register', 'themename_customize_register');
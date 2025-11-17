<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function ensaf_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'ensaf_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function ensaf_register_metabox() {

	$prefix = '_ensaf_';

	$prefixpage = '_ensafpage_';
	
	$ensaf_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'ensaf' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );

    $ensaf_post_meta->add_field( array(
        'name' => esc_html__( 'Post Format Video', 'ensaf' ),
        'desc' => esc_html__( 'Use This Field When Post Format Video', 'ensaf' ),
        'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );

	$ensaf_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'ensaf' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'ensaf' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$ensaf_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'ensaf' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'ensaf' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );
	
	$ensaf_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'ensaf' ),
		'object_types'  => array( 'page', 'ensaf_event' ), // Post type
        'closed'        => true
    ) );

    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'ensaf' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'ensaf' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','ensaf'),
            '2'     => esc_html__('Hide','ensaf'),
        )
    ) );


    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'ensaf' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__('Global Settings','ensaf'),
            'page'     => esc_html__('Page Settings','ensaf'),
        )
	) );

    $ensaf_page_meta->add_field( array(
        'name'    => esc_html__( 'Breadcumb Image', 'ensaf' ),
        'desc'    => esc_html__( 'Upload an image or enter an URL.', 'ensaf' ),
        'id'      => $prefix . 'breadcumb_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => __( 'Add File', 'ensaf' ) // Change upload button text. Default: "Add or Upload File"
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'ensaf' ),
		'desc' => esc_html__( 'check to display Page Title.', 'ensaf' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','ensaf'),
            '2'     => esc_html__('Hide','ensaf'),
        )
	) );

    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'ensaf' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','ensaf'),
            'custom'  => esc_html__('Custom Title','ensaf'),
        ),
        'default'   => 'default'
    ) );

    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'ensaf' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $ensaf_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'ensaf' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'ensaf' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => ensaf_set_checkbox_default_for_new_post( true ),
    ) );

    $ensaf_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'ensaf' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$ensaf_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'ensaf' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'ensaf' ),
            '2' => esc_html__( 'Container Fluid', 'ensaf' ),
            '3' => esc_html__( 'Fullwidth', 'ensaf' ),
        ),
	) );

	// code for body class//

    $ensaf_layout_meta->add_field( array(
	'name' => esc_html__( 'Insert Your Body Class', 'ensaf' ),
	'id'   => $prefix . 'custom_body_class',
	'type' => 'text'
    ) );

}

add_action( 'cmb2_admin_init', 'ensaf_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function ensaf_register_taxonomy_metabox() {

    $prefix = '_ensaf_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$ensaf_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'ensaf' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$ensaf_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'ensaf' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	$ensaf_term_meta->add_field( array(
		'name' => esc_html__( 'Category Image', 'ensaf' ),
		'desc' => esc_html__( 'Set Category Image', 'ensaf' ),
		'id'   => $prefix.'term_avatar',
        'type' => 'file',
        'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','ensaf') // Change upload button text. Default: "Add or Upload File"
		),
	) );


	/**
	 * Metabox for the user profile screen
	 */
	$ensaf_user = new_cmb2_box( array(
		'id'               => $prefix.'user_edit',
		'title'            => esc_html__( 'User Profile Metabox', 'ensaf' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta as post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
    $ensaf_user->add_field( array(
		'name' => esc_html__( 'Author Designation', 'ensaf' ),
		'desc' => esc_html__( 'Use This Field When Author Designation', 'ensaf' ),
		'id'   => $prefix . 'author_desig',
        'type' => 'text',
    ) );
	$ensaf_user->add_field( array(
		'name'     => esc_html__( 'Social Profile', 'ensaf' ),
		'id'       => $prefix.'user_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$group_field_id = $ensaf_user->add_field( array(
        'id'          => $prefix .'social_profile_group',
        'type'        => 'group',
        'description' => __( 'Social Profile', 'ensaf' ),
        'options'     => array(
            'group_title'       => __( 'Social Profile {#}', 'ensaf' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Social Profile', 'ensaf' ),
            'remove_button'     => __( 'Remove Social Profile', 'ensaf' ),
            'closed'         => true
        ),
    ) );

    $ensaf_user->add_group_field( $group_field_id, array(
        'name'        => __( 'Icon Class', 'ensaf' ),
        'id'          => $prefix .'social_profile_icon',
        'type'        => 'text', // This field type
    ) );

    $ensaf_user->add_group_field( $group_field_id, array(
        'desc'       => esc_html__( 'Set social profile link.', 'ensaf' ),
        'id'         => $prefix . 'lawyer_social_profile_link',
        'name'       => esc_html__( 'Social Profile link', 'ensaf' ),
        'type'       => 'text'
    ) );
}

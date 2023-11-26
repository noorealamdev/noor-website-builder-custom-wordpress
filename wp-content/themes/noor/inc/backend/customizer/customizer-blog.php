<?php
function blog_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'noor',
	);

	$panels = array(	
	    'blog'        => array(
			'title'      => esc_html__( 'Blog', 'noor' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'noor' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'noor' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
	);

	$fields = array(
		/* blog settings */
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'noor' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'noor' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),	
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'noor' ),
            'section'  => 'blog_page',
            'default'  => array( 'comm', 'date', 'author' ),
            'choices'  => array(
                'date'    => esc_html__( 'Date', 'noor' ),
                'author'  => esc_html__( 'Author', 'noor' ),
                'comm'    => esc_html__( 'Comments', 'noor' ),
            ),
            'priority' => 10,
        ),
        'blog_read_more'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Read More Button', 'noor' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'Read More', 'noor' ),
			'priority'        => 11,
		),
		'blog_subtitle'      => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Subtitle Page Header', 'noor' ),
	 		'description'     => esc_attr__( 'Remove to show the breadcrumb.', 'noor' ), 
			'section'         => 'blog_page',
			'default'         => esc_html__( 'Welcome to our journal. Here you can find the latest company news and business articles.', 'noor' ),
			'priority'        => 11,
		),
        /* single blog */
        'single_separator4'      => array(
            'type'        => 'custom',
			'label'       => esc_html__( 'Specific Page Header', 'noor' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
        ),
        'single_post_bg_top_page'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Background Page Header', 'noor' ),
			'section'  => 'single_post',
			'priority' => 10,
		),
		'pheader_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color Page Header', 'noor' ),
            'section'  => 'single_post',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.single-page-header.post-box .post-header *, .single-page-header.post-box .post-header a:hover',
                    'property' => 'color'
                ),
                array(
                    'element'  => '.single-page-header .post-header .post-cates:before',
                    'property' => 'background'
                ),
            ),
        ),
		'single_post_spacing_top_page' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Padding Page Header(ex: 10px)', 'noor' ),
            'section'  => 'single_post',
            'priority' => 10,
            'default'  => array(
                'padding-top'   => '',
				'padding-bottom'  => '',
            ),
            'choices'     => array(
				'labels' => array(
					'padding-top' => esc_html__( 'Padding Top', 'noor' ),
					'padding-bottom' => esc_html__( 'Padding Bottom', 'noor' ),
				),
			),    
			'output'    => array(
                array(
                    'element'  => '.single-page-header'
                ),
            ),
        ),
        'sheader_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'noor' ), 
	 		'section'     => 'single_post', 
	 		'default'     => '', 
	 		'priority'    => 10,
	 		'placeholder' => esc_attr__( 'Select a header', 'noor' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'noor_header_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'sheader_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'noor' ),
            'section'     => 'single_post',
			'default'     => '1',
			'priority'    => 10,
        ),
        'sheader_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'noor' ), 
	 		'section'     => 'single_post', 
	 		'default'     => '', 
	 		'priority'    => 10,
	 		'placeholder' => esc_attr__( 'Select a header', 'noor' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'noor_header_builders', 'posts_per_page' => -1 ) ) : array(),
        ),
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'noor' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Social Share', 'noor' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twitter', 'facebook', 'linkedin' ),
            'choices'  => array(
                'twit'  	=> esc_html__( 'Twitter', 'noor' ),
                'face'    	=> esc_html__( 'Facebook', 'noor' ),
                'link'     	=> esc_html__( 'Linkedin', 'noor' ),
                'google'  	=> esc_html__( 'Google Plus', 'noor' ),
                'tumblr'    => esc_html__( 'Tumblr', 'noor' ),
                'reddit'    => esc_html__( 'Reddit', 'noor' ),
                'vk'     	=> esc_html__( 'VK', 'noor' ),
            ),
            'priority' => 10,
        ),
        'single_separator3'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'noor' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'noor' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Related Posts', 'noor' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),

	);

	$settings['panels']   = apply_filters( 'noor_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'noor_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'noor_customize_fields', $fields );

	return $settings;
}

$noor_customize = new Noor_Customize( blog_customize_settings() );
<?php
/**
 * MT  Theme Theme Customizer
 *
 * @package MT  Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function grace_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Logo upload
	$wp_customize->add_section( 'sophie_logo_section' , array(
		'title'       => __( 'Logo', 'sophie' ),
		'priority'    => 30,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );

	$wp_customize->add_setting( 'sophie_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sophie_logo', array(
		'label'    => __( 'Logo', 'sophie' ),
		'section'  => 'sophie_logo_section',
		'settings' => 'sophie_logo',
	) ) );

	// Add Social Media Section
	$wp_customize->add_section( 'social-media' , array(
		'title' => __( 'Social Media', 'sophie' ),
		'priority' => 30,
		'description' => __( 'Enter the URL to your account for each service for the icon to appear in the header.', '' )
	) );

	// Add Twitter Setting
	$wp_customize->add_setting( 'twitter',
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
		'label' => __( 'Twitter', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'twitter',
	) ) );

	// Add Facebook Setting
	$wp_customize->add_setting( 'facebook' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
		'label' => __( 'Facebook', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'facebook',
	) ) );

	// Add Vimeo Setting
	$wp_customize->add_setting( 'vimeo' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo', array(
		'label' => __( 'Vimeo', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'vimeo',
	) ) );

	// Add Youtube Setting
	$wp_customize->add_setting( 'youtube' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube', array(
		'label' => __( 'YouTube', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'youtube',
	) ) );

	// Add Dribbble Setting
	$wp_customize->add_setting( 'dribbble' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribbble', array(
		'label' => __( 'Dribbble', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'dribbble',
	) ) );

	// Add Flickr Setting
	$wp_customize->add_setting( 'flickr' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'Flickr', array(
		'label' => __( 'Flickr', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'flickr',
	) ) );

	// Add Instagram Setting
	$wp_customize->add_setting( 'instagram' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'Instagram', array(
		'label' => __( 'Instagram', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'instagram',
	) ) );

	// Add Tumblr Setting
	$wp_customize->add_setting( 'tumblr' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'Tumblr', array(
		'label' => __( 'Tumblr', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'tumblr',
	) ) );

	// Add Pinterest Setting
	$wp_customize->add_setting( 'pinterest' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest', array(
		'label' => __( 'Pinterest', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'pinterest',
	) ) );

	// Add RSS Setting
	$wp_customize->add_setting( 'rss' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss', array(
		'label' => __( 'RSS', 'sophie' ),
		'section' => 'social-media',
		'settings' => 'rss',
	) ) );

	// Add Home page Text Section

	// Homepage Title
	$wp_customize->add_section( 'home_title_text_section' , array(
		'title' => __( 'Homepage Title', 'sophie' ),
		'priority' => 240,
		'description' => __( '',
			'sophie' )
	) );
	$wp_customize->add_setting( 'home_title_text' , array( 'default' => '' , 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title-text', array(
		'label' => __( 'Title', 'portfolio' ),
		'section' => 'home_title_text_section',
		'settings' => 'home_title_text',
	) ) );

	class Grace_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}
	$wp_customize->add_setting( 'homepage_textarea' );

	$wp_customize->add_section( 'homepage_textarea_section' , array(
		'title'       => __( 'Homepage Main Text Area', 'sophie' ),
		'priority'    => 245,
		'description' => '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control(
		new Grace_Customize_Textarea_Control(
			$wp_customize,
			'textarea',
			array(
				'label' => '',
				'section' => 'homepage_textarea_section',
				'settings' => 'homepage_textarea'
			)
		)
	);


}
add_action( 'customize_register', 'sophie_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function grace_customize_preview_js() {
	wp_enqueue_script( 'sophie_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'sophie_customize_preview_js' );
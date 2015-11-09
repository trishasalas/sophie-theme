<?php
new theme_customizer();

class theme_customizer {
    public function __construct() {
        add_action( 'customize_register', array(&$this, 'customize_manager_extras' ));
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager_extras( $wp_manager ) {
        $this->custom_sections( $wp_manager );
    }

    /**
     * Adds a new section to use custom controls in the WordPress customiser
     *
     * @param  Obj $wp_manager - WP Manager
     *
     * @return Void
     */
    private function custom_sections( $wp_manager )  {
     $wp_manager->add_section( 'cats_custom_section', array(
            'title'          => 'Horizontal Image Slider',
            'priority'       => 200,
            'description' => 'Select a category to use for your featured posts for the horizontal image slider on the home page.
            Posts must have a featured image that is larger than 603 by 603 pixels to be visible in the slider.'
        ) );
        require_once dirname(__FILE__) . '/customizer-classes/cats-dropdown-custom-control.php';
        $wp_manager->add_setting( 'featured_post_cat_setting', array(
            'default'        => '',
        ) );
        $wp_manager->add_control( new Category_Dropdown_Custom_Control( $wp_manager, 'featured_post_cat_setting', array(
            'label'   => 'Categories',
            'section' => 'cats_custom_section',
            'settings'   => 'featured_post_cat_setting',
            'priority' => 7
        ) ) );
    }

}
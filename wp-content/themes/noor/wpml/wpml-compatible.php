<?php 
 
/**
 * N Widgets being translated:
 */

class WPML_OT_Elements_Compatibility {

  private static $_instance = null;

  public static function instance() {

    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  private function __construct() {
    
    if ( ! self::is_wpml_active() ) {
      return;
    }

    // Load Elementor files.
    add_action( 'elementor/init', array( $this, 'wpml_compatible_init' ) );

  }

  public function wpml_compatible_init() {

    $this->includes();

    add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_noor_widgets' ] );
  }

  /**
   * Is WPML Active
   *
   * Check if WPML Multilingual CMS and WPML String Translation active
   *
   * @access private
   *
   * @return boolean is WPML String Translation
   */
  public static function is_wpml_active() {

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $wpml = is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' );

    $wpml_trans = is_plugin_active( 'wpml-string-translation/plugin.php' );

    return $wpml && $wpml_trans;

  }

  /**
   *
   * Includes
   *
   * Integrations class for widgets with complex controls.
   */
  public function includes() {

    include_once 'modules/class-wpml-ot-accordion.php';
    include_once 'modules/class-wpml-ot-accordion-with-icon.php';
    include_once 'modules/class-wpml-ot-big-tabs.php';
    include_once 'modules/class-wpml-ot-tabs.php';
    include_once 'modules/class-wpml-ot-client-carousel.php';
    include_once 'modules/class-wpml-ot-image-carousel.php';
    include_once 'modules/class-wpml-ot-icon-list.php';
    include_once 'modules/class-wpml-ot-photo-collection-slider.php';
    include_once 'modules/class-wpml-ot-progress-bars.php';
    include_once 'modules/class-wpml-ot-team-carousel.php';
    include_once 'modules/class-wpml-ot-testimonial-carousel.php';

  }
  
  public function wpml_noor_widgets($widgets){

    $widgets = $this->noor_heading($widgets);
    $widgets = $this->noor_accordions($widgets);
    $widgets = $this->noor_accordions_with_icon($widgets);
    $widgets = $this->noor_big_tabs($widgets);
    $widgets = $this->noor_tabs($widgets);
    $widgets = $this->noor_button_expand($widgets);
    $widgets = $this->noor_button_play($widgets);
    $widgets = $this->noor_button($widgets);
    $widgets = $this->noor_client_carousel($widgets);
    $widgets = $this->noor_icon_list($widgets);
    $widgets = $this->noor_image_carousel($widgets);
    $widgets = $this->noor_photo_collection_carousel($widgets);
    $widgets = $this->noor_counter($widgets);
    $widgets = $this->noor_features_box($widgets);
    $widgets = $this->noor_icon_box($widgets);
    $widgets = $this->latest_post_slider($widgets);
    $widgets = $this->latest_post_slider2($widgets);
    $widgets = $this->noor_portfolio_slider($widgets);
    $widgets = $this->noor_portfolio_filter($widgets);
    $widgets = $this->noor_portfolio_filter2($widgets);
    $widgets = $this->noor_pricing_table($widgets);
    $widgets = $this->noor_process_box($widgets);
    $widgets = $this->noor_progress($widgets);
    $widgets = $this->noor_signin_signup_form($widgets);
    $widgets = $this->noor_switchs($widgets);
    $widgets = $this->noor_team_carousel($widgets);
    $widgets = $this->noor_team($widgets);
    $widgets = $this->noor_team2($widgets);
    $widgets = $this->noor_testimonial($widgets);
    $widgets = $this->noor_testimonial_carousel($widgets);
    $widgets = $this->noor_text_animation($widgets);
    return $widgets;
  }

  /**
   * Widgets to translate.
   *
   * @access public
   *
   * @param array $widgets Widget array.
   *
   */

  private function noor_accordions_with_icon($widgets){
    $widgets[ 'ot-accordions-wicon' ] = [
      'conditions'    => ['widgetType' => 'ot-accordions-wicon'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Accordion_With_Icon',
    ];
    return $widgets;
  }

  private function noor_accordions($widgets){
    $widgets[ 'ot-accordions' ] = [
      'conditions'    => ['widgetType' => 'ot-accordions'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Accordion',
    ];
    return $widgets;
  }

  private function noor_button_expand($widgets){
    $widgets[ 'ot-btn-expand' ] = [
      'conditions'    => ['widgetType' => 'ot-btn-expand'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Click here', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'noor' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function noor_button_play($widgets){
    $widgets[ 'ot-btn-play' ] = [
      'conditions'    => ['widgetType' => 'ot-btn-play'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Link Video Here', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_button($widgets){
    $widgets[ 'ot-btn' ] = [
      'conditions'    => ['widgetType' => 'ot-btn'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Click here', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'noor' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function noor_client_carousel($widgets){
    $widgets[ 'ot-clients-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-clients-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Client_Carousel',
    ];
    return $widgets;
  }

  private function noor_image_carousel($widgets){
    $widgets[ 'ot-images-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-images-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Image_Carousel',
    ];
    return $widgets;
  }

  private function noor_icon_list($widgets){
    $widgets[ 'ot-icon-list' ] = [
      'conditions'    => ['widgetType' => 'ot-icon-list'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Icon_List',
    ];
    return $widgets;
  }

  private function noor_photo_collection_carousel($widgets){
    $widgets[ 'ot-photo-collection-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-photo-collection-carousel'],
      'fields'            => array(
        array(
          'field'       => 'caption_hover',
          'type'        => __( 'Caption Image Hover', 'noor' ),
          'editor_type' => 'LINE',
        ),
      ),
      'integration-class' => 'WPML_OT_Photo_Collection_Carousel',
    ];
    return $widgets;
  }

  private function noor_counter($widgets){
    $widgets[ 'ot-counter' ] = [
      'conditions'    => ['widgetType' => 'ot-counter'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_features_box($widgets){
    $widgets[ 'ot-features-box' ] = [
      'conditions'    => ['widgetType' => 'ot-features-box'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'caption_hover',
          'type'  => __( 'View Detail', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Features Box: Link URL', 'noor' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function noor_heading($widgets){
    $widgets[ 'ot-heading' ] = [
      'conditions'    => ['widgetType' => 'ot-heading'],
      'fields'        => [
        [
          'field' => 'sub_title',
          'type'  => __( 'Sub heading', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'title',
          'type'  => __( 'Heading', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_icon_box($widgets){
    $widgets[ 'ot-iconbox' ] = [
      'conditions'    => ['widgetType' => 'ot-iconbox'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'content',
          'type'        => __( 'Content', 'noor' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Icon Box Link', 'noor' ),
          'editor_type' => 'LINK'
        ),
        [
          'field'       => 'btn_text',
          'type'        => __( 'Button Text', 'noor' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function latest_post_slider($widgets){
    $widgets[ 'ot-latest-posts-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-latest-posts-carousel'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function latest_post_slider2($widgets){
    $widgets[ 'ot-latest-posts-carousel_2' ] = [
      'conditions'    => ['widgetType' => 'ot-latest-posts-carousel_2'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_portfolio_slider($widgets){
    $widgets[ 'ot-portfolio-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-carousel'],
      'fields'        => [
        [
          'field' => 'caption_hover',
          'type'  => __( 'Read More', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_portfolio_filter($widgets){
    $widgets[ 'ot-portfolio-filter' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-filter'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More', 'noor' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_portfolio_filter2($widgets){
    $widgets[ 'ot-portfolio-filter_2' ] = [
      'conditions'    => ['widgetType' => 'ot-portfolio-filter_2'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More', 'noor' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_pricing_table($widgets){
    $widgets[ 'ot-pricing-table' ] = [
      'conditions'    => ['widgetType' => 'ot-pricing-table'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price_period_1',
          'type'  => __( 'Price 1', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'period_1',
          'type'  => __( 'Period 1', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price_period_2',
          'type'  => __( 'Price 2', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'period_2',
          'type'  => __( 'Period 2', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'button_text',
          'type'        => __( 'Button', 'noor' ),
          'editor_type' => 'LINE'
        ],
        'btn_link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link Pricing Table:', 'noor' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function noor_process_box($widgets){
    $widgets[ 'ot-process-box' ] = [
      'conditions'    => ['widgetType' => 'ot-process-box'],
      'fields'        => [
        [
          'field' => 'number_process',
          'type'  => __( 'Number/Text', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'title',
          'type'  => __( 'Title', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'content',
          'type'        => __( 'Description', 'noor' ),
          'editor_type' => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_progress($widgets){
    $widgets[ 'ot-progress-bars' ] = [
      'conditions'    => ['widgetType' => 'ot-progress-bars'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Progress_Bars',
    ];
    return $widgets;
  }

  private function noor_signin_signup_form($widgets){
    $widgets[ 'ot-userform' ] = [
      'conditions'    => ['widgetType' => 'iprogress'],
      'fields'        => [
        [
          'link_user' => array(
            'field'       => 'url',
            'type'        => __( 'Link to Login/Resgister Page', 'noor' ),
            'editor_type' => 'LINK'
          ),
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_switchs($widgets){
    $widgets[ 'ot-switchs' ] = [
      'conditions'    => ['widgetType' => 'ot-switchs'],
      'fields'        => [
        [
          'field' => 'before_text',
          'type'  => __( 'Before', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'after_text',
          'type'  => __( 'After', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'section_id',
          'type'  => __( 'ID Link', 'noor' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_big_tabs($widgets){
    $widgets[ 'ot-big-tabs' ] = [
      'conditions'    => ['widgetType' => 'ot-big-tabs'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Big_Tabs',
    ];
    return $widgets;
  }

  private function noor_tabs($widgets){
    $widgets[ 'ot-tabs' ] = [
      'conditions'    => ['widgetType' => 'ot-tabs'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Tabs',
    ];
    return $widgets;
  }

  private function noor_team_carousel($widgets){
    $widgets[ 'ot-team-slider' ] = [
      'conditions'    => ['widgetType' => 'ot-team-slider'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Team_Carousel',
    ];
    return $widgets;
  }

  private function noor_team($widgets){
    $widgets[ 'ot-team' ] = [
      'conditions'    => ['widgetType' => 'ot-team'],
      'fields'        => [
        [
          'field' => 'member_name',
          'type'  => __( 'Name', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'member_extra',
          'type'        => __( 'Extra/Job', 'noor' ),
          'editor_type' => 'AREA'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'noor' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function noor_team2($widgets){
    $widgets[ 'ot-team2' ] = [
      'conditions'    => ['widgetType' => 'ot-team2'],
      'fields'        => [
        [
          'field' => 'member_name',
          'type'  => __( 'Name', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'member_extra',
          'type'        => __( 'Extra/Job', 'noor' ),
          'editor_type' => 'AREA'
        ],
        [
          'field'       => 'member_desc',
          'type'        => __( 'Extra/Job', 'noor' ),
          'editor_type' => 'AREA'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'noor' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function noor_testimonial($widgets){
    $widgets[ 'ot-testimonials' ] = [
      'conditions'    => ['widgetType' => 'ot-testimonials'],
      'fields'        => [
        [
          'field' => 'tcontent',
          'type'  => __( 'Content', 'noor' ),
          'editor_type'   => 'AREA'
        ],
        [
          'field'       => 'tname',
          'type'        => __( 'Name', 'noor' ),
          'editor_type' => 'LINE'
        ],
        [
          'field'       => 'tjob',
          'type'        => __( 'Job', 'noor' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function noor_testimonial_carousel($widgets){
    $widgets[ 'ot-testimonials-carousel' ] = [
      'conditions'    => ['widgetType' => 'ot-testimonials-carousel'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Testimonial_Carousel',
    ];
    return $widgets;
  }

  private function noor_text_animation($widgets){
    $widgets[ 'ot-text-animation' ] = [
      'conditions'    => ['widgetType' => 'ot-text-animation'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Text', 'noor' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'text_typer',
          'type'        => __( 'Text Animation', 'noor' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }
}

WPML_OT_Elements_Compatibility::instance();

<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu_Mobile
 */
class Noor_Menu_Mobile extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imenu_mobile';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Noor Menu Mobile', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-select';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu Mobile', 'noor' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Menu', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,

			]
		);

		$this->add_control(
			'pos_menu',
			[
				'label' => __( 'Position', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'on-right',
				'options' => [
					'on-left' 	=> __( 'On Left', 'noor' ),
					'on-right'  => __( 'On Right', 'noor' ),
				]
			]
		);
		$this->add_control(
			'logo_text',
			[
				'label' => __( 'Logo Text', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => __( 'Noor', 'noor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'info@email.com', 'noor' ),
				'default' => __( 'info@email.com', 'noor' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'noor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'noor' ),
			]
		);

		$this->add_control(
			'info_list',
			[
				'label' => 'Contact Info',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'info@email.com', 'noor' ),
					],
					[
						'text' => __( '00 (123) 456 78 90', 'noor' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$repeater2 = new Repeater();

		$repeater2->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'noor' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater2->add_control(
			'social_link',
			[
				'label' => __( 'Link', 'noor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'noor' ),
			]
		);

		$this->add_control(
			'social_list',
			[
				'label' => 'Socials',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'uil uil-facebook-f',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);

		$this->end_controls_section();
		
		/*** Style ***/
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Menu Icon', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-toggle button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => __( 'Hover Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-toggle button:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_mmenu_section',
			[
				'label' => __( 'Menu Content', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_logo',
			[
				'label' => __( 'Logo Text', 'noor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'logo_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-header h3' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'logo_typography',
				'selector' => '{{WRAPPER}} .mmenu-header h3',
			]
		);

		$this->add_control(
			'heading_menuitem',
			[
				'label' => __( 'Menu Items', 'noor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_mmenu',
			[
				'label' => __( 'Background', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'color_mmenu',
			[
				'label' => __( 'Text Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper .mobile_mainmenu li a, {{WRAPPER}} .mobile_mainmenu .arrow i, {{WRAPPER}} .mmenu-wrapper .mmenu-close' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_typography',
				'selector' => '{{WRAPPER}} .mmenu-wrapper .mobile_mainmenu li a',
			]
		);
		$this->add_control(
			'color_back',
			[
				'label' => __( 'Background Close', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-wrapper .mmenu-close' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'heading_cinfo',
			[
				'label' => __( 'Contact Info', 'noor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'color_cinfo',
			[
				'label' => __( 'Text Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-footer .mmenu-contact' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'color_hcinfo',
			[
				'label' => __( 'Hover Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-footer .mmenu-contact:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_cinfo',
				'selector' => '{{WRAPPER}} .mmenu-footer .mmenu-contact',
			]
		);

		$this->add_control(
			'heading_soc',
			[
				'label' => __( 'Socials', 'noor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'color_soc',
			[
				'label' => __( 'Icon Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mmenu-socials a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => __( 'Icon Size', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mmenu-socials a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*** scroll ***/
		$this->start_controls_section(
			'style_sicon_section',
			[
				'label' => __( 'Scroll Icon', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'sicon_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();
	}

	protected function get_available_menus(){

		$menus = wp_get_nav_menus();
		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
   }

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			
	    	<div class="octf-menu-mobile octf-cta-header">
				<div id="mmenu-toggle" class="mmenu-toggle hitem">
					<button><span></span></button>
				</div>
				<div class="site-overlay mmenu-overlay"></div>
				<div id="mmenu-wrapper" class="mmenu-wrapper <?php echo $settings['pos_menu']; ?>">
					<div class="mmenu-inner">
						<div class="mmenu-header">
							<?php if($settings['logo_text']) echo '<h3>'.$settings['logo_text'].'</h3>'; ?>
							<a class="mmenu-close otbtn-close" href="#"><i class="uil uil-times"></i></a>
						</div>
						<div class="mobile-nav">
							<?php
								wp_nav_menu( array(
									'menu' 			 => $settings['nav_menu'],
									'menu_class'     => 'mobile_mainmenu none-style',
									'container'      => '',
								) );
							?>
						</div>  
						<div class="mmenu-footer">
							<div>
								<?php foreach ( $settings['info_list'] as $key => $item ) : 
			                  		if($item['text']) echo '<a href="'.$item['link']['url'].'" class="mmenu-contact">'.$item['text'].'</a>';
			                  	endforeach ?>
			                  
			                  <nav class="mmenu-socials">
			                  	<?php foreach ( $settings['social_list'] as $key => $item ) :
			                  		$migration_allowed = Icons_Manager::is_migration_allowed(); 
			                  		$migrated = isset( $item['__fa4_migrated']['social_icon'] );
									$is_new = ! isset( $item['icon'] ) && $migration_allowed;
									if ( ! empty( $item['icon'] ) || ( ! empty( $item['social_icon']['value'] ) && $is_new ) ) :
			                  		echo '<a href="'.$item['social_link']['url'].'">'; ?>

			                  		<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] );
										} else { ?>
											<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
									<?php } echo '</a>'; ?>

			                  	<?php endif; endforeach; ?>
			                  </nav>
			                  <!-- /.social -->
			                </div>
						</div> 	
					</div>   	
				</div>
			</div>
	    <?php
	}

}
// After the Noor_Menu_Mobile class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Menu_Mobile() );
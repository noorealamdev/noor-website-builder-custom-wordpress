<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Tabs
 */
class Noor_Big_Tabs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-big-tabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'N Big Tabs', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-tabs';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Tabs', 'noor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'noor' ),
				'placeholder' => __( 'Tab Title', 'noor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'noor' ),
				'default' => __( 'Tab Content', 'noor' ),
				'placeholder' => __( 'Tab Content', 'noor' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font',
				'options' => [
					'font' 	=> __( 'Font Icon', 'noor' ),
					'image' => __( 'Image', 'noor' ),
				]
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'noor' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [],
				'fa4compatibility' => 'icon',
				'condition' => [
					'icon_type' => 'font',
				]
			]
		);
		$repeater->add_control(
	       'icon_image',
	        [
	           'label' => esc_html__( 'Photo', 'noor' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
			  	'condition' => [
					'icon_type' => 'image',
				]
		    ]
	    );
		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ot-tabs__link i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .ot-tabs__link svg, {{WRAPPER}} {{CURRENT_ITEM}} .ot-tabs__link svg .lineal-fill,
					 {{WRAPPER}} {{CURRENT_ITEM}} .ot-tabs__link svg .fill-secondary' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => 'font',
				]
			]
		);
		$repeater->add_control(
			'tabs_link',
			[
				'label' => __( 'ID link to content section', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'tab-id', 'noor' ),
			]
		);

		$this->add_control(
			'noor_tabs',
			[
				'label' => __( 'Tabs Items', 'noor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'noor' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'noor' ),
						'tabs_link'	  => __( 'tab-1', 'noor' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'noor' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'noor' ),
						'tabs_link'	  => __( 'tab-2', 'noor' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		
		$this->end_controls_section();

		/* Style */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Tabs Item', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'tabs_item_padding',
			[
				'label' => __( 'Padding', 'noor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_item_radius',
			[
				'label' => __( 'Border Radius', 'noor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_item_style' );

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => __( 'Normal', 'noor' ),
			]
		);

		$this->add_control(
			'item_bgcolor',
			[
				'label' => __( 'Background', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_shadow',
				'selector' => '{{WRAPPER}} .ot-tabs__link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_active',
			[
				'label' => __( 'Active/Hover', 'noor' ),
			]
		);

		$this->add_control(
			'item_bg_active',
			[
				'label' => __( 'Background', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_active_shadow',
				'selector' => '{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* Title */
		$this->add_control(
			'style_title',
			[
				'label' => __( 'Title', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link h4' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__link h4',
			]
		);

		/* Content */
		$this->add_control(
			'style_content',
			[
				'label' => __( 'Content', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__link p',
			]
		);

		/* Icon */
		$this->add_control(
			'style_icon',
			[
				'label' => __( 'Icon', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ot-tabs__link svg, {{WRAPPER}} .ot-tabs__link svg .lineal-fill,
					 {{WRAPPER}} .ot-tabs__link svg .fill-secondary' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link i, {{WRAPPER}} .ot-tabs__link svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-tabs__link img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-tabs__link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .ot-tabs__link img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['noor_tabs'] ) ) {
			return;
		}
		$this->add_render_attribute( 'tabs_wrapper', 'class', [ 'ot-tabs', 'tabs-justified' ] );
		
		?>

		<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
			<ul class="ot-tabs__heading unstyle dflex">
				<?php $i = 1; foreach ( $settings['noor_tabs'] as $index => $tabs ) :
					$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li class="ot-tabs__item elementor-repeater-item-<?php echo esc_attr( $tabs['_id'] ) ?>" data-tab="<?php echo esc_attr( $tabs['tabs_link'] );?>">
					<a class="ot-tabs__link dflex">
						<?php
							$migrated = isset( $tabs['__fa4_migrated']['selected_icon'] );
							$is_new = ! isset( $tabs['icon'] ) && $migration_allowed;
							if ( ! empty( $tabs['icon'] ) || ( ! empty( $tabs['selected_icon']['value'] ) && $is_new ) || !empty( $tabs['icon_image']['url'] ) ) :
						?>
						<div>
							<?php
							if( $tabs['icon_type'] == 'font' ){
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $tabs['selected_icon'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
									<i class="<?php echo esc_attr( $tabs['icon'] ); ?>" aria-hidden="true"></i>
							<?php } }elseif( $tabs['icon_type'] == 'image' ) { ?>
								<img src="<?php echo esc_attr( $tabs['icon_image']['url'] ); ?>" alt="">
							<?php } ?>
						</div>
						<?php endif; ?>
						<div>
							<h4><?php $this->print_unescaped_setting( 'tab_title', 'noor_tabs', $index );?></h4>
							<p><?php $this->print_unescaped_setting( 'tab_content', 'noor_tabs', $index );?></p>
						</div>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
	    </div>

	    <?php
	}

}
// After the Noor_Big_Tabs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Big_Tabs() );
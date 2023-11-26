<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Progress Bars 
 */
class Noor_Progress_Bars extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-progress-bars';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'N Progress Bars', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor' ];
	}

	protected function register_controls() {

		//Content Progress Bars
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'noor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Advertising', 'noor' ),
			]
		);

		$repeater->add_control(
			'percent',
			[
				'label'   => esc_html__( 'Percentage', 'noor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
			]
		);

		$repeater->add_control(
			'desc_text',
			[
				'label'   => esc_html__( 'Description', 'noor' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your description', 'noor' ),
				'description' => esc_html__( 'Only use show for Circle style', 'noor' ),
			]
		);

		$repeater->add_control(
			'item_progress_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} svg path:last-child' => 'stroke: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_progress_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} svg path:first-child' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'noor_progress',
			[
				'label' => __( 'Progress Items', 'noor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Marketing', 'noor' ),
						'percent' => __( '100', 'noor' ),
					],
					[
						'title' => __( 'Development', 'noor' ),
						'percent' => __( '80', 'noor' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'bar_style',
			[
				'label' 	=> __( 'Progress Bars Style', 'noor' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 'line',
				'options' 	=> [
					'line'    => __( 'Line', 'noor' ),
					'circle'  => __( 'Semi Circle', 'noor' ),
				]
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'h4',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ot-2-cols',
				'options' => [
					'ot-1-cols' => __( '1 Column', 'noor' ),
					'ot-2-cols' => __( '2 Column', 'noor' ),
					'ot-3-cols'	=> __( '3 Column', 'noor' ),
					'ot-4-cols' => __( '4 Column', 'noor' ),
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'bar_style_section',
			[
				'label' => __( 'Progress Bar', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'progress_space',
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
					'{{WRAPPER}} .ot-progress-line li:not(:last-child),
					 {{WRAPPER}} .progressbar.semi-circle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'bar_height_line',
			[
				'label' => __( 'Height', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .progressbar.line svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .progressbar.semi-circle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bar_circle_width',
			[
				'label' => __( 'Width', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .progressbar.semi-circle' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_text_section',
			[
				'label' => __( 'Text', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'noor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'progress_title_space',
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
					'{{WRAPPER}} .progressbar-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-progress li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .progressbar-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-progress li, {{WRAPPER}} .progressbar-title',
			]
		);

		//Percentage
		$this->add_control(
			'heading_percent',
			[
				'label' => __( 'Percentage', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'per_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress .progressbar-text' => 'color: {{VALUE}}!important;',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'per_typography',
				'selector' => '{{WRAPPER}} .progressbar.semi-circle .progressbar-text',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		//Description
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress p' => 'color: {{VALUE}}!important;',
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .ot-progress p',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 
		?>

		<?php if( !empty( $settings['noor_progress'] ) ) : ?>

		<?php if( $settings['bar_style'] == 'line' ){ ?>
			<ul class="ot-progress ot-progress-line">
				<?php foreach ( $settings['noor_progress'] as $index => $item ) { 
					
					$progress_percent_setting_key = $this->get_repeater_setting_key( 'title', 'noor_progress', $index );
					$this->add_render_attribute( $progress_percent_setting_key, [
						'class' => [ 'progressbar line' ],
						'data-value' => $item['percent'],
					] );

					$item_key = $index + 1;
					$this->add_render_attribute( $item_key, 'class', 'elementor-repeater-item-' . $item['_id'] );
				?>

				<li <?php $this->print_render_attribute_string( $item_key ); ?>>
					<p><?php $this->print_unescaped_setting( 'title', 'noor_progress', $index );?></p>
					<div <?php $this->print_render_attribute_string( $progress_percent_setting_key ); ?>></div>
				</li>
				
				<?php } ?>
			</ul>
		<?php }elseif( $settings['bar_style'] == 'circle' ){ ?>
			<div class="ot-progress ot-progress-circle <?php echo esc_attr($settings['column']); ?>">

				<?php 
					$this->add_render_attribute( 'progressbar-title', 'class', 'progressbar-title' );
					foreach ( $settings['noor_progress'] as $index => $item ) { 
					$progress_percent_setting_key = $this->get_repeater_setting_key( 'title', 'noor_progress', $index );
					$this->add_render_attribute( $progress_percent_setting_key, [
						'class' => [ 'progressbar semi-circle' ],
						'data-value' => $item['percent'],
					] );

					$item_key = $index + 1;
					$this->add_render_attribute( $item_key, 'class', 'elementor-repeater-item-' . $item['_id'] );
				?>
				<div <?php $this->print_render_attribute_string( $item_key ); ?>>

					<div <?php $this->print_render_attribute_string( $progress_percent_setting_key ); ?>></div>

					<?php if( !empty($item['title']) ) : ?>
					<<?php Utils::print_validated_html_tag( $settings['title_html_tag'] ); ?> <?php $this->print_render_attribute_string( 'progressbar-title' ); ?>>
					<?php $this->print_unescaped_setting( 'title', 'noor_progress', $index );?>
					</<?php Utils::print_validated_html_tag( $settings['title_html_tag'] ); ?>>
					<?php endif; ?>

					<?php if( !empty($item['desc_text']) ) : ?>
					<p><?php $this->print_unescaped_setting( 'desc_text', 'noor_progress', $index );?></p>
					<?php endif; ?>
				</div>
				<?php } ?>
			</div>
		<?php } endif; ?>
		
	    <?php 
	}

}
// After the Noor_Progress_Bars class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Progress_Bars() );
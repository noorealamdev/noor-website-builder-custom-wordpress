<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Userform 
 */
class Noor_Userform extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-userform';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'N User Form', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-user';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Form', 'noor' ),
			]
		);

		$this->add_control(
			'user_form',
			[
				'label' => __( 'User Form', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'login' => __( 'Login Form', 'noor' ),
					'regis' => __( 'Register Form', 'noor' ),
				],
				'default' => 'login',
			]
		);
		$this->add_control(
			'link_user',
			[
				'label' => __( 'Link to Login/Resgister Page', 'noor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'noor' ),
				'default'	=> [],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="ot-userform" data-link="<?php echo esc_url($settings['link_user']['url']); ?>">
	        <?php if( $settings['user_form'] == 'login' ) echo do_shortcode('[noor_login]'); ?>
	        <?php if( $settings['user_form'] == 'regis' ) echo do_shortcode('[noor_register]'); ?>
	    </div>
	    <?php
	}

}
// After the Noor_Userform class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Userform() );
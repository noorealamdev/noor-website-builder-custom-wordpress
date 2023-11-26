<?php

/**
 * Class WPML_OT_Testimonial_Carousel
 */
class WPML_OT_Testimonial_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'testi_slider';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tcontent', 'tname', 'tjob' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'tcontent':
				return esc_html__( 'Content', 'noor' );

			case 'tname':
				return esc_html__( 'Name', 'noor' );

			case 'tjob':
				return esc_html__( 'Job', 'noor' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			
			case 'tname':
			case 'tjob':
				return 'LINE';

			case 'tcontent':
				return 'AREA';

			default:
				return '';
		}
	}

}

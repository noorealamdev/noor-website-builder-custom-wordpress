<?php

/**
 * Class WPML_OT_Team_Carousel
 */
class WPML_OT_Team_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot-team-slider';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'member_name', 'member_extra', 'member_desc', 'link' => array( 'url' ) );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'member_name':
				return esc_html__( 'Name', 'noor' );

			case 'member_extra':
				return esc_html__( 'Extra/Job', 'noor' );

			case 'member_desc':
				return esc_html__( 'Description', 'noor' );

			case 'url':
				return esc_html__( 'Link', 'noor' );

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
			
			case 'member_name':
				return 'LINE';

			case 'member_extra':
			case 'member_desc':
				return 'AREA';

			case 'url':
				return 'LINK';

			default:
				return '';
		}
	}

}

<?php

/**
 * Class WPML_OT_Image_Carousel
 */
class WPML_OT_Image_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'images_slider';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'link_to' => array( 'url' ) );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'title':
				return esc_html__( 'Name', 'noor' );

			case 'url':
				return esc_html__( 'Image: Link URL', 'noor' );

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
			case 'title':
				return 'LINE';

			case 'url':
				return 'LINK';

			default:
				return '';
		}
	}

}

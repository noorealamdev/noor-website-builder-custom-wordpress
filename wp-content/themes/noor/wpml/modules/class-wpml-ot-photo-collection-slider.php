<?php

/**
 * Class WPML_OT_Photo_Collection_Carousel
 */
class WPML_OT_Photo_Collection_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'collection_slider';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'coll_title', 'meta_1', 'meta_2', 'link_to' => array( 'url' ) );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'coll_title':
				return esc_html__( 'Name', 'noor' );

			case 'meta_1':
				return esc_html__( 'Meta 1', 'noor' );

			case 'meta_2':
				return esc_html__( 'Meta 2', 'noor' );

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
			case 'coll_title':
			case 'meta_1':
			case 'meta_2':
				return 'LINE';

			case 'url':
				return 'LINK';

			default:
				return '';
		}
	}

}

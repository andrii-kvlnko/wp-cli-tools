<?php 

namespace Theme_Structural_Beam;

class Call_To_Action_With_Image implements Component {
	public function render( $fields = [] ) {

		get_template_part(
			'templates/components/call-to-action-with-image/template',
			null,
			[
							'title' => $fields['title'],
							'description-1' => $fields['description_1'],
										'background-image' => [
					'src'     => wp_get_attachment_url(),
					'src-set' => wp_get_attachment_image_srcset(),
					'alt'     => get_post_meta( '_wp_attachment_image_alt', true ),
				],
										'items'            => array_map(
					function ( $item ) {
						return [

						];
					},
					$fields['items']
				),
						]
		);
	}

	public function enqueue() {
	}

	public function wp_enqueue() {
	}

	public function get_fields() {
	}
}
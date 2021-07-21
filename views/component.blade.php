{!! $php_prefix !!}

namespace {!! $namespace !!};

class {!! $class_name !!} implements Component {
	public function render( $fields = [] ) {

		get_template_part(
			'templates/components/{!! $component_name !!}/template',
			null,
			[
			@foreach ($simple_fields as $field => $name )
				'{!! $field !!}' => $fields['{!! $name !!}'],
			@endforeach
			@foreach ($image_fields as $field => $name )
				'{!! $field !!}' => [
					'src'     => wp_get_attachment_url(),
					'src-set' => wp_get_attachment_image_srcset(),
					'alt'     => get_post_meta( '_wp_attachment_image_alt', true ),
				],
			@endforeach
			@foreach ($items_fields as $field => $name )
				'{!! $field !!}'            => array_map(
					function ( $item ) {
						return [

						];
					},
					$fields['{!! $field !!}']
				),
			@endforeach
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
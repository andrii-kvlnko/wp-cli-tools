{!! $php_prefix !!}

use {!! $namespace !!}\{!! $class_name !!};

$fields       = get_fields();
$fields['id'] = $block['id'];

$component_acf_template = new {!! $class_name !!}();
$component_acf_template->render( $fields );
<?php 

use Theme_Structural_Beam\Call_To_Action_With_Image;

$fields       = get_fields();
$fields['id'] = $block['id'];

$component_acf_template = new Call_To_Action_With_Image();
$component_acf_template->render( $fields );
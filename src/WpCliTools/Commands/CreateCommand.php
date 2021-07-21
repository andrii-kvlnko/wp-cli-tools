<?php

namespace WpCliTools\Commands;

use ConsoleKit\Colors;
use ConsoleKit\Command;
use Jenssegers\Blade\Blade;

class CreateCommand extends Command {
	public function execute( array $args, array $options = array() ) {
		$themePath     = $options['theme-path'];
		$includesPath  = sprintf( '%s/%s', $themePath, 'includes' );
		$componentName = $options['component'];

		$projectPath   = dirname( __FILE__, 4 );
		$viewsPath     = sprintf( '%s/%s', $projectPath, 'views' );
		$viewCachePath = sprintf( '%s/%s', $projectPath, 'views-cache' );

		$this->writeln( $viewsPath, Colors::GREEN );

		$fields_config_path = $options['config'];
		$fields             = require $fields_config_path;

		$class_name = explode( '-', $componentName );
		$class_name = array_map(
			function ( $item ) {
				return ucfirst( strtolower( $item ) );
			},
			$class_name
		);
		$class_name = implode( '_', $class_name );
		$viewArgs   = [
			'class_name'     => $class_name,
			'namespace'      => $options['namespace'],
			'component_name' => $componentName,
			'php_prefix'     => '<?php ',
			'simple_fields'  => $fields['simple'],
			'image_fields'   => $fields['image'],
			'items_fields'   => $fields['items'],
		];

		$blade             = new Blade( $viewsPath, $viewCachePath );
		$component_content = $blade->make( 'component', $viewArgs )->render();

		$componentFilePath = sprintf( '%s/%s/%s.php', $themePath, 'includes', $componentName );
		file_put_contents( $componentFilePath, $component_content );

		$componentTemplatesCatalog = sprintf( '%s/%s/%s', $themePath, 'templates', $componentName );
		mkdir( $componentTemplatesCatalog );

		$componentTemplatePath = sprintf( '%s/template.php', $componentTemplatesCatalog );
		$componentTemplateACFPath = sprintf( '%s/acf.php', $componentTemplatesCatalog);

		$acfViewArgs   = [
			'php_prefix'     => '<?php ',
			'class_name'     => $class_name,
			'namespace'      => $options['namespace'],
		];
		$acfTemplate = $blade->make( 'acf', $acfViewArgs )->render();
		file_put_contents( $componentTemplateACFPath, $acfTemplate );

		$templateViewArgs   = [
			'component_name'     => $options['component'],
		];
		$componentTemplate = $blade->make( 'template', $templateViewArgs )->render();
		file_put_contents( $componentTemplatePath, $componentTemplate );

		$this->writeln( $includesPath, Colors::GREEN );
		$this->writeln( $component_content, Colors::GREEN );
	}
}
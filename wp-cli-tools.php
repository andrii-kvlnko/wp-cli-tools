<?php

require 'vendor/autoload.php';

$createCommand = WpCliTools\Commands\CreateCommand::class;

$console = new ConsoleKit\Console();
$console->addCommand($createCommand);
$console->run();
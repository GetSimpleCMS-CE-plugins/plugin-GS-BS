<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'GS-BS',
	'1.0',
	'Team CE',
	'https://www.getsimple-ce.ovh/',
	'Preserves raw backslashes (\) in content',
	'plugins',
	''
    );

// Example: Typing "C:{{BS}}Windows{{BS}}Path" in CKEditor
// Will output: "C:\Windows\Path" in Front-End

// ==============================================
// CORE FUNCTIONALITY
// ==============================================

// 1. Process content before display
add_filter('content', 'RawBackslashPreserver_process');

function RawBackslashPreserver_process($content) {
    // Replace placeholder with real backslash
    return str_replace('{{BS}}', '\\', $content);
}

// 2. Process content before saving (CKEditor filter)
add_action('content-pre-save', 'RawBackslashPreserver_preserve');

function RawBackslashPreserver_preserve($content) {
    // Replace backslashes with placeholder
    return str_replace('\\', '{{BS}}', $content);
}

// 3. Optional: Process excerpts too
add_filter('excerpt', 'RawBackslashPreserver_process');

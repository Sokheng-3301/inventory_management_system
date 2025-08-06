<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false, // Throw an Exception on warnings from dompdf

    'public_path' => null, // Override the public path if needed

    'convert_entities' => true,

    'enable_font_subsetting' => true,

    'options' => [
        'font_dir' => public_path('fonts'), // Path to your fonts directory
        'font_cache' => storage_path('fonts'), // Path to cache fonts
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),



        'enable_font_subsetting' => true,
        'default_font' => 'KhmerOS', // or your chosen font



        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        'enable_font_subsetting' => true,
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'KhmerOS', // Default font set to KhmerOS
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => false,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ],

    'fonts' => [
        'KhmerOS' => [
            'R' => 'KhmerOS.ttf', // Regular font
            // Add more styles if available
            // 'B' => 'KhmerOS-Bold.ttf',
            // 'I' => 'KhmerOS-Italic.ttf',
            // 'BI' => 'KhmerOS-BoldItalic.ttf',
        ],
    ],

];
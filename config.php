<?php
$config = array();

// Name of you module
$config['name'] = "Todo Module Livewire";

// Author name
$config['author'] = "Microweber";

// Custom category
$config['categories'] = "admin";

// Version of your module
$config['version'] = 0.2;

// Show module in Admin Panel
$config['ui_admin'] = true;

// Show module in Live-Edit
$config['ui'] = false;

// Position of you module
$config['position'] = 1;

$config['settings'] = [];

// Here is the index route for admin panel
$config['settings']['routes'] = [
    'admin'=>'admin.todo-module-livewire.index'
];

// Make autoload of you module folder
$config['settings']['autoload_namespace'] = [
    [
        'path' => __DIR__ . '/src/',
        'namespace' => 'MicroweberPackages\\Modules\\TodoModuleLivewire\\'
    ],
];

// Register service provider of you module
$config['settings']['service_provider'] = [
    \MicroweberPackages\Modules\TodoModuleLivewire\TodoModuleLivewireServiceProvider::class
];

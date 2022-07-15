<?php
$config = array();
$config['name'] = "Todo Module Livewire";
$config['author'] = "Microweber";

$config['categories'] = "admin";
$config['version'] = 0.1; // Version of your module
$config['ui_admin'] = true; // True if you want to show your module on admin
$config['ui'] = false; // True if you want to show your module in live-edit modules
$config['position'] = 1; // Position of you module

$config['settings'] = [];

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

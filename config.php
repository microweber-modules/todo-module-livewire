<?php
$config = array();
$config['name'] = "Todo Module Livewire";
$config['author'] = "Microweber";

$config['categories'] = "admin";
$config['version'] = 0.3;
$config['ui_admin'] = false;
$config['ui'] = false;
$config['position'] = 99;

$config['settings'] = [];
$config['settings']['routes'] = [
    'admin'=>'admin.todo-module-livewire.index'
];

$config['settings']['autoload_namespace'] = [
    [
        'path' => __DIR__ . '/src/',
        'namespace' => 'MicroweberPackages\\Modules\\TodoModuleLivewire\\'
    ],
];
$config['settings']['service_provider'] = [
    \MicroweberPackages\Modules\TodoModuleLivewire\TodoModuleLivewireServiceProvider::class
];

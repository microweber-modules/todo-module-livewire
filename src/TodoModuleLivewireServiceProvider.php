<?php
namespace MicroweberPackages\Modules\TodoModuleLivewire;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire\TodoListComponent;

class TodoModuleLivewireServiceProvider extends ServiceProvider
{
    /**
     * Whether or not to defer the loading of this service
     * provider until it's needed
     *
     * @var boolean
     */
    protected $defer = true;


    public function provides() {
        return ['MicroweberPackages\Modules\TodoModuleLivewire'];
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('todo-module-livewire', TodoListComponent::class);
        View::addNamespace('todo-module-livewire', normalize_path((__DIR__) . '/resources/views'));

    }

    public function register()
    {
        $this->loadMigrationsFrom(normalize_path((__DIR__) . '/migrations/'));
        $this->loadRoutesFrom((__DIR__) . '/routes/admin.php');
    }
}

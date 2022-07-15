<?php
namespace MicroweberPackages\Modules\TodoModuleLivewire;

use Livewire\Livewire;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire\FormComponent;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire\ListComponent;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire\NotificationComponent;

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
        Livewire::component('todo-module-livewire.list-component', ListComponent::class);
        Livewire::component('todo-module-livewire.todo-notification-component', NotificationComponent::class);
        Livewire::component('todo-module-livewire.form-component', FormComponent::class);
        View::addNamespace('todo-module-livewire', normalize_path((__DIR__) . '/resources/views/livewire'));

    }

    public function register()
    {
        $this->loadMigrationsFrom(normalize_path((__DIR__) . '/migrations/'));
        $this->loadRoutesFrom((__DIR__) . '/routes/admin.php');
    }
}

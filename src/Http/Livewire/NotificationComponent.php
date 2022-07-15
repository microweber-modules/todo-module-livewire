<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use Log;

class NotificationComponent extends Component
{
    public $listeners = [
        "flash_message" => "flashMessage"
    ];

    public function flashMessage($type, $msg){
        session()->flash($type, $msg);
    }

    public function render()
    {
        return view('todo-module-livewire::admin.todo.notification');
    }
}

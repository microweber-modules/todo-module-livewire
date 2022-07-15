<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;

class TodoListComponent extends Component
{
    public function render()
    {
        return view('todo-module-livewire::admin.todo-list');
    }
}

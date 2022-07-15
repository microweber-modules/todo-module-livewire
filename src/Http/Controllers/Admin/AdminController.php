<?php
namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Controllers\Admin;

use Illuminate\Http\Request;;

class AdminController extends \MicroweberPackages\App\Http\Controllers\AdminController
{
    public function index(Request $request)
    {
        return $this->view('todo-module-livewire::admin.todo.index');
    }
}

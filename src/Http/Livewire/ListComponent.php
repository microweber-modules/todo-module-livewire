<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use MicroweberPackages\Modules\TodoModuleLivewire\Models\Todo;

class ListComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $listeners = [
        "loadList" => "loadList"
    ];

    public $filter = [
        "search" => "",
        "status" => "",
        "order_field" => "",
        "order_type" => "",
    ];

    public $loadingMessage;

    public $confirmingDeleteId = false;

    public function loadList()
    {
        $this->loadingMessage = "Loading Todos...";

        $query = [];

        if (!empty($this->filter["status"])) {
            $query["status"] = $this->filter["status"];
        }

        $getTodoQuery = Todo::where($query);

        // Search
        if (!empty($this->filter["search"])) {
            $filter = $this->filter;
            $getTodoQuery = $getTodoQuery->where(function ($query) use ($filter) {
                $query->where('title', 'LIKE', $this->filter['search'] . '%');
            });
        }

        // Ordering
        if (!empty($this->filter["order_field"])) {
            $order_type = (!empty($this->filter["order_type"])) ? $this->filter["order_type"] : 'ASC';
            $getTodoQuery = $getTodoQuery->orderBy($this->filter["order_field"], $order_type);
        }

        // Paginating
        $getTodoQuery = $getTodoQuery->paginate();
        $this->todos = $getTodoQuery->items();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete($id)
    {
        $todo = Todo::where('id',$id)->first();
        if ($todo == null) {
            return [];
        }

        $todo->delete();

        $this->emitTo('todo-module-livewire.notification-component', 'flashMessage', 'error', 'Task deleted successfully.');
        $this->emitTo('todo-module-livewire.list-component', 'loadList');
    }

    public function mount(){
        $this->loadList();
    }

    public function render() {
        return view('todo-module-livewire::admin.todo.list');
    }
}

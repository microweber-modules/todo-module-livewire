<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use MicroweberPackages\Modules\TodoModuleLivewire\Models\Todo;

class ListComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $loading_message = "";

    public $listeners = [
        "load_list" => "loadList"
    ];

    public $filter = [
        "search" => "",
        "status" => "",
        "order_field" => "",
        "order_type" => "",
    ];

    protected $updatesQueryString = ['page'];

    public function loadList()
    {

        $this->loading_message = "Loading Todos...";

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

    public function mount(){
        $this->loadList();
    }

    public function render() {
        return view('todo-module-livewire::admin.todo.list');
    }
}

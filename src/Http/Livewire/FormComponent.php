<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Requests\TodoFormRequest;
use MicroweberPackages\Modules\TodoModuleLivewire\Models\Todo;

class FormComponent extends Component
{

    public $submit_btn_title = "Save Task";
    public $form = [
        "id" => NULL,
        "title" => "",
        "description" => "",
        "status" => "",
    ];

    public $listeners = [
        "edit" => "edit"
    ];

    public function mount()
    {

    }

    public function edit($id)
    {
        $this->submit_btn_title = "Update Task";
        $todo = Todo::find($id);
        $this->form = $todo->toArray();
    }

    public function save()
    {
        $form = new TodoFormRequest();
        $form->merge($this->form);
        $validatedData = $form->validate($form->rules());

        $isNewTask = false;
        if (isset($validatedData["id"]) && $validatedData["id"] > 0) {
           $todoModel = Todo::where('id', $validatedData['id'])->first();
        } else {
           $todoModel = new Todo();
           $isNewTask = true;
        }

        $todoModel->title = $validatedData['title'];
        $todoModel->description = $validatedData['description'];
        $todoModel->status = $validatedData['status'];
        $todoModel->save();

        if ($isNewTask) {
            $message = "New Task created successfully.";
        } else {
            $message = "Task updated successfully.";
        }

        $this->submit_btn_title = "Save Task";

        $this->emitTo('todo-module-livewire.notification-component', 'flash_message', 'success', $message);
        $this->emitTo('todo-module-livewire.list-component', 'load_list');
    }

    public function render()
    {
        return view('todo-module-livewire::admin.todo.create-form');
    }
}

<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use MicroweberPackages\Modules\TodoModuleLivewire\Http\Requests\TodoFormRequest;
use MicroweberPackages\Modules\TodoModuleLivewire\Models\Todo;

class FormComponent extends Component
{
    public $submitBtnTitle = "Save Task";
    public $form = [];

    public $listeners = [
        "edit" => "edit"
    ];

    public function edit($id)
    {
        $this->submitBtnTitle = "Update Task";

        $todo = Todo::find($id);
        $this->form = $todo->toArray();
    }

    public function resetForm()
    {
        $this->submitBtnTitle = "Save Task";
        $this->form = [
            "id" => NULL,
            "title" => "",
            "description" => "",
            "status" => "",
        ];
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

        $this->resetForm();

        $this->emitTo('todo-module-livewire.notification-component', 'flashMessage', 'success', $message);
        $this->emitTo('todo-module-livewire.list-component', 'loadList');
    }

    public function render()
    {
        return view('todo-module-livewire::admin.todo.create-form');
    }
}

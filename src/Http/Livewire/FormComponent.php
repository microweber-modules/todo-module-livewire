<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Http\Livewire;

use Livewire\Component;
use Log;
use DB;
use Exception;
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

    public function mount(){

    }

    public function edit($id){
        $this->submit_btn_title = "Update Task";
        $todo = Todo::find($id);
        $this->form = $todo->toArray();
    }

    public function save(){

        $form = new TodoFormRequest();
        $form->merge($this->form);
        $validated_data = $form->validate($form->rules());


    $query = [
        "title" => $validated_data["title"],
        "description" => $validated_data["description"],
        "status" => $validated_data["status"],
    ];

        if (isset($validated_data["id"]) && $validated_data["id"] > 0) {
       //     $info["todo"] = Todo::update($query);
        } else {
            $info["todo"] = Todo::create($query);
        }



        $info['success'] = TRUE;


        if($info["success"]){
            $type = "success";
            if($info["todo"]->wasRecentlyCreated){
                $message = "New Task created successfully.";
            }else{
                $message = "Task updated successfully.";
            }

            $this->submit_btn_title = "Save Task";

        }else{
            $type = "error";
            $message = "Something went wrong while saving task.";
        }

        $this->emitTo('todo.todo-notification-component', 'flash_message', $type, $message);

        $this->emitTo('todo.list-component', 'load_list');
    }

    public function render()
    {
        return view('todo-module-livewire::admin.todo.create-form');
    }
}
